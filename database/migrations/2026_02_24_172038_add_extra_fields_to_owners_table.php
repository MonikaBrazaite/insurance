<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('surname');
            $table->string('email')->nullable()->after('phone');
            $table->date('birth_date')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn(['phone', 'email', 'birth_date']);
        });
    }
};
