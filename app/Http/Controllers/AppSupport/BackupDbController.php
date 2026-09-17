<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Models\Profil\UserLog;
use App\Services\AppSupport\DatabaseBackupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupDbController extends Controller
{
    protected DatabaseBackupService $backupService;

    public function __construct(DatabaseBackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    /**
     * Tampilan utama halaman Backup Database & Relasi Tabel
     */
    public function index()
    {
        $overview = $this->backupService->getDatabaseOverview();
        $tables = $this->backupService->getTablesWithRelations();
        $backupFiles = $this->backupService->getBackupFiles();
        $autoSettings = $this->backupService->getAutoBackupSettings();

        return view('pages.appsupport.backup-db', compact(
            'overview',
            'tables',
            'backupFiles',
            'autoSettings'
        ));
    }

    /**
     * API untuk mendapatkan data tabel dan relasi secara realtime
     */
    public function getTablesData(): JsonResponse
    {
        $tables = $this->backupService->getTablesWithRelations();
        $overview = $this->backupService->getDatabaseOverview();

        return response()->json([
            'success' => true,
            'overview' => $overview,
            'tables' => $tables,
        ]);
    }

    /**
     * API untuk mendapatkan rincian kolom & relasi satu tabel
     */
    public function getTableRelationDetail(string $table): JsonResponse
    {
        $detail = $this->backupService->getTableDetail($table);

        if (!$detail) {
            return response()->json([
                'success' => false,
                'message' => "Tabel `{$table}` tidak ditemukan dalam skema database.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $detail,
        ]);
    }

    /**
     * Eksekusi proses backup (Full atau Selective)
     */
    public function createBackup(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|in:full,selective',
            'tables' => 'nullable|array',
            'tables.*' => 'string',
            'compression' => 'nullable|boolean',
        ]);

        $type = $request->input('type', 'full');
        $selectedTables = $request->input('tables', []);
        $compression = $request->boolean('compression', true);

        $user = auth()->user();
        $userRole = ($user && method_exists($user, 'getRoleNames') && $user->getRoleNames()->isNotEmpty()) 
            ? ucfirst($user->getRoleNames()->first()) 
            : 'Master';

        $executor = [
            'id' => $user?->id,
            'name' => $user?->name ?? 'Administrator',
            'role' => $userRole,
            'email' => $user?->email ?? '',
        ];

        $result = $this->backupService->createBackup($type, $selectedTables, $compression, $executor);

        if (!$result['success']) {
            UserLog::record(
                'appsupport',
                'backup-db',
                'Gagal Membuat Backup DB',
                "Gagal membuat cadangan database tipe: {$type}. Pesan: " . ($result['message'] ?? '-'),
                null,
                'error'
            );

            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Gagal membuat file cadangan database.',
            ], 422);
        }

        UserLog::record(
            'appsupport',
            'backup-db',
            'Buat Backup Database',
            "Berhasil membuat berkas cadangan database {$result['file_name']} (Tipe: " . strtoupper($type) . ", Ukuran: " . ($result['file_size_formatted'] ?? '-') . ")",
            null,
            'success'
        );

        // Kembalikan daftar file terbaru untuk update DOM realtime
        $updatedFiles = $this->backupService->getBackupFiles();
        $overview = $this->backupService->getDatabaseOverview();

        return response()->json([
            'success' => true,
            'message' => $result['message'],
            'backup' => $result,
            'files' => $updatedFiles,
            'overview' => $overview,
        ]);
    }

    /**
     * Unduh berkas cadangan database
     */
    public function downloadBackup(string $fileName): BinaryFileResponse|JsonResponse
    {
        $safeFileName = basename($fileName);
        $filePath = storage_path('app/backups/' . $safeFileName);

        if (!file_exists($filePath)) {
            return response()->json([
                'success' => false,
                'message' => "Berkas cadangan {$safeFileName} tidak ditemukan.",
            ], 404);
        }

        UserLog::record(
            'appsupport',
            'backup-db',
            'Unduh Backup Database',
            "Mengunduh berkas cadangan database '{$safeFileName}'"
        );

        return response()->download($filePath, $safeFileName);
    }

    /**
     * Hapus berkas cadangan database
     */
    public function deleteBackup(Request $request): JsonResponse
    {
        $request->validate([
            'file_name' => 'required|string',
        ]);

        $fileName = $request->input('file_name');
        $deleted = $this->backupService->deleteBackupFile($fileName);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => "Gagal menghapus berkas {$fileName}. Berkas mungkin tidak ditemukan.",
            ], 404);
        }

        UserLog::record(
            'appsupport',
            'backup-db',
            'Hapus Berkas Backup DB',
            "Menghapus berkas cadangan database '{$fileName}' dari penyimpanan storage"
        );

        $updatedFiles = $this->backupService->getBackupFiles();
        $overview = $this->backupService->getDatabaseOverview();

        return response()->json([
            'success' => true,
            'message' => "Berkas cadangan {$fileName} berhasil dihapus dari storage.",
            'files' => $updatedFiles,
            'overview' => $overview,
        ]);
    }

    /**
     * Restore database dari berkas cadangan
     */
    public function restoreBackup(Request $request): JsonResponse
    {
        $request->validate([
            'file_name' => 'required|string',
        ]);

        $fileName = $request->input('file_name');
        $result = $this->backupService->restoreBackup($fileName);

        if (!$result['success']) {
            UserLog::record(
                'appsupport',
                'backup-db',
                'Gagal Restore Database',
                "Gagal memulihkan database dari berkas '{$fileName}'. Pesan: " . ($result['message'] ?? '-'),
                null,
                'error'
            );

            return response()->json([
                'success' => false,
                'message' => $result['message'],
            ], 500);
        }

        UserLog::record(
            'appsupport',
            'backup-db',
            'Restore Database',
            "Berhasil memulihkan (restore) skema & data database dari berkas '{$fileName}'",
            null,
            'warning'
        );

        $overview = $this->backupService->getDatabaseOverview();
        $tables = $this->backupService->getTablesWithRelations();

        return response()->json([
            'success' => true,
            'message' => $result['message'],
            'overview' => $overview,
            'tables' => $tables,
        ]);
    }

    /**
     * Simpan konfigurasi otomatisasi backup
     */
    public function saveSettings(Request $request): JsonResponse
    {
        $request->validate([
            'frequency' => 'required|in:daily,weekly,monthly',
            'time' => 'required|string',
            'retention_days' => 'required|integer|min:1|max:365',
            'backup_type' => 'required|in:full,selective',
            'selected_tables' => 'nullable|array',
        ]);

        $data = [
            'enabled' => $request->boolean('enabled'),
            'frequency' => $request->input('frequency'),
            'time' => $request->input('time'),
            'retention_days' => (int) $request->input('retention_days'),
            'backup_type' => $request->input('backup_type'),
            'compression' => $request->boolean('compression'),
            'selected_tables' => $request->input('selected_tables', []),
        ];

        $this->backupService->saveAutoBackupSettings($data);
        $savedSettings = $this->backupService->getAutoBackupSettings();

        UserLog::record(
            'appsupport',
            'backup-db',
            'Simpan Pengaturan Auto Backup',
            "Memperbarui konfigurasi jadwal otomatisasi backup (Frekuensi: {$data['frequency']}, Jam: {$data['time']}, Retensi: {$data['retention_days']} hari)"
        );

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan otomatisasi backup berhasil diperbarui.',
            'settings' => $savedSettings,
        ]);
    }

    /**
     * Uji coba jalankan backup otomatis langsung
     */
    public function testAutoBackup(): JsonResponse
    {
        $user = auth()->user();
        $userRole = ($user && method_exists($user, 'getRoleNames') && $user->getRoleNames()->isNotEmpty()) 
            ? ucfirst($user->getRoleNames()->first()) 
            : 'Master';

        $executor = [
            'id' => $user?->id,
            'name' => $user?->name ?? 'Administrator',
            'role' => $userRole,
            'email' => $user?->email ?? '',
        ];

        $result = $this->backupService->runScheduledAutoBackup(true, $executor);

        if (!$result['success']) {
            UserLog::record(
                'appsupport',
                'backup-db',
                'Gagal Uji Coba Auto Backup',
                "Gagal menjalankan uji coba otomatisasi backup. Pesan: " . ($result['message'] ?? '-'),
                null,
                'error'
            );

            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Gagal mengeksekusi uji coba otomatisasi backup.',
            ], 422);
        }

        UserLog::record(
            'appsupport',
            'backup-db',
            'Uji Coba Auto Backup',
            "Berhasil mengeksekusi uji coba backup otomatis: " . ($result['file_name'] ?? '-'),
            null,
            'success'
        );

        $updatedFiles = $this->backupService->getBackupFiles();
        $overview = $this->backupService->getDatabaseOverview();
        $settings = $this->backupService->getAutoBackupSettings();

        return response()->json([
            'success' => true,
            'message' => 'Uji coba backup otomatis berhasil dieksekusi: ' . ($result['file_name'] ?? ''),
            'backup' => $result,
            'files' => $updatedFiles,
            'overview' => $overview,
            'settings' => $settings,
        ]);
    }
}

