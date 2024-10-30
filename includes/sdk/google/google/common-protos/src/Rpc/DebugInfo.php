<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/rpc/error_details.proto
namespace Dudlewebs\WPMCS\Google\Rpc;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * Describes additional debugging info.
 *
 * Generated from protobuf message <code>google.rpc.DebugInfo</code>
 */
class DebugInfo extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * The stack trace entries indicating where the error occurred.
     *
     * Generated from protobuf field <code>repeated string stack_entries = 1;</code>
     */
    private $stack_entries;
    /**
     * Additional debugging information provided by the server.
     *
     * Generated from protobuf field <code>string detail = 2;</code>
     */
    protected $detail = '';
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $stack_entries
     *           The stack trace entries indicating where the error occurred.
     *     @type string $detail
     *           Additional debugging information provided by the server.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Rpc\ErrorDetails::initOnce();
        parent::__construct($data);
    }
    /**
     * The stack trace entries indicating where the error occurred.
     *
     * Generated from protobuf field <code>repeated string stack_entries = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getStackEntries()
    {
        return $this->stack_entries;
    }
    /**
     * The stack trace entries indicating where the error occurred.
     *
     * Generated from protobuf field <code>repeated string stack_entries = 1;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setStackEntries($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::STRING);
        $this->stack_entries = $arr;
        return $this;
    }
    /**
     * Additional debugging information provided by the server.
     *
     * Generated from protobuf field <code>string detail = 2;</code>
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }
    /**
     * Additional debugging information provided by the server.
     *
     * Generated from protobuf field <code>string detail = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setDetail($var)
    {
        GPBUtil::checkString($var, True);
        $this->detail = $var;
        return $this;
    }
}
