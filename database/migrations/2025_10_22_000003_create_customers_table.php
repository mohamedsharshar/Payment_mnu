<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('Code', 14)->primary();
            $table->string('Name', 500);
            $table->string('Description', 500)->nullable();
            $table->string('Mobile', 50)->nullable();
            $table->string('Email', 50)->nullable();
            $table->timestamp('CreatedIn')->nullable();
            $table->integer('facultyID')->nullable();
            $table->integer('UserLevelID')->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
