<?php
namespace app\controllers;

require 'app/models/Company.php';

use app\models\Company;




class CompanyController 
{



  

    public static function indexAction()
    {
        $companies = Company::all();
 
    //    return  'index';
        echo json_encode($companies);
    }

    public static function show($id)
    {
        $company = Company::find($id);
   
        if(isset($company)) return json_encode($company);
        self::sendResponse("there is no company under this $id", 404);
        
       
    }

    public static function latest()
    {
        $latestCompanies = Company::latest();
    
        echo json_encode($latestCompanies);
    }

    
    public static function sendResponse($message, $status) {
        http_response_code($status);
        echo json_encode(["message" => $message, "status" => $status]);
    }
}
