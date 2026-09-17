<?php

namespace App\Services\AppSupport;

use App\Models\AppSupport\AppSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseBackupService
{
    protected string $storageDisk = 'local';
    protected string $backupDir = 'backups';

    public function __construct()
    {
        $this->ensureBackupDirectoryExists();
    }

    /**
     * Memastikan folder direktori backup ada di storage
     */
    protected function ensureBackupDirectoryExists(): void
    {
        $path = storage_path('app/' . $this->backupDir);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
    }

    /**
     * Mendapatkan informasi koneksi & statistik database
     */
    public function getDatabaseOverview(): array
    {
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        $databaseName = config("database.connections.{$connection}.database");

        $tables = $this->getTablesWithRelations();
        $totalSizeMb = 0;
        $totalRows = 0;
        $totalForeignKeys = 0;

        foreach ($tables as $t) {
            $totalSizeMb += (float) ($t['size_mb'] ?? 0);
            $totalRows += (int) ($t['rows'] ?? 0);
            $totalForeignKeys += count($t['outgoing_relations'] ?? []);
        }

        return [
            'connection' => $connection,
            'driver' => strtoupper($driver),
            'database_name' => $databaseName,
            'total_tables' => count($tables),
            'total_rows' => $totalRows,
            'total_size_mb' => round($totalSizeMb, 2),
            'total_relations' => $totalForeignKeys,
            'server_version' => $this->getServerVersion(),
            'last_backup' => $this->getLastBackupTime(),
        ];
    }

    /**
     * Mendapatkan versi server database
     */
    protected function getServerVersion(): string
    {
        try {
            $pdo = DB::connection()->getPdo();
            return $pdo->getAttribute(\PDO::ATTR_SERVER_VERSION) ?? 'Unknown';
        } catch (\Throwable $e) {
            return 'Unknown';
        }
    }

    /**
     * Mendapatkan waktu backup terakhir
     */
    protected function getLastBackupTime(): ?string
    {
        $files = $this->getBackupFiles();
        if (!empty($files)) {
            return $files[0]['created_at_formatted'] ?? null;
        }
        return null;
    }

    /**
     * Mengambil daftar tabel lengkap dengan relasi Foreign Key (Outgoing & Incoming)
     */
    public function getTablesWithRelations(): array
    {
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        $databaseName = config("database.connections.{$connection}.database");

        $rawTables = [];
        $foreignKeys = [];

        if (in_array($driver, ['mysql', 'mariadb'])) {
            // Ambil info tabel
            $tablesQuery = DB::select("
                SELECT 
                    TABLE_NAME as name,
                    ENGINE as engine,
                    TABLE_ROWS as table_rows,
                    DATA_LENGTH as data_length,
                    INDEX_LENGTH as index_length,
                    (DATA_LENGTH + INDEX_LENGTH) as total_bytes,
                    TABLE_COLLATION as collation,
                    CREATE_TIME as create_time
                FROM information_schema.TABLES
                WHERE TABLE_SCHEMA = ? AND TABLE_TYPE = 'BASE TABLE'
                ORDER BY TABLE_NAME ASC
            ", [$databaseName]);

            foreach ($tablesQuery as $row) {
                // Hitung baris secara eksak untuk mengatasi estimasi InnoDB yang tidak akurat pada TABLE_ROWS
                $exactRows = 0;
                try {
                    $exactRows = (int) DB::table($row->name)->count();
                } catch (\Throwable $e) {
                    $exactRows = (int) $row->table_rows;
                }

                $rawTables[$row->name] = [
                    'name' => $row->name,
                    'engine' => $row->engine ?? 'InnoDB',
                    'rows' => $exactRows,
                    'size_bytes' => (int) $row->total_bytes,
                    'size_mb' => round(($row->total_bytes / (1024 * 1024)), 3),
                    'size_formatted' => $this->formatBytes($row->total_bytes),
                    'collation' => $row->collation,
                    'outgoing_relations' => [], // Foreign keys yang dirujuk tabel ini ke tabel lain (Parent)
                    'incoming_relations' => [], // Foreign keys yang merujuk ke tabel ini dari tabel lain (Child)
                ];
            }

            // Ambil info Foreign Keys
            $fkQuery = DB::select("
                SELECT 
                    kcu.TABLE_NAME as table_name,
                    kcu.COLUMN_NAME as column_name,
                    kcu.CONSTRAINT_NAME as constraint_name,
                    kcu.REFERENCED_TABLE_NAME as referenced_table,
                    kcu.REFERENCED_COLUMN_NAME as referenced_column
                FROM information_schema.KEY_COLUMN_USAGE kcu
                WHERE kcu.TABLE_SCHEMA = ?
                  AND kcu.REFERENCED_TABLE_NAME IS NOT NULL
                ORDER BY kcu.TABLE_NAME, kcu.COLUMN_NAME
            ", [$databaseName]);

            foreach ($fkQuery as $fk) {
                $foreignKeys[] = [
                    'table' => $fk->table_name,
                    'column' => $fk->column_name,
                    'constraint' => $fk->constraint_name,
                    'referenced_table' => $fk->referenced_table,
                    'referenced_column' => $fk->referenced_column,
                ];

                if (isset($rawTables[$fk->table_name])) {
                    $rawTables[$fk->table_name]['outgoing_relations'][] = [
                        'column' => $fk->column_name,
                        'target_table' => $fk->referenced_table,
                        'target_column' => $fk->referenced_column,
                        'constraint' => $fk->constraint_name,
                    ];
                }

                if (isset($rawTables[$fk->referenced_table])) {
                    $rawTables[$fk->referenced_table]['incoming_relations'][] = [
                        'source_table' => $fk->table_name,
                        'source_column' => $fk->column_name,
                        'target_column' => $fk->referenced_column,
                        'constraint' => $fk->constraint_name,
                    ];
                }
            }
        } elseif ($driver === 'sqlite') {
            // SQLite Fallback
            $tablesQuery = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name ASC");
            foreach ($tablesQuery as $row) {
                $count = DB::table($row->name)->count();
                $rawTables[$row->name] = [
                    'name' => $row->name,
                    'engine' => 'SQLite',
                    'rows' => $count,
                    'size_bytes' => 0,
                    'size_mb' => 0,
                    'size_formatted' => '-',
                    'collation' => '-',
                    'outgoing_relations' => [],
                    'incoming_relations' => [],
                ];

                $fkList = DB::select("PRAGMA foreign_key_list('{$row->name}')");
                foreach ($fkList as $fk) {
                    $rawTables[$row->name]['outgoing_relations'][] = [
                        'column' => $fk->from,
                        'target_table' => $fk->table,
                        'target_column' => $fk->to,
                        'constraint' => 'FK_' . $row->name . '_' . $fk->from,
                    ];
                }
            }
        }

        return array_values($rawTables);
    }

    /**
     * Mendapatkan rincian kolom dan relasi untuk 1 tabel
     */
    public function getTableDetail(string $tableName): ?array
    {
        $tables = $this->getTablesWithRelations();
        $targetTable = null;
        foreach ($tables as $t) {
            if ($t['name'] === $tableName) {
                $targetTable = $t;
                break;
            }
        }

        if (!$targetTable) {
            return null;
        }

        // Ambil struktur kolom
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        $columns = [];

        if (in_array($driver, ['mysql', 'mariadb'])) {
            $cols = DB::select("SHOW FULL COLUMNS FROM `{$tableName}`");
            foreach ($cols as $c) {
                $columns[] = [
                    'field' => $c->Field,
                    'type' => $c->Type,
                    'null' => $c->Null,
                    'key' => $c->Key,
                    'default' => $c->Default,
                    'extra' => $c->Extra,
                    'comment' => $c->Comment ?? '',
                ];
            }
        }

        $targetTable['columns'] = $columns;

        // Ambil sampel data baris tabel (maksimal 50 baris terbaru)
        $dataRows = [];
        try {
            $rawRows = DB::table($tableName)->limit(50)->get();
            foreach ($rawRows as $r) {
                $rowArr = (array) $r;
                // Masking password / token field demi keamanan
                foreach ($rowArr as $k => $v) {
                    if (in_array(strtolower($k), ['password', 'remember_token', 'two_factor_secret', 'secret'])) {
                        $rowArr[$k] = '•••••••• (Tersensor)';
                    }
                }
                $dataRows[] = $rowArr;
            }
        } catch (\Throwable $e) {
            $dataRows = [];
        }

        $targetTable['data_preview'] = $dataRows;
        $targetTable['total_records'] = count($dataRows) > 0 ? (int) DB::table($tableName)->count() : 0;

        return $targetTable;
    }

    /**
     * Menjalankan proses backup database (Full atau Selective)
     *
     * @param string $type 'full' | 'selective'
     * @param array $selectedTables Daftar nama tabel jika selective
     * @param bool $compress Apakah dikompresi ke .gz
     * @param array|null $executor Informasi user yang mengeksekusi [id, name, role, email]
     * @return array [success, file_name, file_path, file_size, message]
     */
    public function createBackup(string $type = 'full', array $selectedTables = [], bool $compress = false, ?array $executor = null): array
    {
        $databaseName = config('database.connections.' . config('database.default') . '.database');
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $sanitizedDbName = Str::slug($databaseName, '_');
        
        $prefix = ($type === 'selective') ? 'partial_backup' : 'full_backup';
        $fileName = "{$sanitizedDbName}_{$prefix}_{$timestamp}.sql";
        $filePath = storage_path('app/' . $this->backupDir . '/' . $fileName);

        // Jika selective dan tabel kosong, kembalikan error
        if ($type === 'selective' && empty($selectedTables)) {
            return [
                'success' => false,
                'message' => 'Pilih setidaknya satu tabel untuk melakukan selective backup.',
            ];
        }

        // Kumpulkan daftar tabel yang akan di-backup
        $allTables = $this->getTablesWithRelations();
        $allTableNames = array_column($allTables, 'name');

        $targetTables = ($type === 'selective')
            ? array_values(array_intersect($allTableNames, $selectedTables))
            : $allTableNames;

        if (empty($targetTables)) {
            return [
                'success' => false,
                'message' => 'Tidak ada tabel valid yang ditemukan untuk dibackup.',
            ];
        }

        // Tentukan data eksekutor secara presisi (Nama pengguna asli yang login)
        $currentUser = auth()->user();
        $userRoleName = ($currentUser && method_exists($currentUser, 'getRoleNames') && $currentUser->getRoleNames()->isNotEmpty())
            ? ucfirst($currentUser->getRoleNames()->first())
            : 'Admin';

        $executorName = $executor['name'] ?? ($currentUser ? $currentUser->name : 'Sistem Otomatis (Scheduler)');
        $executorRole = $executor['role'] ?? ($currentUser ? $userRoleName : 'Scheduler');
        $executorEmail = $executor['email'] ?? ($currentUser ? $currentUser->email : 'system@veltronic.local');

        // Buka file handle untuk streaming dump
        $handle = fopen($filePath, 'w');
        if (!$handle) {
            return [
                'success' => false,
                'message' => 'Gagal membuat file cadangan di direktori storage.',
            ];
        }

        // Tulis Header Dump
        $header = "-- ========================================================\n";
        $header .= "-- Veltronic Template Database Backup Dump\n";
        $header .= "-- Host Database: " . config('database.connections.' . config('database.default') . '.host', '127.0.0.1') . "\n";
        $header .= "-- Database Name: " . $databaseName . "\n";
        $header .= "-- Backup Type: " . strtoupper($type) . " BACKUP\n";
        $header .= "-- Tables Count: " . count($targetTables) . " Tables\n";
        $header .= "-- Created By: " . $executorName . " (" . $executorRole . " - " . $executorEmail . ")\n";
        $header .= "-- Generated At: " . Carbon::now()->toIso8601String() . " (" . Carbon::now()->toDayDateTimeString() . ")\n";
        $header .= "-- Meta Tables: " . json_encode($targetTables) . "\n";
        $header .= "-- ========================================================\n\n";
        $header .= "SET FOREIGN_KEY_CHECKS=0;\n";
        $header .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n";
        $header .= "SET AUTOCOMMIT = 0;\n";
        $header .= "START TRANSACTION;\n";
        $header .= "SET time_zone = '+00:00';\n\n";

        fwrite($handle, $header);

        // Loop setiap tabel untuk dump DDL & DML
        foreach ($targetTables as $table) {
            $tableComment = "-- --------------------------------------------------------\n";
            $tableComment .= "-- Struktur Tabel & Data untuk `{$table}`\n";
            $tableComment .= "-- --------------------------------------------------------\n\n";
            fwrite($handle, $tableComment);

            // 1. Drop & Create Table DDL
            fwrite($handle, "DROP TABLE IF EXISTS `{$table}`;\n");

            try {
                $createTableResult = DB::select("SHOW CREATE TABLE `{$table}`");
                if (!empty($createTableResult)) {
                    $prop = 'Create Table';
                    $ddl = $createTableResult[0]->$prop ?? $createTableResult[0]->{'Create Table'} ?? null;
                    if ($ddl) {
                        fwrite($handle, $ddl . ";\n\n");
                    }
                }
            } catch (\Throwable $e) {
                // Skip
            }

            // 2. Insert Data DML (Chunking untuk efisiensi memori)
            $totalCount = DB::table($table)->count();
            if ($totalCount > 0) {
                fwrite($handle, "-- Dumping data tabel `{$table}` (Total {$totalCount} baris)\n");
                
                DB::table($table)->orderBy(DB::raw('1'))->chunk(500, function ($rows) use ($handle, $table) {
                    if ($rows->isEmpty()) return;

                    $firstRow = (array) $rows->first();
                    $columns = array_keys($firstRow);
                    $columnList = '`' . implode('`, `', $columns) . '`';

                    $valuesQueries = [];
                    foreach ($rows as $row) {
                        $rowArray = (array) $row;
                        $escapedValues = [];
                        foreach ($rowArray as $val) {
                            if (is_null($val)) {
                                $escapedValues[] = 'NULL';
                            } elseif (is_numeric($val) && !is_string($val)) {
                                $escapedValues[] = $val;
                            } else {
                                $escapedValues[] = "'" . addslashes((string) $val) . "'";
                            }
                        }
                        $valuesQueries[] = '(' . implode(', ', $escapedValues) . ')';
                    }

                    if (!empty($valuesQueries)) {
                        $insertSql = "INSERT INTO `{$table}` ({$columnList}) VALUES\n" . implode(",\n", $valuesQueries) . ";\n";
                        fwrite($handle, $insertSql);
                    }
                });

                fwrite($handle, "\n");
            }
        }

        // Tulis Footer Dump
        $footer = "\nCOMMIT;\n";
        $footer .= "SET FOREIGN_KEY_CHECKS=1;\n";
        $footer .= "-- Dump Selesai: " . Carbon::now()->toIso8601String() . "\n";
        fwrite($handle, $footer);
        fclose($handle);

        // Jika opsi kompresi GZIP diaktifkan
        $finalFileName = $fileName;
        $finalFilePath = $filePath;

        if ($compress && function_exists('gzopen')) {
            $gzFileName = $fileName . '.gz';
            $gzFilePath = storage_path('app/' . $this->backupDir . '/' . $gzFileName);

            $fpOut = gzopen($gzFilePath, 'wb9');
            $fpIn = fopen($filePath, 'rb');

            if ($fpOut && $fpIn) {
                while (!feof($fpIn)) {
                    gzwrite($fpOut, fread($fpIn, 1024 * 512));
                }
                fclose($fpIn);
                gzclose($fpOut);

                // Hapus file raw .sql jika berhasil dikompres
                File::delete($filePath);

                $finalFileName = $gzFileName;
                $finalFilePath = $gzFilePath;
            }
        }

        $fileSize = File::size($finalFilePath);

        // Simpan metadata manifest eksekutor
        $this->saveManifestEntry($finalFileName, [
            'file_name' => $finalFileName,
            'type' => $type,
            'tables_count' => count($targetTables),
            'size_bytes' => $fileSize,
            'executor_name' => $executorName,
            'executor_role' => $executorRole,
            'executor_email' => $executorEmail,
            'created_at' => Carbon::now()->toIso8601String(),
        ]);

        return [
            'success' => true,
            'file_name' => $finalFileName,
            'file_path' => $finalFilePath,
            'file_size' => $this->formatBytes($fileSize),
            'tables_count' => count($targetTables),
            'type' => $type,
            'executor_name' => $executorName,
            'executor_role' => $executorRole,
            'message' => "Backup database ({$type}) berhasil dibuat oleh {$executorName}: {$finalFileName} (" . $this->formatBytes($fileSize) . ")",
        ];
    }

    /**
     * Membaca file manifest.json metadata cadangan
     */
    protected function getManifest(): array
    {
        $manifestPath = storage_path('app/' . $this->backupDir . '/manifest.json');
        if (File::exists($manifestPath)) {
            try {
                $data = json_decode(File::get($manifestPath), true);
                return is_array($data) ? $data : [];
            } catch (\Throwable $e) {
                return [];
            }
        }
        return [];
    }

    /**
     * Menyimpan atau memperbarui entri pada manifest.json
     */
    protected function saveManifestEntry(string $fileName, array $metadata): void
    {
        $manifest = $this->getManifest();
        $manifest[$fileName] = $metadata;
        $manifestPath = storage_path('app/' . $this->backupDir . '/manifest.json');
        File::put($manifestPath, json_encode($manifest, JSON_PRETTY_PRINT));
    }

    /**
     * Menghapus entri pada manifest.json
     */
    protected function removeManifestEntry(string $fileName): void
    {
        $manifest = $this->getManifest();
        if (isset($manifest[$fileName])) {
            unset($manifest[$fileName]);
            $manifestPath = storage_path('app/' . $this->backupDir . '/manifest.json');
            File::put($manifestPath, json_encode($manifest, JSON_PRETTY_PRINT));
        }
    }

    /**
     * Mengambil daftar file backup yang tersimpan di storage
     */
    public function getBackupFiles(): array
    {
        $this->ensureBackupDirectoryExists();
        $path = storage_path('app/' . $this->backupDir);
        $files = File::files($path);
        $manifest = $this->getManifest();

        $backupList = [];
        foreach ($files as $file) {
            $fileName = $file->getFilename();
            // Hanya proses file .sql atau .sql.gz
            if (!Str::endsWith($fileName, ['.sql', '.sql.gz'])) {
                continue;
            }

            $size = $file->getSize();
            $mTime = $file->getMTime();
            $isCompressed = Str::endsWith($fileName, '.gz');
            $isSelective = Str::contains($fileName, 'partial_backup');

            // Ambil info eksekutor dari manifest jika ada
            $meta = $manifest[$fileName] ?? [];
            $executorName = $meta['executor_name'] ?? 'Super Admin';
            $executorRole = $meta['executor_role'] ?? 'Master';
            $executorEmail = $meta['executor_email'] ?? '';

            // Tentukan badge role
            $roleBadgeClass = 'badge-light-primary';
            $roleLower = strtolower($executorRole);
            if (str_contains($roleLower, 'master') || str_contains($roleLower, 'super')) {
                $roleBadgeClass = 'badge-light-danger';
            } elseif (str_contains($roleLower, 'admin')) {
                $roleBadgeClass = 'badge-light-primary';
            } elseif (str_contains($roleLower, 'cron') || str_contains($roleLower, 'scheduler') || str_contains($roleLower, 'sistem')) {
                $roleBadgeClass = 'badge-light-info';
            }

            $backupList[] = [
                'name' => $fileName,
                'size_bytes' => $size,
                'size_formatted' => $this->formatBytes($size),
                'type' => $isSelective ? 'Selective' : 'Full',
                'type_badge' => $isSelective ? 'badge-light-warning' : 'badge-light-success',
                'is_compressed' => $isCompressed,
                'executor_name' => $executorName,
                'executor_role' => $executorRole,
                'executor_email' => $executorEmail,
                'role_badge_class' => $roleBadgeClass,
                'created_at_timestamp' => $mTime,
                'created_at_formatted' => Carbon::createFromTimestamp($mTime)->translatedFormat('d M Y, H:i:s'),
                'created_at_diff' => Carbon::createFromTimestamp($mTime)->diffForHumans(),
            ];
        }

        // Urutkan dari file terbaru ke terlama
        usort($backupList, function ($a, $b) {
            return $b['created_at_timestamp'] <=> $a['created_at_timestamp'];
        });

        return $backupList;
    }

    /**
     * Hapus file backup dari storage
     */
    public function deleteBackupFile(string $fileName): bool
    {
        // Sanitasi nama file untuk mencegah path traversal
        $safeFileName = basename($fileName);
        $filePath = storage_path('app/' . $this->backupDir . '/' . $safeFileName);

        if (File::exists($filePath)) {
            $deleted = File::delete($filePath);
            if ($deleted) {
                $this->removeManifestEntry($safeFileName);
            }
            return $deleted;
        }

        return false;
    }

    /**
     * Restore database dari file cadangan
     */
    public function restoreBackup(string $fileName): array
    {
        $safeFileName = basename($fileName);
        $filePath = storage_path('app/' . $this->backupDir . '/' . $safeFileName);

        if (!File::exists($filePath)) {
            return [
                'success' => false,
                'message' => "Berkas cadangan {$safeFileName} tidak ditemukan di server.",
            ];
        }

        $sqlContent = '';
        if (Str::endsWith($safeFileName, '.gz')) {
            if (!function_exists('gzopen')) {
                return [
                    'success' => false,
                    'message' => 'Ekstensi PHP Zlib (gzopen) tidak aktif di server ini.',
                ];
            }

            $gz = gzopen($filePath, 'rb');
            while (!gzeof($gz)) {
                $sqlContent .= gzread($gz, 1024 * 512);
            }
            gzclose($gz);
        } else {
            $sqlContent = File::get($filePath);
        }

        if (empty(trim($sqlContent))) {
            return [
                'success' => false,
                'message' => 'Berkas cadangan kosong atau rusak.',
            ];
        }

        try {
            DB::connection()->getPdo()->exec("SET FOREIGN_KEY_CHECKS = 0;");
            DB::unprepared($sqlContent);
            DB::connection()->getPdo()->exec("SET FOREIGN_KEY_CHECKS = 1;");

            return [
                'success' => true,
                'message' => "Database berhasil direstore dari berkas cadangan {$safeFileName}.",
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Gagal merestore database: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Pengaturan Otomatisasi Backup (AppSetting)
     */
    public function getAutoBackupSettings(): array
    {
        $tables = $this->getTablesWithRelations();
        $allTableNames = array_column($tables, 'name');

        $savedTables = AppSetting::get('backup_auto_tables', '[]');
        if (is_string($savedTables)) {
            $savedTables = json_decode($savedTables, true) ?: [];
        }

        return [
            'enabled' => (bool) AppSetting::get('backup_auto_enabled', false),
            'frequency' => (string) AppSetting::get('backup_auto_frequency', 'daily'), // daily, weekly, monthly
            'time' => (string) AppSetting::get('backup_auto_time', '01:00'),
            'retention_days' => (int) AppSetting::get('backup_auto_retention_days', 7),
            'backup_type' => (string) AppSetting::get('backup_auto_type', 'full'), // full, selective
            'compression' => (bool) AppSetting::get('backup_auto_compression', true),
            'selected_tables' => $savedTables,
            'all_tables' => $allTableNames,
            'last_run_at' => AppSetting::get('backup_auto_last_run', null),
            'last_run_status' => AppSetting::get('backup_auto_last_status', null),
        ];
    }

    /**
     * Simpan pengaturan backup otomatis
     */
    public function saveAutoBackupSettings(array $data): void
    {
        AppSetting::set('backup_auto_enabled', !empty($data['enabled']) ? 1 : 0, 'backup', 'boolean');
        AppSetting::set('backup_auto_frequency', $data['frequency'] ?? 'daily', 'backup', 'string');
        AppSetting::set('backup_auto_time', $data['time'] ?? '01:00', 'backup', 'string');
        AppSetting::set('backup_auto_retention_days', (int) ($data['retention_days'] ?? 7), 'backup', 'integer');
        AppSetting::set('backup_auto_type', $data['backup_type'] ?? 'full', 'backup', 'string');
        AppSetting::set('backup_auto_compression', !empty($data['compression']) ? 1 : 0, 'backup', 'boolean');

        $tables = $data['selected_tables'] ?? [];
        if (is_array($tables)) {
            AppSetting::set('backup_auto_tables', json_encode(array_values($tables)), 'backup', 'json');
        }
    }

    /**
     * Eksekusi Otomatisasi Backup (Cron/Scheduler)
     */
    public function runScheduledAutoBackup(bool $force = false, ?array $executor = null): array
    {
        $settings = $this->getAutoBackupSettings();
        if (!$settings['enabled'] && !$force) {
            return [
                'success' => false,
                'message' => 'Otomatisasi backup sedang dinonaktifkan di pengaturan.',
            ];
        }

        $type = $settings['backup_type'];
        $selectedTables = $settings['selected_tables'];
        $compress = $settings['compression'];

        $defaultExecutor = $executor ?? [
            'name' => 'Sistem Terjadwal (Scheduler)',
            'role' => 'Cron System',
            'email' => 'cron@system.local',
        ];

        $result = $this->createBackup($type, $selectedTables, $compress, $defaultExecutor);

        // Catat timestamp & status eksekusi terakhir
        AppSetting::set('backup_auto_last_run', Carbon::now()->toIso8601String(), 'backup', 'string');
        AppSetting::set('backup_auto_last_status', $result['success'] ? 'Success' : 'Failed: ' . ($result['message'] ?? ''), 'backup', 'string');

        // Bersihkan file lama berdasarkan retensi hari
        $this->cleanOldBackups($settings['retention_days']);

        return $result;
    }

    /**
     * Membersihkan file cadangan yang lebih tua dari X hari
     */
    public function cleanOldBackups(int $retentionDays = 7): int
    {
        if ($retentionDays <= 0) {
            return 0;
        }

        $this->ensureBackupDirectoryExists();
        $path = storage_path('app/' . $this->backupDir);
        $files = File::files($path);
        $thresholdTime = Carbon::now()->subDays($retentionDays)->timestamp;
        $deletedCount = 0;

        foreach ($files as $file) {
            if ($file->getMTime() < $thresholdTime) {
                File::delete($file->getPathname());
                $deletedCount++;
            }
        }

        return $deletedCount;
    }

    /**
     * Helper Format Bytes ke B, KB, MB, GB
     */
    protected function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
