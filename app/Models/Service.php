<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;

    protected $table = 'services';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'SERVICESName',
        'value'
    ];

    protected $casts = [
        'value' => 'float'
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class, 'ServiceType_ID', 'ID');
    }
}
