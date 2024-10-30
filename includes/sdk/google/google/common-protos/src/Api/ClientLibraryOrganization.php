<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/client.proto
namespace Dudlewebs\WPMCS\Google\Api;

use UnexpectedValueException;
/**
 * The organization for which the client libraries are being published.
 * Affects the url where generated docs are published, etc.
 *
 * Protobuf type <code>google.api.ClientLibraryOrganization</code>
 */
class ClientLibraryOrganization
{
    /**
     * Not useful.
     *
     * Generated from protobuf enum <code>CLIENT_LIBRARY_ORGANIZATION_UNSPECIFIED = 0;</code>
     */
    const CLIENT_LIBRARY_ORGANIZATION_UNSPECIFIED = 0;
    /**
     * Google Cloud Platform Org.
     *
     * Generated from protobuf enum <code>CLOUD = 1;</code>
     */
    const CLOUD = 1;
    /**
     * Ads (Advertising) Org.
     *
     * Generated from protobuf enum <code>ADS = 2;</code>
     */
    const ADS = 2;
    /**
     * Photos Org.
     *
     * Generated from protobuf enum <code>PHOTOS = 3;</code>
     */
    const PHOTOS = 3;
    /**
     * Street View Org.
     *
     * Generated from protobuf enum <code>STREET_VIEW = 4;</code>
     */
    const STREET_VIEW = 4;
    /**
     * Shopping Org.
     *
     * Generated from protobuf enum <code>SHOPPING = 5;</code>
     */
    const SHOPPING = 5;
    /**
     * Geo Org.
     *
     * Generated from protobuf enum <code>GEO = 6;</code>
     */
    const GEO = 6;
    /**
     * Generative AI - https://developers.generativeai.google
     *
     * Generated from protobuf enum <code>GENERATIVE_AI = 7;</code>
     */
    const GENERATIVE_AI = 7;
    private static $valueToName = [self::CLIENT_LIBRARY_ORGANIZATION_UNSPECIFIED => 'CLIENT_LIBRARY_ORGANIZATION_UNSPECIFIED', self::CLOUD => 'CLOUD', self::ADS => 'ADS', self::PHOTOS => 'PHOTOS', self::STREET_VIEW => 'STREET_VIEW', self::SHOPPING => 'SHOPPING', self::GEO => 'GEO', self::GENERATIVE_AI => 'GENERATIVE_AI'];
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
