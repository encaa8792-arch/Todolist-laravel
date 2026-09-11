<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_photo') && Schema::hasColumn('users', 'avatar')) {
                DB::statement('ALTER TABLE users DROP COLUMN profile_photo');
            }
            if (Schema::hasColumn('users', 'profile_photo') && !Schema::hasColumn('users', 'avatar')) {
                $table->renameColumn('profile_photo', 'avatar');
            }
            if (!Schema::hasColumn('users', 'avatar') && !Schema::hasColumn('users', 'profile_photo')) {
                $table->string('avatar')->nullable()->after('password');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'avatar') && !Schema::hasColumn('users', 'profile_photo')) {
                $table->renameColumn('avatar', 'profile_photo');
            }
        });
    }
};
