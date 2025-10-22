<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    protected $primaryKey = 'ID';

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'ServiceType_ID',
        'DueDate',
        'BillStatus',
        'CustomerCode',
        'BusinessDate',
        'SettlementDate',
        'CreatedIn',
        'archive'
    ];

    protected $casts = [
        'DueDate' => 'datetime',
        'BusinessDate' => 'date',
        'SettlementDate' => 'date',
        'CreatedIn' => 'datetime',
        'archive' => 'boolean',
        'BillStatus' => 'integer',
        'ServiceType_ID' => 'integer'
    ];

    protected $attributes = [
        'BillStatus' => 1
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerCode', 'Code');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'ServiceType_ID', 'ID');
    }

    public function billAmounts()
    {
        return $this->hasMany(BillAmount::class, 'BillNumber', 'ID');
    }

    public function payments()
    {
        return $this->hasMany(EfPayment::class, 'BillNumber', 'ID');
    }

    public function scopeActive($query)
    {
        return $query->where('BillStatus', 1);
    }

    public function scopeArchived($query)
    {
        return $query->where('archive', true);
    }

    public function scopeNotArchived($query)
    {
        return $query->where('archive', false)->orWhereNull('archive');
    }
}
