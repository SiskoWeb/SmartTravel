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

    public static function show($number_bus)
    {
        $bus = Bus::find($number_bus);

        if ($bus) {

            echo json_encode($bus);
            return;
        }
        self::sendResponse("there is no Bus under thisid  $number_bus", 404);
    }

    public static function latest()
    {
        $latestCompanies = Bus::latest();

        if ($latestCompanies) {
            echo json_encode($latestCompanies);
            return;
        }
        self::sendResponse("there is no ", 404);
    }


    public static function createAction()
    {
        //list of data expect user send it 
        $requiredFields = ['companyID', 'capacity', 'cost_per_km'];

        //validation
        self::validator($requiredFields);

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



    public static function updateAction($number_bus)
    {
        //  //list of data expect user send it 
        //  $requiredFields = ['companyID', 'capacity', 'cost_per_km'];

        // self::validator($requiredFields);
        //   //check if id exist
        // if($number_bus === null) {
        //     self::sendResponse("id required", 401);
        //     return;
        // }



        $companyID = isset($_POST['companyID']) ? $_POST['companyID'] : null;
        $capacity = isset($_POST['capacity']) ? $_POST['capacity'] : null;
        $cost_per_km = isset($_POST['cost_per_km']) ? $_POST['cost_per_km'] : null;



        //check if id exist 
        $bus = Bus::find($number_bus);

        if (!$bus) {
            self::sendResponse("there is no Bus under this $number_bus", 404);
            return;
        }
        //create new instanse cuz first one connot pass to it a parrms 
        $bus = new Bus();
        if ($capacity !== null) {

            $bus->setCapacity($capacity);
            $bus->setNumberBus($number_bus);
        }

        if ($cost_per_km !== null) {
            $bus->setCostPerKm($cost_per_km);
        }
        if ($companyID !== null) {
            $bus->setCompanyID($companyID);
        }

        if ($bus->update()) {
            self::sendResponse("Bus updated successfully", 200);
        } else {
            self::sendResponse("Failed to update Bus", 500);
        }
    }


    //remove Bus by id
    public static function destroyAction($number_bus)
    {


        if (Bus::destroy($number_bus)) {
            self::sendResponse("Bus Deleted successfully", 200);
        } else {

            self::sendResponse("Failed to Deleted Bus $number_bus", 500);
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
}
