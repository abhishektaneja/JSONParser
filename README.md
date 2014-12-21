JSONParser
==========

A JSON Parser to map JSON to class Object.

This will help to read a JSON and map it to a class object.

Eg: -
{
    "firstName":"Abhishek",
    "lastName":"Taneja",
    "contact": {
        "email": "abhishek.taneja@live.com",
        "twitter": "@abhishek_taneja"
    }
}

Application code,

$json = file_get_contents("test.json");
$jsonParser = new JSONParser();
$obj = $jsonParser->map($json, new Employee());
