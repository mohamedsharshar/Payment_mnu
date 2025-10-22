<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->integer('ServiceType_ID');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('DueDate')->nullable()->useCurrent();
            $table->integer('BillStatus')->default(1);
            $table->string('CustomerCode', 14)->nullable();
            $table->date('BusinessDate')->nullable();
            $table->date('SettlementDate')->nullable();
            $table->timestamp('CreatedIn')->nullable();
            $table->boolean('archive')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
