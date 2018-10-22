<?php
declare(strict_types=1);

namespace PHPSu\Configuration\Dto;

use PHPSu\Configuration\Dto\FilesystemDto as Item;
use PHPSu\Core\AbstractBag;

class FilesystemBag extends AbstractBag
{
    public function __construct(Item ...$filesystems)
    {
        parent::__construct($filesystems, Item::class);
    }

    public function current(): Item
    {
        return current($this->bagContent);
    }

    public function offsetGet($offset): Item
    {
        return $this->bagContent[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (!$value instanceof Item) {
            throw new \InvalidArgumentException('a ' . static::class . ' can only hold items of type ' . Item::class . ' ');
        }
        return $this->bagContent[$offset];
    }
}