<?php
namespace Avency\Neos;

use Avency\Neos\VarDump\Service\VarDump;

/**
 * @param mixed $value
 * @param string|null $title
 * @param bool $return
 * @param bool|null $plaintext
 * @return void
 */
function var_dump($value, ?string $title = null, bool $return = false, ?bool $plaintext = null): void
{
    VarDump::dump($value, $title, $return, $plaintext);
}
