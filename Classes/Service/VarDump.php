<?php
namespace Avency\Neos\VarDump\Service;

use Avency\Neos\VarDump\ContextProvider\NeosContextProvider;
use Neos\Flow\Annotations as Flow;
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

        $connection = new Connection(
            'tcp://0.0.0.0:9912',
            [
                new NeosContextProvider($title, $plaintext)
            ]
        );
        $data = (new VarCloner())->cloneVar($value);
        if (!$connection || !$connection->write($data)) {
            \Neos\Flow\var_dump($value, $title, $return, $plaintext);
        }
    }
}
