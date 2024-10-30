<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/client.proto
namespace Dudlewebs\WPMCS\Google\Api;

use UnexpectedValueException;
/**
 * To where should client libraries be published?
 *
 * Protobuf type <code>google.api.ClientLibraryDestination</code>
 */
class ClientLibraryDestination
{
    /**
     * Client libraries will neither be generated nor published to package
     * managers.
     *
     * Generated from protobuf enum <code>CLIENT_LIBRARY_DESTINATION_UNSPECIFIED = 0;</code>
     */
    const CLIENT_LIBRARY_DESTINATION_UNSPECIFIED = 0;
    /**
     * Generate the client library in a repo under github.com/googleapis,
     * but don't publish it to package managers.
     *
     * Generated from protobuf enum <code>GITHUB = 10;</code>
     */
    const GITHUB = 10;
    /**
     * Publish the library to package managers like nuget.org and npmjs.com.
     *
     * Generated from protobuf enum <code>PACKAGE_MANAGER = 20;</code>
     */
    const PACKAGE_MANAGER = 20;
    private static $valueToName = [self::CLIENT_LIBRARY_DESTINATION_UNSPECIFIED => 'CLIENT_LIBRARY_DESTINATION_UNSPECIFIED', self::GITHUB => 'GITHUB', self::PACKAGE_MANAGER => 'PACKAGE_MANAGER'];
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
