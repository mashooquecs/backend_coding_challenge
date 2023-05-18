<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyGroup extends Model
{
    use HasFactory;
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function subgroups()
    {
        return $this->hasMany(CompanyGroup::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(CompanyGroup::class, 'parent_id');
    }
}
