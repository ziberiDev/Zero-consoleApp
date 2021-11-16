<?php

namespace App\Model;

use DateTime;
use Exception;


class Fast extends FastModel
{
    protected array $dates = [
        'start',
        'end'
    ];

    /**
     * @param $parameter
     * @return DateTime
     * @throws Exception
     */
    public function __get($parameter)
    {
        if (in_array($parameter, $this->dates)) {
            return new DateTime($this->$parameter);
        }

        return $this->$parameter;
    }

    public function __toString()
    {
        return "
        --------------------------------------
        Status ($this->status)  \n\r
        Started Fasting $this->start \n\r   
        Fast Type {$this->type->name} 
        --------------------------------------
        ";
    }
}


