<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EfPayment extends Model
{
    public $timestamps = false;

    protected $table = 'ef_payment';

    protected $primaryKey = 'Id';

    protected $fillable = [
        'Billing_Account',
        'BillNumber',
        'Payment_Date',
        'Processing_Date',
        'Amount',
        'Transaction_Number',
        'Payment_Method',
        'Access_Channel',
        'Bank_Id',
        'Branch_Id',
        'District_Code',
        'Bulk_Amount_Sequence'
    ];

    protected $casts = [
        'Payment_Date' => 'datetime',
        'Processing_Date' => 'datetime',
        'Amount' => 'decimal:2'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'BillNumber', 'ID');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Billing_Account', 'Code');
    }
}
