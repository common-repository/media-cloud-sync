<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/descriptor.proto
namespace Dudlewebs\WPMCS\Google\Protobuf\Internal;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBWire;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\InputStream;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * Describes a oneof.
 *
 * Generated from protobuf message <code>google.protobuf.OneofDescriptorProto</code>
 */
class OneofDescriptorProto extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>optional string name = 1;</code>
     */
    protected $name = null;
    /**
     * Generated from protobuf field <code>optional .google.protobuf.OneofOptions options = 2;</code>
     */
    protected $options = null;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *     @type \Google\Protobuf\Internal\OneofOptions $options
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Protobuf\Internal\Descriptor::initOnce();
        parent::__construct($data);
    }
    /**
     * Generated from protobuf field <code>optional string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return isset($this->name) ? $this->name : '';
    }
    public function hasName()
    {
        return isset($this->name);
    }
    public function clearName()
    {
        unset($this->name);
    }
    /**
     * Generated from protobuf field <code>optional string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;
        return $this;
    }
    /**
     * Generated from protobuf field <code>optional .google.protobuf.OneofOptions options = 2;</code>
     * @return \Google\Protobuf\Internal\OneofOptions|null
     */
    public function getOptions()
    {
        return $this->options;
    }
    public function hasOptions()
    {
        return isset($this->options);
    }
    public function clearOptions()
    {
        unset($this->options);
    }
    /**
     * Generated from protobuf field <code>optional .google.protobuf.OneofOptions options = 2;</code>
     * @param \Google\Protobuf\Internal\OneofOptions $var
     * @return $this
     */
    public function setOptions($var)
    {
        GPBUtil::checkMessage($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\OneofOptions::class);
        $this->options = $var;
        return $this;
    }
}
