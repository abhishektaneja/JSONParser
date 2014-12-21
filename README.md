PHP JSONParser
==========

#### A JSON Parser to map JSON to a PHP class Object.
####
This will help to read a JSON and map it to a class object.

Eg: JSON -
```json
{
    "firstName":"Abhishek",
    "lastName":"Taneja",
    "contact": {
        "email": "abhishek.taneja@live.com",
        "twitter": "@abhishek_taneja"
    }
}
```

Application code,
```php
<?php 
$json = file_get_contents("test.json");
$jsonParser = new JSONParser();
$obj = $jsonParser->map($json, new Employee());
?>
```

Will return Object of class Employee, 
```php
object(Employee)[6]
  protected 'firstName' => string 'Abhishek' (length=8)
  protected 'lastName' => string 'Taneja' (length=6)
  protected 'contact' => 
    object(stdClass)[4]
      public 'email' => string 'abhishek.taneja@live.com' (length=24)
      public 'twitter' => string '@abhishek_taneja' (length=16)
```
