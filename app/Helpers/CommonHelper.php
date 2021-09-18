<?php

namespace App\Helpers;

use App\Models\Company;

class CommonHelper {
    
    public static function getAllCompanies() {
        return Company::all(['id', 'name']);
    }
    
}