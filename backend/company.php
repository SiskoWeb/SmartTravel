<?php


use app\controllers\CompanyController;
require 'app/Controllers/companyController.php';



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
                echo "Invalid request";
            }
            break;
        case 'latest':
            CompanyController::latest();
            break;
            case 'create':
                CompanyController::createAction();
                break;
        default:
            echo "Page Not found 404";
            break;
    }
} else {
    CompanyController::indexAction();
}
