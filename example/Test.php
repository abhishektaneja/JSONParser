<?php
/**
 * Created by PhpStorm.
 * User: Abhishek
 * Date: 21-12-2014
 * Time: 03:55 PM
 */

include "../src/JSONParser.php";
include "Employee.php";

$json = file_get_contents("test.json");
$jsonParser = new JSONParser();
$obj = $jsonParser->map($json, new Employee());
