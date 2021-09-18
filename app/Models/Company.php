<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'logo', 'website'
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($company) {
            $company->employees()->delete();
        });
    }
    
    public function employees() {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }
}
