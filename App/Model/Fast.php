<?php

namespace App\Model;

use App\Enums\FastType;
use App\Enums\Status;
use App\Interface\FastModelInterface;
use DateTime;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;


class Fast implements FastModelInterface, JsonSerializable
{
    protected array $dates = [
        'start',
        'end'
    ];

    protected array $fillable = [
        'start',
        'status',
        'end',
        'type',
        'elapsedTime'
    ];

    public function __construct(
        protected string $start = '',
        protected int    $status = 1,
        protected string $end = '',
        protected int    $type = 0,
        protected string $elapsedTime = ''
    ){
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

    /**
     * Global params setter for fillable properties of Fast class.
     * @param array $params
     * @throws Exception
     */
    public function set(array $params)
    {
        foreach ($params as $param => $value) {
            if (!in_array($param, $this->fillable)) throw new Exception("Cannot set property {$param} of " . get_class($this));
            $this->$param = $value;
        }
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function print(): string
    {
        return "
--------------------------------------
Status (" . Status::fromValue($this->status) . ")  \n\r
Started Fasting $this->start \n\r  
End date $this->end \n\r 
Fast Type " . FastType::fromValue($this->type) . "({$this->type}h) \n\r
Elapsed Time $this->elapsedTime; \n\r
-------------------------------------- ";
    }

    /**
     * @return array
     */
    #[ArrayShape(["status" => "int", "start" => "string", "end" => "string", "type" => "int", "elapsed_time" => "string"])]
    public function jsonSerialize(): array
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


