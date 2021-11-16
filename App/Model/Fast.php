<?php

namespace App\Model;

use App\Enums\FastType;
use App\Enums\Status;
use App\Interface\FastModelInterface;
use DateTime;
use Exception;


class Fast implements FastModelInterface
{
    protected array $dates = [
        'start',
        'end'
    ];

    public function __construct(
        protected string $start = '',
        protected int    $status = 0,
        protected string $end = '',
        protected int    $type = 0,
        protected string $elapsedTime = '')
    {
    }

    /**
     * @param $parameter
     * @return DateTime|mixed
     * @throws Exception
     */
    public function __get($parameter)
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

    public function __toString()
    {
        $type = FastType::fromValue($this->type);
        $status = Status::fromValue($this->status);


        return "
        --------------------------------------
        Status ($status)  \n\r
        Started Fasting $this->start \n\r   
        Fast Type $type({$this->type}h) \n\r
        Elapsed Time $this->elapsedTime;
        --------------------------------------
        ";
    }

    public function setElapsedTime($time)
    {
        $this->elapsedTime = $time;
    }
}


