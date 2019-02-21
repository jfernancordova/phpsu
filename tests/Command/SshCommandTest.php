<?php
declare(strict_types=1);

namespace PHPSu\Tests\Command;

use PHPSu\Command\SshCommand;
use PHPSu\Config\GlobalConfig;
use PHPSu\Config\SshConfig;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Output\OutputInterface;

final class SshCommandTest extends TestCase
{
    public function testSshCommandGenerate(): void
    {
        $sshConfig = new SshConfig();
        $sshConfig->setFile(new \SplTempFileObject());
        $ssh = new SshCommand();
        $ssh->setSshConfig($sshConfig)
            ->setInto('hosta');
        $this->assertSame("ssh -F 'php://temp' 'hosta'", $ssh->generate());
    }

    public function testSshCommandQuiet(): void
    {
        $sshConfig = new SshConfig();
        $sshConfig->setFile(new \SplTempFileObject());
        $ssh = new SshCommand();
        $ssh->setSshConfig($sshConfig)
            ->setInto('hosta')
            ->setVerbosity(OutputInterface::VERBOSITY_QUIET);
        $this->assertSame("ssh -q -F 'php://temp' 'hosta'", $ssh->generate());
    }

    public function testSshCommandVerbose(): void
    {
        $sshConfig = new SshConfig();
        $sshConfig->setFile(new \SplTempFileObject());
        $ssh = new SshCommand();
        $ssh->setSshConfig($sshConfig)
            ->setInto('hosta')
            ->setVerbosity(OutputInterface::VERBOSITY_VERBOSE);
        $this->assertSame("ssh -v -F 'php://temp' 'hosta'", $ssh->generate());
    }

    public function testSshCommandVeryVerbose(): void
    {
        $sshConfig = new SshConfig();
        $sshConfig->setFile(new \SplTempFileObject());
        $ssh = new SshCommand();
        $ssh->setSshConfig($sshConfig)
            ->setInto('hosta')
            ->setVerbosity(OutputInterface::VERBOSITY_VERY_VERBOSE);
        $this->assertSame("ssh -vv -F 'php://temp' 'hosta'", $ssh->generate());
    }

    public function testSshCommandDebug(): void
    {
        $sshConfig = new SshConfig();
        $sshConfig->setFile(new \SplTempFileObject());
        $ssh = new SshCommand();
        $ssh->setSshConfig($sshConfig)
            ->setInto('hosta')
            ->setVerbosity(OutputInterface::VERBOSITY_DEBUG);
        $this->assertSame("ssh -vvv -F 'php://temp' 'hosta'", $ssh->generate());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage  the found host and the current Host are the same: same
     */
    public function testSameException(): void
    {
        $sshConfig = new SshConfig();
        $sshConfig->setFile(new \SplTempFileObject());
        SshCommand::fromGlobal(new GlobalConfig(), 'same', 'same', OutputInterface::VERBOSITY_NORMAL);
    }
}