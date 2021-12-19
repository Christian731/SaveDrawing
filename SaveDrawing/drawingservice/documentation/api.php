<?php
require("C:/xampp/htdocs/SaveDrawing/drawingservice/vendor/autoload.php");
$openapi = \OpenApi\Generator::scan(['C:/xampp/htdocs/SaveDrawing/drawingservice/controllers']);
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>