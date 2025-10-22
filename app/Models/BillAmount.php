<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillAmount extends Model
{
    public $timestamps = false;

    protected $table = 'billamounts';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ItemSequence',
        'BillNumber',
        'Amount',
        'SettlementAccountCode',
        'AmountDescription',
        'Currency'
    ];

    protected $casts = [
        'Amount' => 'decimal:2',
        'ItemSequence' => 'integer'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'BillNumber', 'ID');
    }
}
