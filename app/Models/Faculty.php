<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public $timestamps = false;

    protected $table = 'faculties';

    protected $primaryKey = 'ID';

    public $incrementing = true;

    protected $fillable = [
        'ID',
        'NameAR',
        'Code',
        'Account',
        'NameEN',
        'CBEMemberAccount',
        'AccountNumber',
        'Note'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'facultyID', 'ID');
    }
}
