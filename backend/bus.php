<?php


use app\controllers\BusController;
require 'app/Controllers/BusController.php';



if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case 'list':
            BusController::indexAction();
            break;

        case 'show':
            if (isset($_GET['id'])) {
                BusController::show($_GET['id']);
            } else {
                echo "Invalid request id required";
            }
            break;

        case 'latest':
            BusController::latest();
            break;

            case 'create':
                BusController::createAction();
                break;

                case 'update':
                    if (isset($_GET['id'])) {
                   
                        BusController::updateAction($_GET['id']);
                    } else {
                        echo "Invalid request id required";
                    }
                   
                    break;
                 
                    
                    case 'delete':
                        if (isset($_GET['number_bus'])) {
                            BusController::destroyAction($_GET['number_bus']);
                        } else {
                            echo "Invalid request id required";
                        }
                        break;
        default:
            echo "Page Not found 404";
            break;
    }
} else {
    BusController::indexAction();
}
