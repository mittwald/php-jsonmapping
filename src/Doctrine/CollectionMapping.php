<?php
namespace Mw\JsonMapping\Doctrine;

use Doctrine\Common\Collections\Collection;
use Mw\JsonMapping\AbstractMapping;
use Mw\JsonMapping\MappingInterface;

/**
 * Class ListMapping
 *
 * @package Mw\JsonMapping
 */
class CollectionMapping extends AbstractMapping
{

    /**
     * @var MappingInterface
     */
    private $innerMapping;

    /**
     * ListMapping constructor.
     *
     * @param MappingInterface $innerMapping
     */
    public function __construct(MappingInterface $innerMapping)
    {
        $this->innerMapping = $innerMapping;
    }

    /**
     * @param $value
     * @return array
     */
    public function map($value)
    {
        if (!($value instanceof Collection)) {
            return null;
        }

        $result = [];
        foreach ($value as $item) {
            $result[] = $this->innerMapping->map($item);
        }

        return $result;
    }
}