<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    public $timestamps = true;

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
