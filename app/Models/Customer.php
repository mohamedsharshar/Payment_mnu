<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
        use SoftDeletes;

    protected $table = 'customers';

    protected $primaryKey = 'Code';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'Code',
        'Name',
        'Description',
        'Mobile',
        'Email',
        'CreatedIn',
        'facultyID',
        'UserLevelID'
    ];

    protected $casts = [
        'CreatedIn' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'facultyID', 'ID');
    }

    public function userLevel()
    {
        return $this->belongsTo(UserLevel::class, 'UserLevelID', 'ID');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class, 'CustomerCode', 'Code');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'customer_code', 'Code');
    }
}
