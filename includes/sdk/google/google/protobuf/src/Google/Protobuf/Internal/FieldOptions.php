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
 * Generated from protobuf message <code>google.protobuf.FieldOptions</code>
 */
class FieldOptions extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * The ctype option instructs the C++ code generator to use a different
     * representation of the field than it normally would.  See the specific
     * options below.  This option is not yet implemented in the open source
     * release -- sorry, we'll try to include it in a future version!
     *
     * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.CType ctype = 1 [default = STRING];</code>
     */
    protected $ctype = null;
    /**
     * The packed option can be enabled for repeated primitive fields to enable
     * a more efficient representation on the wire. Rather than repeatedly
     * writing the tag and type for each element, the entire array is encoded as
     * a single length-delimited blob. In proto3, only explicit setting it to
     * false will avoid using packed encoding.
     *
     * Generated from protobuf field <code>optional bool packed = 2;</code>
     */
    protected $packed = null;
    /**
     * The jstype option determines the JavaScript type used for values of the
     * field.  The option is permitted only for 64 bit integral and fixed types
     * (int64, uint64, sint64, fixed64, sfixed64).  A field with jstype JS_STRING
     * is represented as JavaScript string, which avoids loss of precision that
     * can happen when a large value is converted to a floating point JavaScript.
     * Specifying JS_NUMBER for the jstype causes the generated JavaScript code to
     * use the JavaScript "number" type.  The behavior of the default option
     * JS_NORMAL is implementation dependent.
     * This option is an enum to permit additional types to be added, e.g.
     * goog.math.Integer.
     *
     * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.JSType jstype = 6 [default = JS_NORMAL];</code>
     */
    protected $jstype = null;
    /**
     * Should this field be parsed lazily?  Lazy applies only to message-type
     * fields.  It means that when the outer message is initially parsed, the
     * inner message's contents will not be parsed but instead stored in encoded
     * form.  The inner message will actually be parsed when it is first accessed.
     * This is only a hint.  Implementations are free to choose whether to use
     * eager or lazy parsing regardless of the value of this option.  However,
     * setting this option true suggests that the protocol author believes that
     * using lazy parsing on this field is worth the additional bookkeeping
     * overhead typically needed to implement it.
     * This option does not affect the public interface of any generated code;
     * all method signatures remain the same.  Furthermore, thread-safety of the
     * interface is not affected by this option; const methods remain safe to
     * call from multiple threads concurrently, while non-const methods continue
     * to require exclusive access.
     * Note that implementations may choose not to check required fields within
     * a lazy sub-message.  That is, calling IsInitialized() on the outer message
     * may return true even if the inner message has missing required fields.
     * This is necessary because otherwise the inner message would have to be
     * parsed in order to perform the check, defeating the purpose of lazy
     * parsing.  An implementation which chooses not to check required fields
     * must be consistent about it.  That is, for any particular sub-message, the
     * implementation must either *always* check its required fields, or *never*
     * check its required fields, regardless of whether or not the message has
     * been parsed.
     * As of May 2022, lazy verifies the contents of the byte stream during
     * parsing.  An invalid byte stream will cause the overall parsing to fail.
     *
     * Generated from protobuf field <code>optional bool lazy = 5 [default = false];</code>
     */
    protected $lazy = null;
    /**
     * unverified_lazy does no correctness checks on the byte stream. This should
     * only be used where lazy with verification is prohibitive for performance
     * reasons.
     *
     * Generated from protobuf field <code>optional bool unverified_lazy = 15 [default = false];</code>
     */
    protected $unverified_lazy = null;
    /**
     * Is this field deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for accessors, or it will be completely ignored; in the very least, this
     * is a formalization for deprecating fields.
     *
     * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
     */
    protected $deprecated = null;
    /**
     * For Google-internal migration only. Do not use.
     *
     * Generated from protobuf field <code>optional bool weak = 10 [default = false];</code>
     */
    protected $weak = null;
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
     *     @type int $ctype
     *           The ctype option instructs the C++ code generator to use a different
     *           representation of the field than it normally would.  See the specific
     *           options below.  This option is not yet implemented in the open source
     *           release -- sorry, we'll try to include it in a future version!
     *     @type bool $packed
     *           The packed option can be enabled for repeated primitive fields to enable
     *           a more efficient representation on the wire. Rather than repeatedly
     *           writing the tag and type for each element, the entire array is encoded as
     *           a single length-delimited blob. In proto3, only explicit setting it to
     *           false will avoid using packed encoding.
     *     @type int $jstype
     *           The jstype option determines the JavaScript type used for values of the
     *           field.  The option is permitted only for 64 bit integral and fixed types
     *           (int64, uint64, sint64, fixed64, sfixed64).  A field with jstype JS_STRING
     *           is represented as JavaScript string, which avoids loss of precision that
     *           can happen when a large value is converted to a floating point JavaScript.
     *           Specifying JS_NUMBER for the jstype causes the generated JavaScript code to
     *           use the JavaScript "number" type.  The behavior of the default option
     *           JS_NORMAL is implementation dependent.
     *           This option is an enum to permit additional types to be added, e.g.
     *           goog.math.Integer.
     *     @type bool $lazy
     *           Should this field be parsed lazily?  Lazy applies only to message-type
     *           fields.  It means that when the outer message is initially parsed, the
     *           inner message's contents will not be parsed but instead stored in encoded
     *           form.  The inner message will actually be parsed when it is first accessed.
     *           This is only a hint.  Implementations are free to choose whether to use
     *           eager or lazy parsing regardless of the value of this option.  However,
     *           setting this option true suggests that the protocol author believes that
     *           using lazy parsing on this field is worth the additional bookkeeping
     *           overhead typically needed to implement it.
     *           This option does not affect the public interface of any generated code;
     *           all method signatures remain the same.  Furthermore, thread-safety of the
     *           interface is not affected by this option; const methods remain safe to
     *           call from multiple threads concurrently, while non-const methods continue
     *           to require exclusive access.
     *           Note that implementations may choose not to check required fields within
     *           a lazy sub-message.  That is, calling IsInitialized() on the outer message
     *           may return true even if the inner message has missing required fields.
     *           This is necessary because otherwise the inner message would have to be
     *           parsed in order to perform the check, defeating the purpose of lazy
     *           parsing.  An implementation which chooses not to check required fields
     *           must be consistent about it.  That is, for any particular sub-message, the
     *           implementation must either *always* check its required fields, or *never*
     *           check its required fields, regardless of whether or not the message has
     *           been parsed.
     *           As of May 2022, lazy verifies the contents of the byte stream during
     *           parsing.  An invalid byte stream will cause the overall parsing to fail.
     *     @type bool $unverified_lazy
     *           unverified_lazy does no correctness checks on the byte stream. This should
     *           only be used where lazy with verification is prohibitive for performance
     *           reasons.
     *     @type bool $deprecated
     *           Is this field deprecated?
     *           Depending on the target platform, this can emit Deprecated annotations
     *           for accessors, or it will be completely ignored; in the very least, this
     *           is a formalization for deprecating fields.
     *     @type bool $weak
     *           For Google-internal migration only. Do not use.
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
     * The ctype option instructs the C++ code generator to use a different
     * representation of the field than it normally would.  See the specific
     * options below.  This option is not yet implemented in the open source
     * release -- sorry, we'll try to include it in a future version!
     *
     * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.CType ctype = 1 [default = STRING];</code>
     * @return int
     */
    public function getCtype()
    {
        return isset($this->ctype) ? $this->ctype : 0;
    }
    public function hasCtype()
    {
        return isset($this->ctype);
    }
    public function clearCtype()
    {
        unset($this->ctype);
    }
    /**
     * The ctype option instructs the C++ code generator to use a different
     * representation of the field than it normally would.  See the specific
     * options below.  This option is not yet implemented in the open source
     * release -- sorry, we'll try to include it in a future version!
     *
     * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.CType ctype = 1 [default = STRING];</code>
     * @param int $var
     * @return $this
     */
    public function setCtype($var)
    {
        GPBUtil::checkEnum($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\FieldOptions\CType::class);
        $this->ctype = $var;
        return $this;
    }
    /**
     * The packed option can be enabled for repeated primitive fields to enable
     * a more efficient representation on the wire. Rather than repeatedly
     * writing the tag and type for each element, the entire array is encoded as
     * a single length-delimited blob. In proto3, only explicit setting it to
     * false will avoid using packed encoding.
     *
     * Generated from protobuf field <code>optional bool packed = 2;</code>
     * @return bool
     */
    public function getPacked()
    {
        return isset($this->packed) ? $this->packed : \false;
    }
    public function hasPacked()
    {
        return isset($this->packed);
    }
    public function clearPacked()
    {
        unset($this->packed);
    }
    /**
     * The packed option can be enabled for repeated primitive fields to enable
     * a more efficient representation on the wire. Rather than repeatedly
     * writing the tag and type for each element, the entire array is encoded as
     * a single length-delimited blob. In proto3, only explicit setting it to
     * false will avoid using packed encoding.
     *
     * Generated from protobuf field <code>optional bool packed = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setPacked($var)
    {
        GPBUtil::checkBool($var);
        $this->packed = $var;
        return $this;
    }
    /**
     * The jstype option determines the JavaScript type used for values of the
     * field.  The option is permitted only for 64 bit integral and fixed types
     * (int64, uint64, sint64, fixed64, sfixed64).  A field with jstype JS_STRING
     * is represented as JavaScript string, which avoids loss of precision that
     * can happen when a large value is converted to a floating point JavaScript.
     * Specifying JS_NUMBER for the jstype causes the generated JavaScript code to
     * use the JavaScript "number" type.  The behavior of the default option
     * JS_NORMAL is implementation dependent.
     * This option is an enum to permit additional types to be added, e.g.
     * goog.math.Integer.
     *
     * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.JSType jstype = 6 [default = JS_NORMAL];</code>
     * @return int
     */
    public function getJstype()
    {
        return isset($this->jstype) ? $this->jstype : 0;
    }
    public function hasJstype()
    {
        return isset($this->jstype);
    }
    public function clearJstype()
    {
        unset($this->jstype);
    }
    /**
     * The jstype option determines the JavaScript type used for values of the
     * field.  The option is permitted only for 64 bit integral and fixed types
     * (int64, uint64, sint64, fixed64, sfixed64).  A field with jstype JS_STRING
     * is represented as JavaScript string, which avoids loss of precision that
     * can happen when a large value is converted to a floating point JavaScript.
     * Specifying JS_NUMBER for the jstype causes the generated JavaScript code to
     * use the JavaScript "number" type.  The behavior of the default option
     * JS_NORMAL is implementation dependent.
     * This option is an enum to permit additional types to be added, e.g.
     * goog.math.Integer.
     *
     * Generated from protobuf field <code>optional .google.protobuf.FieldOptions.JSType jstype = 6 [default = JS_NORMAL];</code>
     * @param int $var
     * @return $this
     */
    public function setJstype($var)
    {
        GPBUtil::checkEnum($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\FieldOptions\JSType::class);
        $this->jstype = $var;
        return $this;
    }
    /**
     * Should this field be parsed lazily?  Lazy applies only to message-type
     * fields.  It means that when the outer message is initially parsed, the
     * inner message's contents will not be parsed but instead stored in encoded
     * form.  The inner message will actually be parsed when it is first accessed.
     * This is only a hint.  Implementations are free to choose whether to use
     * eager or lazy parsing regardless of the value of this option.  However,
     * setting this option true suggests that the protocol author believes that
     * using lazy parsing on this field is worth the additional bookkeeping
     * overhead typically needed to implement it.
     * This option does not affect the public interface of any generated code;
     * all method signatures remain the same.  Furthermore, thread-safety of the
     * interface is not affected by this option; const methods remain safe to
     * call from multiple threads concurrently, while non-const methods continue
     * to require exclusive access.
     * Note that implementations may choose not to check required fields within
     * a lazy sub-message.  That is, calling IsInitialized() on the outer message
     * may return true even if the inner message has missing required fields.
     * This is necessary because otherwise the inner message would have to be
     * parsed in order to perform the check, defeating the purpose of lazy
     * parsing.  An implementation which chooses not to check required fields
     * must be consistent about it.  That is, for any particular sub-message, the
     * implementation must either *always* check its required fields, or *never*
     * check its required fields, regardless of whether or not the message has
     * been parsed.
     * As of May 2022, lazy verifies the contents of the byte stream during
     * parsing.  An invalid byte stream will cause the overall parsing to fail.
     *
     * Generated from protobuf field <code>optional bool lazy = 5 [default = false];</code>
     * @return bool
     */
    public function getLazy()
    {
        return isset($this->lazy) ? $this->lazy : \false;
    }
    public function hasLazy()
    {
        return isset($this->lazy);
    }
    public function clearLazy()
    {
        unset($this->lazy);
    }
    /**
     * Should this field be parsed lazily?  Lazy applies only to message-type
     * fields.  It means that when the outer message is initially parsed, the
     * inner message's contents will not be parsed but instead stored in encoded
     * form.  The inner message will actually be parsed when it is first accessed.
     * This is only a hint.  Implementations are free to choose whether to use
     * eager or lazy parsing regardless of the value of this option.  However,
     * setting this option true suggests that the protocol author believes that
     * using lazy parsing on this field is worth the additional bookkeeping
     * overhead typically needed to implement it.
     * This option does not affect the public interface of any generated code;
     * all method signatures remain the same.  Furthermore, thread-safety of the
     * interface is not affected by this option; const methods remain safe to
     * call from multiple threads concurrently, while non-const methods continue
     * to require exclusive access.
     * Note that implementations may choose not to check required fields within
     * a lazy sub-message.  That is, calling IsInitialized() on the outer message
     * may return true even if the inner message has missing required fields.
     * This is necessary because otherwise the inner message would have to be
     * parsed in order to perform the check, defeating the purpose of lazy
     * parsing.  An implementation which chooses not to check required fields
     * must be consistent about it.  That is, for any particular sub-message, the
     * implementation must either *always* check its required fields, or *never*
     * check its required fields, regardless of whether or not the message has
     * been parsed.
     * As of May 2022, lazy verifies the contents of the byte stream during
     * parsing.  An invalid byte stream will cause the overall parsing to fail.
     *
     * Generated from protobuf field <code>optional bool lazy = 5 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setLazy($var)
    {
        GPBUtil::checkBool($var);
        $this->lazy = $var;
        return $this;
    }
    /**
     * unverified_lazy does no correctness checks on the byte stream. This should
     * only be used where lazy with verification is prohibitive for performance
     * reasons.
     *
     * Generated from protobuf field <code>optional bool unverified_lazy = 15 [default = false];</code>
     * @return bool
     */
    public function getUnverifiedLazy()
    {
        return isset($this->unverified_lazy) ? $this->unverified_lazy : \false;
    }
    public function hasUnverifiedLazy()
    {
        return isset($this->unverified_lazy);
    }
    public function clearUnverifiedLazy()
    {
        unset($this->unverified_lazy);
    }
    /**
     * unverified_lazy does no correctness checks on the byte stream. This should
     * only be used where lazy with verification is prohibitive for performance
     * reasons.
     *
     * Generated from protobuf field <code>optional bool unverified_lazy = 15 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setUnverifiedLazy($var)
    {
        GPBUtil::checkBool($var);
        $this->unverified_lazy = $var;
        return $this;
    }
    /**
     * Is this field deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for accessors, or it will be completely ignored; in the very least, this
     * is a formalization for deprecating fields.
     *
     * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
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
     * Is this field deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for accessors, or it will be completely ignored; in the very least, this
     * is a formalization for deprecating fields.
     *
     * Generated from protobuf field <code>optional bool deprecated = 3 [default = false];</code>
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
     * For Google-internal migration only. Do not use.
     *
     * Generated from protobuf field <code>optional bool weak = 10 [default = false];</code>
     * @return bool
     */
    public function getWeak()
    {
        return isset($this->weak) ? $this->weak : \false;
    }
    public function hasWeak()
    {
        return isset($this->weak);
    }
    public function clearWeak()
    {
        unset($this->weak);
    }
    /**
     * For Google-internal migration only. Do not use.
     *
     * Generated from protobuf field <code>optional bool weak = 10 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setWeak($var)
    {
        GPBUtil::checkBool($var);
        $this->weak = $var;
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
