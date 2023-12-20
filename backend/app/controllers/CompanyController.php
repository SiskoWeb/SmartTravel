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
   //list of data expect user send it 
   $requiredFields = ['name', 'img'];

   //validation
   self::validator($requiredFields);

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

    public static function updateAction($id)
    {
    
    //   //list of data expect user send it 
    //   $requiredFields = ['name', 'img'];

    //   self::validator($requiredFields);
       
          //check if id exist
        if($id === null) {
            self::sendResponse("id required", 404);
            return;
        }

       
        
        $name = isset($_POST['name']) ? $_POST['name'] : null; 
        $img = isset($_POST['img']) ? $_POST['img'] : null;   


        //check if id exist 
        $company = Company::find($id);

        if (!$company) {
            self::sendResponse("there is no company under this $id", 404);
            return;
        }
    //create new instanse cuz first one connot pass to it a parrms 
        $company = new Company();   
        if ($name !== null) {
            $company->setId($id);
            $company->setName($name);
        }

        if ($img !== null) {
            $company->setImg($img);
        }

        if ($company->update()) {
            self::sendResponse("Company updated successfully", 200);
        } else {
            self::sendResponse("Failed to update company", 500);
        }
    }

//remove company by id
    public static function destroyAction($id)
    {
      
    
        if(Company::destroy($id)) {
            self::sendResponse("Company Deleted successfully", 200);
        } else {
            
            self::sendResponse("Failed to Deleted company $id", 500);
        }
    }

    public static function sendResponse($message, $status) {
        http_response_code($status);
        echo json_encode(["message" => $message, "status" => $status]);
    }

    public static function validator($requiredFields = []){
        // Validate data (you may want to add more validation)

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field])) {
        self::sendResponse("Incomplete data. Missing field:  {$field}", 401);
        
    }
}
    }
}
