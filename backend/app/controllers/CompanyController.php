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

        if ($company) {

            echo json_encode($company);
            return;
        }
        self::sendResponse("there is no company under this $id", 404);
    }

    public static function latest()
    {
        $latestCompanies = Company::latest();

        if ($latestCompanies) {
            echo json_encode($latestCompanies);
            return;
        }
        self::sendResponse("there is no ", 404);
    }


    public static function createAction()
    {

        //list of data expect user send it 
        $requiredFields = ['name'];

        //validation
        self::validator($requiredFields);

        $name = $_POST['name'];
        // $img = $_FILES['img'];

        //check if name exist 
        $isExistSameName = Company::where('name', $name);
        if ($isExistSameName) {
            self::sendResponse("there is  company under this $name", 404);
            return;
        }
        $fileInputName = 'img';
        $targetDirectory = 'upload/company/';




        //upload img
        $img_url = self::uploadImage($fileInputName, $targetDirectory, $name);
        if (!$img_url) {

            self::sendResponse("Failed to upload image or invalid file extension.", 500);
            return;
        }
        $company = new Company();
        $company->setName($name);
        $company->setImg($img_url);

        if ($company->create()) {
            self::sendResponse("Company created successfully", 201);
        } else {
            self::sendResponse("Failed to create company", 500);
        }
    }

    public static function updateAction($id)
    {



        //check if id exist
        if ($id === null) {
            self::sendResponse("id required", 404);
            return;
        }



        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $img = isset($_FILES['img']) ? $_FILES['img'] : null;



        //check if id exist 
        $company = Company::find($id);



        if (!$company) {
            self::sendResponse("there is no company under this $id", 404);
            return;
        }



        //check if name exist 
        $isExistSameName = Company::where('name', $name);
        if ($isExistSameName) {
            self::sendResponse("there is  company under this $name", 404);
            return;
        }

        //create new instanse cuz first one connot pass to it a parrms 
        $company = new Company();
        if ($name !== null) {
            $company->setId($id);
            $company->setName($name);
        }

        if ($img !== null) {

            $fileInputName = 'img';
            $targetDirectory = 'uploads/company/';




            //upload img
            $img_url = self::uploadImage($fileInputName, $targetDirectory, $name);
            if (!$img_url) {

                self::sendResponse("Failed to upload image or invalid file extension.", 500);
                return;
            }
            $company->setImg($img_url);
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


        if (Company::destroy($id)) {
            self::sendResponse("Company Deleted successfully", 200);
        } else {

            self::sendResponse("Failed to Deleted company $id", 500);
        }
    }

    public static function sendResponse($message, $status)
    {
        http_response_code($status);
        echo json_encode(["message" => $message, "status" => $status]);
    }


    public static function validator($requiredFields = [])
    {
        // Validate data (you may want to add more validation)

        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                self::sendResponse("Incomplete data. Missing field:  {$field}", 401);
            }
        }
    }

    // Function to handle image upload
    public static function uploadImage($fileInput, $targetDir, $nameImg)
    {
        // Check if the file is submitted
        if (!isset($_FILES[$fileInput]) || !is_uploaded_file($_FILES[$fileInput]['tmp_name'])) {
            return false;
        }

        // Create the target directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Generate a unique filename (you can modify this logic as needed)
        $uniqueFilename = uniqid($nameImg . '_') . '_' . time();
        $targetPath = $targetDir . $uniqueFilename;

        // Get the file extension
        $imageFileType = strtolower(pathinfo($_FILES[$fileInput]['name'], PATHINFO_EXTENSION));

        // Define the allowed extensions
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        // Check if the file has a valid extension and move it to the target directory
        if (
            in_array($imageFileType, $allowedExtensions) &&
            move_uploaded_file($_FILES[$fileInput]['tmp_name'], $targetPath)
        ) {
            return $targetPath; // Return the path of the uploaded image
        } else {
            return false; // Failed to upload image or invalid file extension
        }
    }
}
