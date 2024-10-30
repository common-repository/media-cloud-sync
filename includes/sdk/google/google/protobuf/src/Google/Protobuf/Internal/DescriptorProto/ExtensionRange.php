<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/descriptor.proto
namespace Dudlewebs\WPMCS\Google\Protobuf\Internal\DescriptorProto;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBWire;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\InputStream;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * Generated from protobuf message <code>google.protobuf.DescriptorProto.ExtensionRange</code>
 */
class ExtensionRange extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Inclusive.
     *
     * Generated from protobuf field <code>optional int32 start = 1;</code>
     */
    protected $start = null;
    /**
     * Exclusive.
     *
     * Generated from protobuf field <code>optional int32 end = 2;</code>
     */
    protected $end = null;
    /**
     * Generated from protobuf field <code>optional .google.protobuf.ExtensionRangeOptions options = 3;</code>
     */
    protected $options = null;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $start
     *           Inclusive.
     *     @type int $end
     *           Exclusive.
     *     @type \Google\Protobuf\Internal\ExtensionRangeOptions $options
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Protobuf\Internal\Descriptor::initOnce();
        parent::__construct($data);
    }
    /**
     * Inclusive.
     *
     * Generated from protobuf field <code>optional int32 start = 1;</code>
     * @return int
     */
    public function getStart()
    {
        return isset($this->start) ? $this->start : 0;
    }
    public function hasStart()
    {
        return isset($this->start);
    }
    public function clearStart()
    {
        unset($this->start);
    }
    /**
     * Inclusive.
     *
     * Generated from protobuf field <code>optional int32 start = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setStart($var)
    {
        GPBUtil::checkInt32($var);
        $this->start = $var;
        return $this;
    }
    /**
     * Exclusive.
     *
     * Generated from protobuf field <code>optional int32 end = 2;</code>
     * @return int
     */
    public function getEnd()
    {
        return isset($this->end) ? $this->end : 0;
    }
    public function hasEnd()
    {
        return isset($this->end);
    }
    public function clearEnd()
    {
        unset($this->end);
    }
    /**
     * Exclusive.
     *
     * Generated from protobuf field <code>optional int32 end = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setEnd($var)
    {
        GPBUtil::checkInt32($var);
        $this->end = $var;
        return $this;
    }
    /**
     * Generated from protobuf field <code>optional .google.protobuf.ExtensionRangeOptions options = 3;</code>
     * @return \Google\Protobuf\Internal\ExtensionRangeOptions|null
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
     * Generated from protobuf field <code>optional .google.protobuf.ExtensionRangeOptions options = 3;</code>
     * @param \Google\Protobuf\Internal\ExtensionRangeOptions $var
     * @return $this
     */
    public function setOptions($var)
    {
        GPBUtil::checkMessage($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\ExtensionRangeOptions::class);
        $this->options = $var;
        return $this;
    }
}
// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ExtensionRange::class, \Dudlewebs\WPMCS\Google\Protobuf\Internal\DescriptorProto_ExtensionRange::class);
