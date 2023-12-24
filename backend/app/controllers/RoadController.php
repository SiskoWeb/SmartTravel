<?php

namespace app\controllers;

require 'app/models/Road.php';

use app\models\Road;




class RoadController
{





    public static function indexAction()
    {
        $companies = Road::all();

        //    return  'index';
        echo json_encode($companies);
    }

    public static function show($id)
    {
        $road = Road::find($id);

        if ($road) {

            echo json_encode($road);
            return;
        }
        self::sendResponse("there is no Road under this $id", 404);
    }

    public static function latest()
    {
        $latestRoad = Road::latest();

        if ($latestRoad) {
            echo json_encode($latestRoad);
            return;
        }
        self::sendResponse("there is no ", 404);
    }


    public static function createAction()
    {



        // List of data expected from the user
        $requiredFields = ['departure', 'destination', 'distance_km', 'distance_minute'];

        // Validation
        self::validator($requiredFields);

        // Get data from the POST request
        $departure = $_POST['departure'];
        $destination = $_POST['destination'];
        $distance_km = $_POST['distance_km'];
        $distance_minute = $_POST['distance_minute'];

        // Create a new Road instance
        $road = new Road();
        $road->setDeparture($departure);
        $road->setDestination($destination);
        $road->setDistanceKm($distance_km);
        $road->setDistanceMinute($distance_minute);

        // Perform the creation in the database
        if ($road->create()) {
            self::sendResponse("Road created successfully", 201);
        } else {
            self::sendResponse("Failed to create Road", 500);
        }
    }


    public static function updateAction($id)
    {


        // Check if id exists
        if ($id === null) {
            self::sendResponse("id required", 404);
            return;
        }

        // Check if Road with given id exists
        $road = Road::find($id);

        if (!$road) {
            self::sendResponse("There is no Road under this id: $id", 404);
            return;
        }

        // Get data from the POST request
        $departure = isset($_POST['departure']) ? $_POST['departure'] : null;
        $destination = isset($_POST['destination']) ? $_POST['destination'] : null;
        $distance_km = isset($_POST['distance_km']) ? $_POST['distance_km'] : null;
        $distance_minute = isset($_POST['distance_minute']) ? $_POST['distance_minute'] : null;

        // Create a new instance of Road
        $updatedRoad = new Road();
        $updatedRoad->setId($id);
        $updatedRoad->setDeparture($departure);
        $updatedRoad->setDistanceKm($distance_km);
        $updatedRoad->setDestination($destination);
        $updatedRoad->setDistanceMinute($distance_minute);


        // Perform the update
        if ($updatedRoad->update()) {
            self::sendResponse("Road updated successfully", 200);
        } else {
            self::sendResponse("Failed to update Road", 500);
        }
    }


    //remove company by id
    public static function destroyAction($id)
    {


        if (Road::destroy($id)) {
            self::sendResponse("Road Deleted successfully", 200);
        } else {

            self::sendResponse("Failed to Deleted Road $id", 500);
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
