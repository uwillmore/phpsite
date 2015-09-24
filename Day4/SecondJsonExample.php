<?php

// json is an string that descibes some data records so they can be turned into php objects.
// [] defines array, {} defines an object with quotes properties and values, separates by comas.
// Here address is an object in the object with properies firstName, LastName, and age
// phone numbers is an array of objects with each object having properties type and number to allow
// for multiple phone numbers per person
$json = '[
          {
         "firstName": "John",
         "lastName": "Smith",
         "age": 25,
         "address":
         {
             "streetAddress": "21 2nd Street",
             "city": "New York",
             "state": "NY",
             "postalCode": "10021"
         },
         "phoneNumber":
         [
             {
               "type": "home",
               "number": "212 555-1234"
             },
             {
               "type": "fax",
               "number": "646 555-4567"
             }
         ]
        },



        {
       "firstName": "Bob",
       "lastName": "Smitherthson",
       "age": 257,
       "address":
       {
           "streetAddress": "211 2nd Street",
           "city": "New Yorky",
           "state": "NY",
           "postalCode": "1021"
       },
       "phoneNumber":
       [
           {
             "type": "home",
             "number": "222 555-1234"
           },
           {
             "type": "fax",
             "number": "646 555-4567"
           }
       ]
   }

   ]';


// lets see what the data looks like when we print that string.
print $json;

// Decoding the Json string creates a PHP array of objects
$data = json_decode($json);



// now lets print the array of object to look at the data again,
print_r($data);


// accessing the array to get to the object properties inside the object.
print $data[0]->phoneNumber[0]->number ."\r\n";

// travering the entire array to list fax numbers.
foreach($data as $person){
    foreach($person->phoneNumber as $phoneStuff){

        if ($phoneStuff->type == "fax"){
            print $person->firstName. "'s fax number is "
                . $phoneStuff->number. "\r\n";
        }
    }


}






?>

