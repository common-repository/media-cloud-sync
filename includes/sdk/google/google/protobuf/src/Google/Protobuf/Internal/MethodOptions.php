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
 * Generated from protobuf message <code>google.protobuf.MethodOptions</code>
 */
class MethodOptions extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Is this method deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for the method, or it will be completely ignored; in the very least,
     * this is a formalization for deprecating methods.
     *
     * Generated from protobuf field <code>optional bool deprecated = 33 [default = false];</code>
     */
    protected $deprecated = null;
    /**
     * Generated from protobuf field <code>optional .google.protobuf.MethodOptions.IdempotencyLevel idempotency_level = 34 [default = IDEMPOTENCY_UNKNOWN];</code>
     */
    protected $idempotency_level = null;
    /**
     * The parser stores options it doesn't recognize here. See above.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option = 999;</code>
     */
    private $uninterpreted_option;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $deprecated
     *           Is this method deprecated?
     *           Depending on the target platform, this can emit Deprecated annotations
     *           for the method, or it will be completely ignored; in the very least,
     *           this is a formalization for deprecating methods.
     *     @type int $idempotency_level
     *     @type array<\Google\Protobuf\Internal\UninterpretedOption>|\Google\Protobuf\Internal\RepeatedField $uninterpreted_option
     *           The parser stores options it doesn't recognize here. See above.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Protobuf\Internal\Descriptor::initOnce();
        parent::__construct($data);
    }
    /**
     * Is this method deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for the method, or it will be completely ignored; in the very least,
     * this is a formalization for deprecating methods.
     *
     * Generated from protobuf field <code>optional bool deprecated = 33 [default = false];</code>
     * @return bool
     */
    public function getDeprecated()
    {
        return isset($this->deprecated) ? $this->deprecated : \false;
    }
    public function hasDeprecated()
    {
        return isset($this->deprecated);
    }
    public function clearDeprecated()
    {
        unset($this->deprecated);
    }
    /**
     * Is this method deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for the method, or it will be completely ignored; in the very least,
     * this is a formalization for deprecating methods.
     *
     * Generated from protobuf field <code>optional bool deprecated = 33 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setDeprecated($var)
    {
        GPBUtil::checkBool($var);
        $this->deprecated = $var;
        return $this;
    }
    /**
     * Generated from protobuf field <code>optional .google.protobuf.MethodOptions.IdempotencyLevel idempotency_level = 34 [default = IDEMPOTENCY_UNKNOWN];</code>
     * @return int
     */
    public function getIdempotencyLevel()
    {
        return isset($this->idempotency_level) ? $this->idempotency_level : 0;
    }
    public function hasIdempotencyLevel()
    {
        return isset($this->idempotency_level);
    }
    public function clearIdempotencyLevel()
    {
        unset($this->idempotency_level);
    }
    /**
     * Generated from protobuf field <code>optional .google.protobuf.MethodOptions.IdempotencyLevel idempotency_level = 34 [default = IDEMPOTENCY_UNKNOWN];</code>
     * @param int $var
     * @return $this
     */
    public function setIdempotencyLevel($var)
    {
        GPBUtil::checkEnum($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\MethodOptions\IdempotencyLevel::class);
        $this->idempotency_level = $var;
        return $this;
    }
    /**
     * The parser stores options it doesn't recognize here. See above.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option = 999;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getUninterpretedOption()
    {
        return $this->uninterpreted_option;
    }
    /**
     * The parser stores options it doesn't recognize here. See above.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option = 999;</code>
     * @param array<\Google\Protobuf\Internal\UninterpretedOption>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setUninterpretedOption($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\UninterpretedOption::class);
        $this->uninterpreted_option = $arr;
        return $this;
    }
}
