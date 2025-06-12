<?php
namespace Database\Seeders;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::updateOrCreate(
            ['username' => 'admin'],
            [
                'username' => 'admin',
                'email' => 'admin@qgroup.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );
    }
}