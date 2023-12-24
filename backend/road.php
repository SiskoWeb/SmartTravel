<?php


use app\controllers\RoadController;

require 'app/Controllers/RoadController.php';
// // Enable CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Other headers to support the preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    exit();
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case 'list':
            RoadController::indexAction();
            break;

        case 'show':
            if (isset($_GET['id'])) {
                RoadController::show($_GET['id']);
            } else {
                echo "Invalid request id required";
            }
            break;

        case 'latest':
            RoadController::latest();
            break;

        case 'create':
            RoadController::createAction();
            break;

        case 'update':
            if (isset($_GET['id'])) {

                RoadController::updateAction($_GET['id']);
            } else {
                echo "Invalid request id required";
            }

            break;


        case 'delete':
            if (isset($_GET['id'])) {
                RoadController::destroyAction($_GET['id']);
            } else {
                echo "Invalid request id required";
            }
            break;
        default:
            echo "Page Not found 404";
            break;
    }
} else {
    RoadController::indexAction();
}
