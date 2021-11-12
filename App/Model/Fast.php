<?php

namespace App\Model;

use DateTime;
use Exception;


class Fast extends Model
{

    protected array $dates = [
        'start',
        'end'
    ];

    protected array $guarded = [
        "type"
    ];


    public function __construct(
        protected bool            $type,
        protected string|DateTime $start,
        protected string|DateTime $end,
    )
    {

    }

    /**
     * @param $parameter
     * @return DateTime
     * @throws Exception
     */
    public function __get($parameter)
    {
        if (in_array($parameter, $this->dates) && !in_array($parameter, $this->guarded)) {
            return new DateTime($this->$parameter);
        } elseif (in_array($parameter, $this->guarded)) {
            throw new Exception('guarded property');
        }

        return $this->$parameter;
    }
}


