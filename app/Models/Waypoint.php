<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Waypoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'icon',
        'color'
    ];
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];
}