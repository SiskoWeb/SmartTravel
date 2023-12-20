<?php
namespace app\controllers;

require 'app/models/Bus.php';

use app\models\Bus;




class BusController 
{



  

    public static function indexAction()
    {
        $companies = Bus::all();
 
    //    return  'index';
        echo json_encode($companies);
    }

    public static function show($id)
    {
        $bus = Bus::find($id);
   
        if($bus) {

        echo json_encode($bus);
        return;
    } 
        self::sendResponse("there is no Bus under this $id", 404);
 
       
    }

    public static function latest()
    {
        $latestCompanies = Bus::latest();
    
        if($latestCompanies) {
            echo json_encode($latestCompanies);
            return ;
    } 
        self::sendResponse("there is no ", 404);
    }


    public static function createAction()
    {
        $companyID = $_POST['companyID'];
        $capacity = $_POST['capacity']; 
        $cost_per_km = $_POST['cost_per_km'];  

        $Bus = new Bus();
        $Bus->setCompanyID($companyID);
        $Bus->setCapacity($capacity);
        $Bus->setCostPerKm($cost_per_km);
    

        if ($Bus->create()) {
            self::sendResponse("Bus created successfully", 201);
        } else {
            self::sendResponse("Failed to create Bus", 500);
        }
    }

    public static function updateAction($id)
    {
    

       
    //       //check if id exist
    //     if($id === null) {
    //         self::sendResponse("id required", 404);
    //         return;
    //     }

       
        
    //     $name = isset($_POST['name']) ? $_POST['name'] : null; 
    //     $img = isset($_POST['img']) ? $_POST['img'] : null;   
    //     $name = isset($_POST['name']) ? $_POST['name'] : null; 
    //     $img = isset($_POST['img']) ? $_POST['img'] : null; 


    //     //check if id exist 
    //     $bus = Bus::find($id);

    //     if (!$bus) {
    //         self::sendResponse("there is no Bus under this $id", 404);
    //         return;
    //     }
    // //create new instanse cuz first one connot pass to it a parrms 
    //     $bus = new Bus();   
    //     if ($name !== null) {
    //         $bus->setId($id);
    //         $bus->setName($name);
    //     }

    //     if ($img !== null) {
    //         $bus->setImg($img);
    //     }

    //     if ($bus->update()) {
    //         self::sendResponse("Bus updated successfully", 200);
    //     } else {
    //         self::sendResponse("Failed to update Bus", 500);
    //     }
    }

//remove Bus by id
    public static function destroyAction($id)
    {
      
    
        if(Bus::destroy($id)) {
            self::sendResponse("Bus Deleted successfully", 200);
        } else {
            
            self::sendResponse("Failed to Deleted Bus $id", 500);
        }
    }

    public static function sendResponse($message, $status) {
        http_response_code($status);
        echo json_encode(["message" => $message, "status" => $status]);
    }
}
