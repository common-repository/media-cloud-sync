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
 * Describes a message type.
 *
 * Generated from protobuf message <code>google.protobuf.DescriptorProto</code>
 */
class DescriptorProto extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>optional string name = 1;</code>
     */
    protected $name = null;
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto field = 2;</code>
     */
    private $field;
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto extension = 6;</code>
     */
    private $extension;
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto nested_type = 3;</code>
     */
    private $nested_type;
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto enum_type = 4;</code>
     */
    private $enum_type;
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ExtensionRange extension_range = 5;</code>
     */
    private $extension_range;
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.OneofDescriptorProto oneof_decl = 8;</code>
     */
    private $oneof_decl;
    /**
     * Generated from protobuf field <code>optional .google.protobuf.MessageOptions options = 7;</code>
     */
    protected $options = null;
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ReservedRange reserved_range = 9;</code>
     */
    private $reserved_range;
    /**
     * Reserved field names, which may not be used by fields in the same message.
     * A given name may only be reserved once.
     *
     * Generated from protobuf field <code>repeated string reserved_name = 10;</code>
     */
    private $reserved_name;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *     @type array<\Google\Protobuf\Internal\FieldDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $field
     *     @type array<\Google\Protobuf\Internal\FieldDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $extension
     *     @type array<\Google\Protobuf\Internal\DescriptorProto>|\Google\Protobuf\Internal\RepeatedField $nested_type
     *     @type array<\Google\Protobuf\Internal\EnumDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $enum_type
     *     @type array<\Google\Protobuf\Internal\DescriptorProto\ExtensionRange>|\Google\Protobuf\Internal\RepeatedField $extension_range
     *     @type array<\Google\Protobuf\Internal\OneofDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $oneof_decl
     *     @type \Google\Protobuf\Internal\MessageOptions $options
     *     @type array<\Google\Protobuf\Internal\DescriptorProto\ReservedRange>|\Google\Protobuf\Internal\RepeatedField $reserved_range
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $reserved_name
     *           Reserved field names, which may not be used by fields in the same message.
     *           A given name may only be reserved once.
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
     * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto field = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getField()
    {
        return $this->field;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto field = 2;</code>
     * @param array<\Google\Protobuf\Internal\FieldDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setField($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\FieldDescriptorProto::class);
        $this->field = $arr;
        return $this;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto extension = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getExtension()
    {
        return $this->extension;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.FieldDescriptorProto extension = 6;</code>
     * @param array<\Google\Protobuf\Internal\FieldDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setExtension($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\FieldDescriptorProto::class);
        $this->extension = $arr;
        return $this;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto nested_type = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getNestedType()
    {
        return $this->nested_type;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto nested_type = 3;</code>
     * @param array<\Google\Protobuf\Internal\DescriptorProto>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setNestedType($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\DescriptorProto::class);
        $this->nested_type = $arr;
        return $this;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto enum_type = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getEnumType()
    {
        return $this->enum_type;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.EnumDescriptorProto enum_type = 4;</code>
     * @param array<\Google\Protobuf\Internal\EnumDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setEnumType($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\EnumDescriptorProto::class);
        $this->enum_type = $arr;
        return $this;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ExtensionRange extension_range = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getExtensionRange()
    {
        return $this->extension_range;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ExtensionRange extension_range = 5;</code>
     * @param array<\Google\Protobuf\Internal\DescriptorProto\ExtensionRange>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setExtensionRange($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\DescriptorProto\ExtensionRange::class);
        $this->extension_range = $arr;
        return $this;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.OneofDescriptorProto oneof_decl = 8;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getOneofDecl()
    {
        return $this->oneof_decl;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.OneofDescriptorProto oneof_decl = 8;</code>
     * @param array<\Google\Protobuf\Internal\OneofDescriptorProto>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setOneofDecl($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\OneofDescriptorProto::class);
        $this->oneof_decl = $arr;
        return $this;
    }
    /**
     * Generated from protobuf field <code>optional .google.protobuf.MessageOptions options = 7;</code>
     * @return \Google\Protobuf\Internal\MessageOptions|null
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
     * Generated from protobuf field <code>optional .google.protobuf.MessageOptions options = 7;</code>
     * @param \Google\Protobuf\Internal\MessageOptions $var
     * @return $this
     */
    public function setOptions($var)
    {
        GPBUtil::checkMessage($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\MessageOptions::class);
        $this->options = $var;
        return $this;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ReservedRange reserved_range = 9;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getReservedRange()
    {
        return $this->reserved_range;
    }
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.DescriptorProto.ReservedRange reserved_range = 9;</code>
     * @param array<\Google\Protobuf\Internal\DescriptorProto\ReservedRange>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setReservedRange($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Protobuf\Internal\DescriptorProto\ReservedRange::class);
        $this->reserved_range = $arr;
        return $this;
    }
    /**
     * Reserved field names, which may not be used by fields in the same message.
     * A given name may only be reserved once.
     *
     * Generated from protobuf field <code>repeated string reserved_name = 10;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getReservedName()
    {
        return $this->reserved_name;
    }
    /**
     * Reserved field names, which may not be used by fields in the same message.
     * A given name may only be reserved once.
     *
     * Generated from protobuf field <code>repeated string reserved_name = 10;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setReservedName($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::STRING);
        $this->reserved_name = $arr;
        return $this;
    }
}
