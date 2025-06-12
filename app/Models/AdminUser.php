<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_failed_login_at' => 'datetime',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];
    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class);
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function updateLoginStats()
    {
        $this->update([
            'last_login_at' => now(),
            'login_count' => $this->login_count + 1,
            'failed_login_attempts' => 0,
        ]);
    }
    public function updateFailedLoginAttempts()
    {
        $this->update([
            'failed_login_attempts' => $this->failed_login_attempts + 1,
            'last_failed_login_at' => now(),
        ]);
    }
}