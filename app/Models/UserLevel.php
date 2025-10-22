<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    public $timestamps = false;

    protected $table = 'userlevels';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'UserLevelName'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'UserLevelID', 'ID');
    }
}
