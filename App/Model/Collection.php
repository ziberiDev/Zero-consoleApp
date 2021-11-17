<?php

namespace App\Model;


use Iterator;

class Collection implements Iterator
{


    public function __construct(protected array $items)
    {
    }

    public
    function current()
    {
        return current($this->items);
    }

    public
    function next()
    {
        return next($this->items);
    }

    public
    function key()
    {
        return key($this->items);
    }

    public
    function valid()
    {
        return current($this->items) !== false;
    }

    public
    function rewind()
    {
        return reset($this->items);
    }

    public function each(callable $callback)
    {
        foreach ($this as $key => $value) {
            if ($callback($key, $value) === null) {
                return;
            }
        }
        return $this;
    }

    public function toArray()
    {
        return $this->items;
    }
}