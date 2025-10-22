<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('NameAR', 50);
            $table->string('Code', 50)->nullable();
            $table->string('Account', 50)->nullable();
            $table->string('NameEN', 50)->nullable();
            $table->string('CBEMemberAccount', 50)->nullable();
            $table->string('AccountNumber', 50)->nullable();
            $table->string('Note', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
