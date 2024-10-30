<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/client.proto
namespace Dudlewebs\WPMCS\Google\Api;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * Settings for Go client libraries.
 *
 * Generated from protobuf message <code>google.api.GoSettings</code>
 */
class GoSettings extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Some settings.
     *
     * Generated from protobuf field <code>.google.api.CommonLanguageSettings common = 1;</code>
     */
    protected $common = null;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Api\CommonLanguageSettings $common
     *           Some settings.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Api\Client::initOnce();
        parent::__construct($data);
    }
    /**
     * Some settings.
     *
     * Generated from protobuf field <code>.google.api.CommonLanguageSettings common = 1;</code>
     * @return \Google\Api\CommonLanguageSettings|null
     */
    public function getCommon()
    {
        return $this->common;
    }
    public function hasCommon()
    {
        return isset($this->common);
    }
    public function clearCommon()
    {
        unset($this->common);
    }
    /**
     * Some settings.
     *
     * Generated from protobuf field <code>.google.api.CommonLanguageSettings common = 1;</code>
     * @param \Google\Api\CommonLanguageSettings $var
     * @return $this
     */
    public function setCommon($var)
    {
        GPBUtil::checkMessage($var, \Dudlewebs\WPMCS\Google\Api\CommonLanguageSettings::class);
        $this->common = $var;
        return $this;
    }
}
