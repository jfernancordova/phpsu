<?php

declare(strict_types=1);

namespace PHPSu\Process;

use Generator;
use LogicException;
use PHPSu\Exceptions\CommandExecutionException;
use PHPSu\Tools\EnvironmentUtility;

/**
 * @internal
 */
final class Process extends \Symfony\Component\Process\Process
{
    public const STATE_READY = 'ready';
    public const STATE_RUNNING = 'running';
    public const STATE_SUCCEEDED = 'succeeded';
    public const STATE_ERRORED = 'errored';

    /** @var string */
    private $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Process
    {
        $this->name = $name;
        return $this;
    }

    public function getState(): string
    {
        switch ($this->getStatus()) {
            case self::STATUS_READY:
                return self::STATE_READY;
            case self::STATUS_STARTED:
                return self::STATE_RUNNING;
            case self::STATUS_TERMINATED:
                return $this->getExitCode() === 0 ? self::STATE_SUCCEEDED : self::STATE_ERRORED;
        }
        throw new LogicException('This should never happen');
    }

    /**
     * @param int $flags A bit field of Process::ITER_* flags
     * @return Generator<string>
     */
    public function getIterator($flags = 0): Generator
    {
        return parent::getIterator($flags);
    }
}
