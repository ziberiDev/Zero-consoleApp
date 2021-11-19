<?php

namespace App\Console;

use DateTime;
use DateTimeZone;

class InputValidator
{

    /**
     * Validates passed string if it is in (Y-m-d H:i:s) date format
     * @param string $input
     * @return false|string
     */
    public function validateStartDate(string $input): bool|string
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