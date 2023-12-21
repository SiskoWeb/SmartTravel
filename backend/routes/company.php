<?php


use app\controllers\CompanyController;
require '../app/Controllers/companyController.php';



if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case 'list':
            CompanyController::indexAction();
            break;

        case 'show':
            if (isset($_GET['id'])) {
                CompanyController::show($_GET['id']);
            } else {
                echo "Invalid request id required";
            }
            break;

        case 'latest':
            CompanyController::latest();
            break;

            case 'create':
                CompanyController::createAction();
                break;

                case 'update':
                    if (isset($_GET['id'])) {
                   
                        CompanyController::updateAction($_GET['id']);
                    } else {
                        echo "Invalid request id required";
                    }
                   
                    break;
                 
                    
                    case 'delete':
                        if (isset($_GET['id'])) {
                            CompanyController::destroyAction($_GET['id']);
                        } else {
                            echo "Invalid request id required";
                        }
                        break;
        default:
            echo "Page Not found 404";
            break;
    }
} else {
    CompanyController::indexAction();
}
