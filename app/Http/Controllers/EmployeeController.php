<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\EmployeeRepository;

class EmployeeController extends Controller
{
    private $employeeRepo;

    public function __construct(EmployeeRepository $employeeRepo) {
        $this->employeeRepo = $employeeRepo;
    }
    
    public function index() {
        $employees = $this->employeeRepo->getAllEmployees();
        return response()->view('employee.index', compact('employees'));
    }

    public function create() {
        return response()->view('employee.create');
    }

    public function store(Request $request) {
        $validator = $this->validateInputs($request);
        
        if($validator->fails()) {
            $errorMessage = $validator->getMessageBag()->toArray();
            return response()->json(['status' => 0, 'errors' => $errorMessage]);
        }
        
        $response = $this->employeeRepo->createOrUpdateEmployee($request->all());
        return response()->json($response);
    }

    public function show($employeeId) {
        $employee = $this->employeeRepo->getEmployee($employeeId);
        return response()->view('employee.show', compact('employee'));
    }

    public function edit($employeeId) {
        $employee = $this->employeeRepo->getEmployee($employeeId);
        return response()->view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $employeeId) {
        $validator = $this->validateInputs($request);
        
        if($validator->fails()) {
            $errorMessage = $validator->getMessageBag()->toArray();
            return response()->json(['status' => 0, 'errors' => $errorMessage]);
        }
        
        $response = $this->employeeRepo->createOrUpdateEmployee($request->all(), $employeeId);
        return response()->json($response);
    }

    public function destroy($employeeId) {
        $response = $this->employeeRepo->deleteEmployee($employeeId);
        return response()->json($response);
    }
    
    protected function validateInputs(Request $request) {
        $validationRules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ];
        
        $request->get('_method') === 'PUT' ?: $validationRules['email'] = 'email|unique:employees';
        
        return Validator::make($request->all(), $validationRules);
    }
}
