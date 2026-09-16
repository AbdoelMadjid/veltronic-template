<?php

namespace App\Models\Profil;

use App\Models\UserManagement\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'users_details';

    protected $fillable = [
        'user_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'moto_hidup',
        'kewarganegaraan',
        'berlaku_hingga',
        'foto_ktp',
        'alamat_jalan',
        'blok',
        'nomor_rumah',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'no_hp',
    ];

    protected $appends = [
        'foto_ktp_url',
        'alamat_lengkap',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFotoKtpUrlAttribute(): ?string
    {
        if ($this->foto_ktp) {
            if (str_starts_with($this->foto_ktp, 'http://') || str_starts_with($this->foto_ktp, 'https://')) {
                return $this->foto_ktp;
            }
            return asset('storage/' . $this->foto_ktp);
        }
        return null;
    }

    public function getAlamatLengkapAttribute(): string
    {
        $parts = [];
        if ($this->alamat_jalan) $parts[] = $this->alamat_jalan;
        if ($this->blok) $parts[] = 'Blok ' . $this->blok;
        if ($this->nomor_rumah) $parts[] = 'No. ' . $this->nomor_rumah;
        if ($this->rt || $this->rw) $parts[] = 'RT ' . ($this->rt ?? '-') . ' / RW ' . ($this->rw ?? '-');
        if ($this->desa) $parts[] = 'Desa/Kel. ' . $this->desa;
        if ($this->kecamatan) $parts[] = 'Kec. ' . $this->kecamatan;
        if ($this->kabupaten) $parts[] = $this->kabupaten;
        if ($this->provinsi) $parts[] = 'Prov. ' . $this->provinsi;
        if ($this->kode_pos) $parts[] = $this->kode_pos;

        return count($parts) > 0 ? implode(', ', $parts) : '-';
    }
}
