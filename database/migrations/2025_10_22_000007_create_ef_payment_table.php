<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ef_payment', function (Blueprint $table) {
            $table->bigInteger('Id')->primary();
            $table->string('Billing_Account', 450);
            $table->string('BillNumber', 90);
            $table->timestamp('Payment_Date')->useCurrent();
            $table->timestamp('Processing_Date')->useCurrent();
            $table->decimal('Amount', 18, 2);
            $table->string('Transaction_Number', 20);
            $table->string('Payment_Method', 20)->nullable();
            $table->string('Access_Channel', 20);
            $table->string('Bank_Id', 20)->nullable();
            $table->string('Branch_Id', 20)->nullable();
            $table->string('District_Code', 20)->nullable();
            $table->string('Bulk_Amount_Sequence', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ef_payment');
    }
};
