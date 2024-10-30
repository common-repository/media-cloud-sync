<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/consumer.proto
namespace Dudlewebs\WPMCS\Google\Api\Property;

use UnexpectedValueException;
/**
 * Supported data type of the property values
 *
 * Protobuf type <code>google.api.Property.PropertyType</code>
 */
class PropertyType
{
    /**
     * The type is unspecified, and will result in an error.
     *
     * Generated from protobuf enum <code>UNSPECIFIED = 0;</code>
     */
    const UNSPECIFIED = 0;
    /**
     * The type is `int64`.
     *
     * Generated from protobuf enum <code>INT64 = 1;</code>
     */
    const INT64 = 1;
    /**
     * The type is `bool`.
     *
     * Generated from protobuf enum <code>BOOL = 2;</code>
     */
    const BOOL = 2;
    /**
     * The type is `string`.
     *
     * Generated from protobuf enum <code>STRING = 3;</code>
     */
    const STRING = 3;
    /**
     * The type is 'double'.
     *
     * Generated from protobuf enum <code>DOUBLE = 4;</code>
     */
    const DOUBLE = 4;
    private static $valueToName = [self::UNSPECIFIED => 'UNSPECIFIED', self::INT64 => 'INT64', self::BOOL => 'BOOL', self::STRING => 'STRING', self::DOUBLE => 'DOUBLE'];
    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf('Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }
    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf('Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}
