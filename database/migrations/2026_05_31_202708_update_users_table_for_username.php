<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('id');
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->dropColumn(['email_verified_at', 'remember_token']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
        });
    }
};
