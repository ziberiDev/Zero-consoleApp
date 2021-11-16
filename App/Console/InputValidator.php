<?php

namespace App\Console;

use DateTime;
use DateTimeZone;

class InputValidator
{

    public function validateStartdate($input)
    {

        $dateInputObject = DateTime::createFromFormat("Y-m-d H:i:s", $input);
        $today = new DateTime('NOW');


        if (!$dateInputObject || ($dateInputObject->format("Y-m-d H:i:s") != $input)) {
            return "Please enter valid format date.";
        } else if ($dateInputObject < $today) {
            return 'Please set starting date greater than today.';
        }

        return false;

    }

}