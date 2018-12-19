<?php
declare(strict_types=1);

namespace PHPSu\Configuration\ProcessedConfiguration;

use PHPSu\Configuration\ProcessedConfiguration\ProcessedDatabaseDto as Item;
use PHPSu\Core\AbstractBag;

class ProcessedDatabaseBag extends AbstractBag
{
    public function __construct(Item ...$databases)
    {
        parent::__construct($databases, Item::class);
    }

    public function current(): Item
    {
        return current($this->bagContent);
    }

    public function offsetGet($offset): Item
    {
        return $this->bagContent[$offset];
    }
}