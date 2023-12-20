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
   
        if($company) {

        echo json_encode($company);
        return;
    } 
        self::sendResponse("there is no company under this $id", 404);
 
       
    }

    public static function latest()
    {
        $latestCompanies = Company::latest();
    
        if($latestCompanies) {
            echo json_encode($latestCompanies);
            return ;
    } 
        self::sendResponse("there is no ", 404);
    }


    public static function createAction()
    {
        $name = $_POST['name']; 
        $img = $_POST['img'];  

        $company = new Company();
        $company->setName($name);
        $company->setImg($img);

        if ($company->create()) {
            self::sendResponse("Company created successfully", 201);
        } else {
            self::sendResponse("Failed to create company", 500);
        }
    }

    public static function sendResponse($message, $status) {
        http_response_code($status);
        echo json_encode(["message" => $message, "status" => $status]);
    }
}
