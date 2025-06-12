<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        DB::statement('CREATE TRIGGER prevent_admin_username_insert 
                       BEFORE INSERT ON users 
                       FOR EACH ROW 
                       WHEN NEW.username = "admin" 
                       BEGIN 
                           SELECT RAISE(ABORT, "Username admin is reserved for administrators"); 
                       END');
        DB::statement('CREATE TRIGGER prevent_admin_username_update 
                       BEFORE UPDATE ON users 
                       FOR EACH ROW 
                       WHEN NEW.username = "admin" 
                       BEGIN 
                           SELECT RAISE(ABORT, "Username admin is reserved for administrators"); 
                       END');
    }
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS prevent_admin_username_insert');
        DB::statement('DROP TRIGGER IF EXISTS prevent_admin_username_update');
    }
};