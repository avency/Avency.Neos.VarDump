<?php
namespace Avency\Neos\VarDump\Service;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Error\Debugger;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Server\Connection;

/**
 * Var Dump Service
 *
 * @Flow\Proxy(false)
 */
class VarDump
{
    /**
     * Dump a value
     *
     * @param mixed $value
     * @param string $title
     * @param bool $return
     * @param bool $plaintext
     * @return void|string
     */
    public static function dump($value, string $title = null, bool $return = false, bool $plaintext = null)
    {
        if ($return) {
            return \Neos\Flow\var_dump($value, $title, $return, $plaintext);
        }

        $connection = new Connection('tcp://0.0.0.0:9912');

        if ($title === null) {
            $title = 'Flow Variable Dump';
        }
        $data = (new VarCloner())->cloneVar(
            "\x1B[1m" . $title . "\x1B[0m" . chr(10) . Debugger::renderDump($value, 0, true, true) . chr(10) . chr(10)
        );
        if (!$connection || !$connection->write($data)) {
            \Neos\Flow\var_dump($value, $title, $return, $plaintext);
        }
    }
}
