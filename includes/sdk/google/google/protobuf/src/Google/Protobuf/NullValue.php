<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/struct.proto
namespace Dudlewebs\WPMCS\Google\Protobuf;

use UnexpectedValueException;
/**
 * `NullValue` is a singleton enumeration to represent the null value for the
 * `Value` type union.
 *  The JSON representation for `NullValue` is JSON `null`.
 *
 * Protobuf type <code>google.protobuf.NullValue</code>
 */
class NullValue
{
    /**
     * Null value.
     *
     * Generated from protobuf enum <code>NULL_VALUE = 0;</code>
     */
    const NULL_VALUE = 0;
    private static $valueToName = [self::NULL_VALUE => 'NULL_VALUE'];
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
