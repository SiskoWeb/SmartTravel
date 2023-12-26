<?php

// // Enable CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://3visions.agency');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Other headers to support the preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    exit();
}
