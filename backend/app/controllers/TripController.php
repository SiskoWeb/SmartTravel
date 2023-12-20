<?php
namespace app\controllers;

require 'app/models/Trip.php';
require 'app/models/Road.php';
require 'app/models/Bus.php';

use app\models\Trip;
use app\models\Road;
use app\models\Bus;




class TripController 
{



  

    public static function indexAction()
    {
        $companies = Trip::all();
 
    //    return  'index';
        echo json_encode($companies);
    }

    public static function show($id)
    {
        $road = Trip::find($id);
   
        if($road) {

        echo json_encode($road);
        return;
    } 
        self::sendResponse("there is no Trip under this $id", 404);
 
       
    }

    public static function latest()
    {
        $latestRoad = Trip::latest();
    
        if($latestRoad) {
            echo json_encode($latestRoad);
            return ;
    } 
        self::sendResponse("there is no ", 404);
    }


    public static function createAction()
    {
        // List of data expected from the user
        $requiredFields = ['departure_time', 'arrive_time', 'seats_available', 'number_bus', 'road_id'];
    
        // Validation
        self::validator($requiredFields);
    
        // Get data from the POST request
        $departure_time = $_POST['departure_time'];
        $arrive_time = $_POST['arrive_time'];
        $seats_available = $_POST['seats_available'];
        $number_bus = $_POST['number_bus'];
        $road_id = $_POST['road_id'];
    
        
        
        //check if road avaible
        $road = Road::find($road_id);
        if (!$road) {
            self::sendResponse(" road belong this id $road_id not avaible ", 404);
            return;
        }

    //check if road avaible
        $bus = Bus::find($number_bus);
        if (!$bus) {
            self::sendResponse(" Bus belong this id $number_bus not avaible", 404);
            return;
        }

        // Create a new Trip instance
        $trip = new Trip();
        $trip->setDepartureTime($departure_time);
        $trip->setArriveTime($arrive_time);
        $trip->setSeatsAvailable($seats_available);
        $trip->setNumberBus($number_bus);
        $trip->setRoadId($road_id);
    
        // Perform the creation in the database
        if ($trip->create()) {
            self::sendResponse("Trip created successfully", 201);
        } else {
            self::sendResponse("Failed to create Trip", 500);
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
        $road = Trip::find($id);

        if (!$road) {
            self::sendResponse("There is no Trip under this id: $id", 404);
            return;
        }
    
 // Get data from the POST request
$departureTime = $_POST['departure_time'] ?? null;
$arriveTime = $_POST['arrive_time'] ?? null;
$seatsAvailable = $_POST['seats_available'] ?? null;
$price = $_POST['price'] ?? null;
$numberBus = $_POST['number_bus'] ?? null;
$roadId = $_POST['road_id'] ?? null;

// Create a new instance of Trip
$updatedTrip = new Trip();
$updatedTrip->setId($id);
$updatedTrip->setDepartureTime($departureTime);
$updatedTrip->setArriveTime($arriveTime);
$updatedTrip->setSeatsAvailable($seatsAvailable);
$updatedTrip->setPrice($price);
$updatedTrip->setNumberBus($numberBus);
$updatedTrip->setRoadId($roadId);


    
        // Perform the update
        if ($updatedTrip->update()) {
            self::sendResponse("Trip updated successfully", 200);
        } else {
            self::sendResponse("Failed to update Trip", 500);
        }
    }
    

//remove company by id
    public static function destroyAction($id)
    {
      
    
        if(Trip::destroy($id)) {
            self::sendResponse("Trip Deleted successfully", 200);
        } else {
            
            self::sendResponse("Failed to Deleted Trip $id", 500);
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
