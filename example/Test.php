<?php
/**
 * Created by PhpStorm.
 * User: Abhishek
 * Date: 21-12-2014
 * Time: 03:55 PM
 */

ini_set("display_errors", "ON");
error_reporting(E_ALL);

include "../src/autoload.php";

$json = file_get_contents("test.json");

$jsonParser = new JSONParser();

$obj = $jsonParser->map($json, new Employee());

var_dump($obj);
