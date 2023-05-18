<?php

namespace App\AppHumanResources\Attendance\Domain;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    // Define the relationship with the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
