<?php
namespace Avency\Neos\VarDump\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Command\Descriptor\CliDescriptor;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Server\DumpServer;

/**
 * DumpServer Command Controller
 *
 * @Flow\Scope("singleton")
 */
class DumpServerCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var DumpServer
     */
    protected $dumpServer;

    /**
     * Start the dump server
     *
     * @return void
     */
    public function startCommand()
    {
        $descriptor = new CliDescriptor(new CliDumper());

        $this->outputLine('Neos Var Dump Server');
        $this->outputLine(sprintf('Server listening on %s', $this->dumpServer->getHost()));
        $this->outputLine('Quit the server with CONTROL-C.');

        $this->dumpServer->listen(function (Data $data, array $context, int $clientId) use ($descriptor) {
            $descriptor->describe($this->output->getOutput(), $data, $context, $clientId);
        });
    }
}
