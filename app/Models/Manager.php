<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
