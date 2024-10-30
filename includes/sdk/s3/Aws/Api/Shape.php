<?php

namespace Dudlewebs\WPMCS\s3\Aws\Api;

/**
 * Base class representing a modeled shape.
 */
class Shape extends AbstractModel
{
    /**
     * Get a concrete shape for the given definition.
     *
     * @param array    $definition
     * @param ShapeMap $shapeMap
     *
     * @return mixed
     * @throws \RuntimeException if the type is invalid
     */
    public static function create(array $definition, ShapeMap $shapeMap)
    {
        static $map = ['structure' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\StructureShape', 'map' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\MapShape', 'list' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\ListShape', 'timestamp' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\TimestampShape', 'integer' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'double' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'float' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'long' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'string' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'byte' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'character' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'blob' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape', 'boolean' => 'Dudlewebs\\WPMCS\\s3\\Aws\\Api\\Shape'];
        if (isset($definition['shape'])) {
            return $shapeMap->resolve($definition);
        }
        if (!isset($map[$definition['type']])) {
            throw new \RuntimeException('Invalid type: ' . \print_r($definition, \true));
        }
        $type = $map[$definition['type']];
        return new $type($definition, $shapeMap);
    }
    /**
     * Get the type of the shape
     *
     * @return string
     */
    public function getType()
    {
        return $this->definition['type'];
    }
    /**
     * Get the name of the shape
     *
     * @return string
     */
    public function getName()
    {
        return $this->definition['name'];
    }
}
