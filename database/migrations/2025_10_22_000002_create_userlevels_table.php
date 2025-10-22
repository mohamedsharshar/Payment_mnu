<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('userlevels', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('UserLevelName', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('userlevels');
    }
};
