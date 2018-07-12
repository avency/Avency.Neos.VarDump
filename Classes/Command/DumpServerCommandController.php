<?php
namespace Avency\Neos\VarDump\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\VarDumper\Cloner\Data;
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
        $io = new SymfonyStyle(new StringInput(''), $this->output->getOutput());
        $io->title('Neos Var Dump Server');

        $this->dumpServer->start();

        $io->success(sprintf('Server listening on %s', $this->dumpServer->getHost()));
        $io->comment('Quit the server with CONTROL-C.');

        $this->dumpServer->listen(function (Data $data, array $context, int $clientId) {
            $this->output($data->getValue());
        });
    }
}
