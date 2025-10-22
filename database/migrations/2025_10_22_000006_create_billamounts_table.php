<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billamounts', function (Blueprint $table) {
            $table->bigInteger('ID')->primary();
            $table->integer('ItemSequence');
            $table->string('BillNumber', 90);
            $table->decimal('Amount', 18, 2);
            $table->string('SettlementAccountCode', 500);
            $table->string('AmountDescription', 500);
            $table->string('Currency', 500);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billamounts');
    }
};
