<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LoginLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_user_id',
        'username',
        'ip_address',
        'user_agent',
        'status',
        'failure_reason',
        'login_at',
    ];
    protected $casts = [
        'login_at' => 'datetime',
    ];
    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class);
    }
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
    public static function getRecentAttempts($username, $minutes = 15)
    {
        return static::where('username', $username)
            ->where('login_at', '>=', now()->subMinutes($minutes))
            ->orderBy('login_at', 'desc');
    }
}