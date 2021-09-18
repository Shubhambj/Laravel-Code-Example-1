<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\EmployeeInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeInterface {

    private $employeeModel;

    public function __construct(Employee $employeeModel) {
        $this->employeeModel = $employeeModel;
    }
    
    public function getAllEmployees() {
        return $this->employeeModel->orderBy('id', 'DESC')->paginate(10);
    }
    
    public function getEmployee($employeeId) {
        return $this->employeeModel->find($employeeId);
    }
    
    public function createOrUpdateEmployee($requestData, $employeeId = null) {
        unset($requestData['_method']);
        
        if(is_null($employeeId)) {
            $result = $this->employeeModel->create($requestData);
            $action = 'created';
        } else {
            $result = $this->employeeModel->where('id', $employeeId)->update($requestData);
            $action = 'updated';
        }
        
        return !empty($result) ? ['status' => 1, 'message' => 'Successfully '.$action] : ['status' => 0, 'message' => 'Something went wrong'];
    }
    
    public function deleteEmployee($employeeId) {
        $result = $this->employeeModel->where('id', $employeeId)->delete();
        return $result ? ['status' => 1, 'message' => 'Successfully deleted'] : ['status' => 0, 'message' => 'Something went wrong'];
    }
    
}