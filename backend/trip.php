<?php


use app\controllers\TripController;
require 'app/Controllers/TripController.php';



if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case 'list':
            TripController::indexAction();
            break;

        case 'show':
            if (isset($_GET['id'])) {
                TripController::show($_GET['id']);
            } else {
                echo "Invalid request id required";
            }
            break;

        case 'latest':
            TripController::latest();
            break;

            case 'create':
                TripController::createAction();
                break;

                case 'update':
                    if (isset($_GET['id'])) {
                   
                        TripController::updateAction($_GET['id']);
                    } else {
                        echo "Invalid request id required";
                    }
                   
                    break;
                 
                    
                    case 'delete':
                        if (isset($_GET['id'])) {
                            TripController::destroyAction($_GET['id']);
                        } else {
                            echo "Invalid request id required";
                        }
                        break;
        default:
            echo "Page Not found 404";
            break;
    }
} else {
    TripController::indexAction();
}
