<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\CompanyRepository;

class CompanyController extends Controller
{
    private $companyRepo;

    public function __construct(CompanyRepository $companyRepo) {
        $this->companyRepo = $companyRepo;
    }
    
    public function index() {
        $companies = $this->companyRepo->getAllCompanies();
        return response()->view('company.index', compact('companies'));
    }

    public function create() {
        return response()->view('company.create');
    }

    public function store(Request $request) {
        $validator = $this->validateInputs($request);
        
        if($validator->fails()) {
            $errorMessage = $validator->getMessageBag()->toArray();
            return response()->json(['status' => 0, 'errors' => $errorMessage]);
        }
        
        $response = $this->companyRepo->createOrUpdateCompany($request);
        return response()->json($response);
    }

    public function show($companyId) {
        $company = $this->companyRepo->getCompany($companyId);
        return response()->view('company.show', compact('company'));
    }

    public function edit($companyId) {
        $company = $this->companyRepo->getCompany($companyId);
        return response()->view('company.edit', compact('company'));
    }

    public function update(Request $request, $companyId) {
        $validator = $this->validateInputs($request);
        
        if($validator->fails()) {
            $errorMessage = $validator->getMessageBag()->toArray();
            return response()->json(['status' => 0, 'errors' => $errorMessage]);
        }
        
        $response = $this->companyRepo->createOrUpdateCompany($request, $companyId);
        return response()->json($response);
    }

    public function destroy($companyId) {
        $response = $this->companyRepo->deleteCompany($companyId);
        return response()->json($response);
    }
    
    protected function validateInputs(Request $request) {
        $validationRules = [
            'name' => 'required|string',
            'email' => 'email|unique:companies',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        
        return Validator::make($request->all(), $validationRules);
    }
}
