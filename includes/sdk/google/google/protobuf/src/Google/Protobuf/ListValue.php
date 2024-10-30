<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/struct.proto
namespace Dudlewebs\WPMCS\Google\Protobuf;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * `ListValue` is a wrapper around a repeated field of values.
 * The JSON representation for `ListValue` is JSON array.
 *
 * Generated from protobuf message <code>google.protobuf.ListValue</code>
 */
class ListValue extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Repeated field of dynamically typed values.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Value values = 1;</code>
     */
    private $values;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Protobuf\Value>|\Google\Protobuf\Internal\RepeatedField $values
     *           Repeated field of dynamically typed values.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Protobuf\Struct::initOnce();
        parent::__construct($data);
    }
    /**
     * Repeated field of dynamically typed values.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Value values = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getValues()
    {
        return $this->values;
    }
    /**
     * Repeated field of dynamically typed values.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Value values = 1;</code>
     * @param array<\Google\Protobuf\Value>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setValues($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Value::class);
        $this->values = $arr;
        return $this;
    }
}
