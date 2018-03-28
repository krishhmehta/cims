<?php
    require_once '../twilio-php/vendor/autoload.php'; // Loads the library
    use Twilio\Rest\Client;
//send sms logic   
        // Your Account Sid and Auth Token from twilio.com/user/account
        $sid = "AC4867154eb3877022fdd12921d57ca41c";
        $token = "63c01c290a13c7652cf255a7d400513d";
        $client = new Client($sid, $token);
        $val=$client->messages
            ->create(
                "+918200669270",
                array(
                    "from" => "+16182484689",
                    "body" => "Scientia Test message!",
                )
            );
            var_dump($val);
        ?>