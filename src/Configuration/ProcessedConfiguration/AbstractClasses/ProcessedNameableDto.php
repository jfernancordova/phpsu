<?php
declare(strict_types=1);

namespace PHPSu\Configuration\ProcessedConfiguration\AbstractClasses;

use PHPSu\Core\Interfaces\NameableInterface;

abstract class ProcessedNameableDto implements NameableInterface
{
    protected $name;

    public function __construct(string $name)
    {
        if (strlen($name) <= 0) {
            throw new \InvalidArgumentException(static::class . ' needs a name');
        }
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}