<?php
namespace Mw\JsonMapping;

/**
 * Abstract class AbstractMapping
 * @package Mw\JsonMapping
 */
abstract class AbstractMapping implements MappingInterface
{



    /**
     * @codeCoverageIgnore
     * @param MappingInterface $next
     * @return MappingChain
     */
    public function then(MappingInterface $next)
    {
        return new MappingChain($this, $next);
    }

}