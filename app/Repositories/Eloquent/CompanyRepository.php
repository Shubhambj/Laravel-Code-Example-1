<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CompanyInterface;
use App\Models\Company;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CompanyRepository implements CompanyInterface {

    private $companyModel;

    public function __construct(Company $companyModel) {
        $this->companyModel = $companyModel;
    }
    
    public function getAllCompanies() {
        return $this->companyModel->orderBy('id', 'DESC')->paginate(10);
    }
    
    public function getCompany($companyId) {
        return $this->companyModel->find($companyId);
    }
    
    public function createOrUpdateCompany(Request $request, $companyId = null) {
        $requestData = $request->all();
        unset($requestData['_method']);
        
        $companyLogo = $this->uploadCompanyLogo($request);
        if(is_array($companyLogo)) {
            return $companyLogo;
        }
        
        $requestData['logo'] = $companyLogo;
        if(is_null($companyId)) {
            $result = $this->companyModel->create($requestData);
            $action = 'created';
        } else {
            $result = $this->companyModel->where('id', $companyId)->update($requestData);
            $action = 'updated';
        }
        
        return !empty($result) ? ['status' => 1, 'message' => 'Successfully '.$action] : ['status' => 0, 'message' => 'Something went wrong'];
    }
    
    public function deleteCompany($companyId) {
        $result = $this->companyModel->find($companyId)->delete();
        return $result ? ['status' => 1, 'message' => 'Successfully deleted'] : ['status' => 0, 'message' => 'Something went wrong'];
    }
    
    function uploadCompanyLogo(Request $request) {
        if($request->hasFile('logo')) {
            $file = $request->file('logo');

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            if($height > 100 && $width > 100) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = 'logo_'.time().'.'.$fileExtension;
                $filePath = storage_path('app/public/images/company');

                $status = $file->move($filePath, $fileName);

                return $fileName;
            } else {
                return ['status' => 0, 'errors' => ['logo' => ['Invalid image (HxW should be minimum 100x100)']]];
            }
        }
        return null;
    }
    
}