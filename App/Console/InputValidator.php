<?php

namespace App\Console;

use DateTime;
use DateTimeZone;

class InputValidator
{

    public function validateStartdate($input)
    {

        $dateInputObject = DateTime::createFromFormat("Y-m-d H:i:s", $input);
        $formattedDateInput = $dateInputObject->format("Y-m-d H:i:s");
        $today = new DateTime('NOW');


        if (!$dateInputObject || ($formattedDateInput != $input)) {
            return "Please enter valid format date.";
        } else if ($dateInputObject < $today) {
            return 'Please set starting date greater than today.';
        }

        return false;

    }

}