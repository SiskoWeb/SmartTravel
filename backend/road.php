<?php


use app\controllers\RoadController;

require 'app/Controllers/RoadController.php';
// // Enable CORS
require 'cors.php';


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
