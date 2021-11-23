<?php

namespace App\Model;

use Iterator;

class Collection implements Iterator
{
    public function __construct(protected array $items){}

    public function current()
    {
        return current($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function valid()
    {
        return current($this->items) !== false;
    }

    public function rewind()
    {
        return reset($this->items);
    }

    /**
     * Iterates the collection over a callback function
     * @param callable $callback
     * @return $this|false
     */
    public function each(callable $callback): bool|static
    {
        foreach ($this as $key => $value) {
            if ($callback($key, $value) === false) {
                return false;
            }
        }
        return $this;
    }

    /**
     * Returns collection as an array
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }
}