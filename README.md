PHP JSONParser
==========

#### A JSON Parser to map JSON to a PHP class Object.
####
This will help to read a JSON and map it to a class object.

* Requires an autoloader PSR-0 

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

Class file, 
```php
<?php 
Class Emploee{

/**
* @var
* @JsonProperty("firstName")
*/
private $name;

/**
* @var
* @JsonProperty("contact")
*/
private $contactInformation;

...
...

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
object(Employee)[8]
  private 'name' => string 'Abhishek' (length=8)
  private 'lastName' => string 'Taneja' (length=6)
  public 'contactInformation' => 
    object(Contact)[12]
      protected 'email' => string 'abhishek.taneja@live.com' (length=24)
      protected 'twitter' => string '@abhishek_taneja' (length=16)
```
