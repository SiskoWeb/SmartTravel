<?php

namespace app\models;

require 'app/models/status.php';

use app\models\Status;

require 'cors.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data =   Status::latest();
    http_response_code(200);
    echo json_encode($data);
} else {
    http_response_code(404);
    echo json_encode(["message" => 'there is a problem while retrieving status', "status" => 404]);
}
