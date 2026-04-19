<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis_nip',  // Login utama pengganti email
        'name',
        'email',
        'kelas',    // Khusus Siswa (Nullable)
        'telp',
        'level',    // admin, petugas, siswa
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    // ==========================================
    // DEFINISI RELASI (RELATIONSHIPS)
    // ==========================================
    /**
     * Relasi: Satu User (Siswa) bisa punya BANYAK Pengaduan
     * Cara panggil: $user->pengaduan
     */
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'user_id', 'id');
    }
    /**
     * Relasi: Satu User (Petugas/Admin) bisa memberikan BANYAK Tanggapan
     * Cara panggil: $user->tanggapan
     */
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'user_id', 'id');
    }
    // ==========================================
    // HELPER KHUSUS (OPSIONAL)
    // ==========================================
    public function isAdmin()
    {
        return $this->level === 'admin';
    }
    /**
     * Cek apakah user adalah siswa?
     */
    public function isSiswa()
    {
        return $this->level === 'siswa';
    }
}