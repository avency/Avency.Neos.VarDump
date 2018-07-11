<?php
namespace Avency\Neos;

use Avency\Neos\VarDump\Service\VarDump;

/**
 * @param mixed $value
 * @param string $title
 * @param bool $return
 * @param bool $plaintext
 * @return void|string
 */
function var_dump($value, string $title = null, bool $return = false, bool $plaintext = null)
{
    VarDump::dump($value, $title, $return, $plaintext);
}
