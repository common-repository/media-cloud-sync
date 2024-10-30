<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/type.proto
namespace Dudlewebs\WPMCS\Google\Protobuf;

use UnexpectedValueException;
/**
 * The syntax in which a protocol buffer element is defined.
 *
 * Protobuf type <code>google.protobuf.Syntax</code>
 */
class Syntax
{
    /**
     * Syntax `proto2`.
     *
     * Generated from protobuf enum <code>SYNTAX_PROTO2 = 0;</code>
     */
    const SYNTAX_PROTO2 = 0;
    /**
     * Syntax `proto3`.
     *
     * Generated from protobuf enum <code>SYNTAX_PROTO3 = 1;</code>
     */
    const SYNTAX_PROTO3 = 1;
    private static $valueToName = [self::SYNTAX_PROTO2 => 'SYNTAX_PROTO2', self::SYNTAX_PROTO3 => 'SYNTAX_PROTO3'];
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
