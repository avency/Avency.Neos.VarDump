<?php
namespace Avency\Neos\VarDump\ContextProvider;

use Symfony\Component\VarDumper\Dumper\ContextProvider\ContextProviderInterface;

/**
 * Provide context from the Neos var_dump
 */
final class NeosContextProvider implements ContextProviderInterface
{

    /**
     * @var string
     */
    protected $title;

    /**
     * @var bool
     */
    protected $plaintext;

    /**
     * Constructor
     *
     * @param string|null $title
     * @param bool|null $plaintext
     */
    public function __construct(string $title = null, bool $plaintext = null)
    {
        $this->title = $title;
        $this->plaintext = $plaintext;
    }

    /**
     * @return array
     */
    public function getContext(): ?array
    {
        return [
            'title' => $this->title,
            'plaintext' => $this->plaintext
        ];
    }
}
