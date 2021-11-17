<?php

namespace App\Model;

use App\Enums\FastType;
use App\Enums\Status;
use App\Interface\FastModelInterface;
use DateTime;
use Exception;
use JsonSerializable;


class Fast implements FastModelInterface, JsonSerializable
{
    protected array $dates = [
        'start',
        'end'
    ];

    public function __construct(
        protected string $start = '',
        protected int    $status = 1,
        protected string $end = '',
        protected int    $type = 0,
        protected string $elapsedTime = '')
    {
    }

    /**
     * @param $parameter
     * @return DateTime|int|string
     * @throws Exception
     */
    public function __get($parameter): DateTime|int|string
    {
        if (in_array($parameter, $this->dates)) {
            return new DateTime($this->{$parameter});
        }

        return $this->$parameter;
    }

    public function set(array $params)
    {
        foreach ($params as $param => $value) {
            $this->$param = $value;
        }
    }


    /**
     * @return string
     */
    public function print(): string
    {
        $type = FastType::fromValue($this->type);
        $status = Status::fromValue($this->status);


        return "
        --------------------------------------
        Status ($status)  \n\r
        Started Fasting $this->start \n\r  
        End date $this->end \n\r 
        Fast Type $type({$this->type}h) \n\r
        Elapsed Time $this->elapsedTime;
        --------------------------------------
        ";
    }

    public function setElapsedTime($time)
    {
        $this->elapsedTime = $time;
    }

    public function jsonSerialize()
    {
        return [
            "status" => $this->status,
            "start" => $this->start,
            "end" => $this->end,
            "type" => $this->type,
            "elapsed_time" => $this->elapsedTime
        ];
    }
}


