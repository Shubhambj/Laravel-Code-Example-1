<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'company_id', 'email', 'phone'
    ];
    
    /**
     * @description used to get company collection on employee.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 17.09.21
     * @version v1
     * @param 
     * @return object
     */
    public function company() {
        return $this->hasOne(Company::class, 'company_id', 'id');
    }
    
    public function getCompanyNameAttribute() {
        $companyId = $this->company_id;
        return Company::where('id', $companyId)->value('name');
    }
}
