<?php
// api/index.php

header("Content-Type: application/json");

$data = [
    'message' => 'Hello, World!',
];

echo json_encode($data);
