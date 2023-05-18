<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function companyGroups()
    {
        return $this->hasMany(CompanyGroup::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
