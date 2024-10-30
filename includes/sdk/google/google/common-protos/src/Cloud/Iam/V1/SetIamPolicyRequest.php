<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/iam/v1/iam_policy.proto
namespace Dudlewebs\WPMCS\Google\Cloud\Iam\V1;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * Request message for `SetIamPolicy` method.
 *
 * Generated from protobuf message <code>google.iam.v1.SetIamPolicyRequest</code>
 */
class SetIamPolicyRequest extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * REQUIRED: The resource for which the policy is being specified.
     * See the operation documentation for the appropriate value for this field.
     *
     * Generated from protobuf field <code>string resource = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    protected $resource = '';
    /**
     * REQUIRED: The complete policy to be applied to the `resource`. The size of
     * the policy is limited to a few 10s of KB. An empty policy is a
     * valid policy but certain Cloud Platform services (such as Projects)
     * might reject them.
     *
     * Generated from protobuf field <code>.google.iam.v1.Policy policy = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    protected $policy = null;
    /**
     * OPTIONAL: A FieldMask specifying which fields of the policy to modify. Only
     * the fields in the mask will be modified. If no mask is provided, the
     * following default mask is used:
     * `paths: "bindings, etag"`
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 3;</code>
     */
    protected $update_mask = null;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $resource
     *           REQUIRED: The resource for which the policy is being specified.
     *           See the operation documentation for the appropriate value for this field.
     *     @type \Google\Cloud\Iam\V1\Policy $policy
     *           REQUIRED: The complete policy to be applied to the `resource`. The size of
     *           the policy is limited to a few 10s of KB. An empty policy is a
     *           valid policy but certain Cloud Platform services (such as Projects)
     *           might reject them.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           OPTIONAL: A FieldMask specifying which fields of the policy to modify. Only
     *           the fields in the mask will be modified. If no mask is provided, the
     *           following default mask is used:
     *           `paths: "bindings, etag"`
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Iam\V1\IamPolicy::initOnce();
        parent::__construct($data);
    }
    /**
     * REQUIRED: The resource for which the policy is being specified.
     * See the operation documentation for the appropriate value for this field.
     *
     * Generated from protobuf field <code>string resource = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }
    /**
     * REQUIRED: The resource for which the policy is being specified.
     * See the operation documentation for the appropriate value for this field.
     *
     * Generated from protobuf field <code>string resource = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setResource($var)
    {
        GPBUtil::checkString($var, True);
        $this->resource = $var;
        return $this;
    }
    /**
     * REQUIRED: The complete policy to be applied to the `resource`. The size of
     * the policy is limited to a few 10s of KB. An empty policy is a
     * valid policy but certain Cloud Platform services (such as Projects)
     * might reject them.
     *
     * Generated from protobuf field <code>.google.iam.v1.Policy policy = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\Iam\V1\Policy|null
     */
    public function getPolicy()
    {
        return $this->policy;
    }
    public function hasPolicy()
    {
        return isset($this->policy);
    }
    public function clearPolicy()
    {
        unset($this->policy);
    }
    /**
     * REQUIRED: The complete policy to be applied to the `resource`. The size of
     * the policy is limited to a few 10s of KB. An empty policy is a
     * valid policy but certain Cloud Platform services (such as Projects)
     * might reject them.
     *
     * Generated from protobuf field <code>.google.iam.v1.Policy policy = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\Iam\V1\Policy $var
     * @return $this
     */
    public function setPolicy($var)
    {
        GPBUtil::checkMessage($var, \Dudlewebs\WPMCS\Google\Cloud\Iam\V1\Policy::class);
        $this->policy = $var;
        return $this;
    }
    /**
     * OPTIONAL: A FieldMask specifying which fields of the policy to modify. Only
     * the fields in the mask will be modified. If no mask is provided, the
     * following default mask is used:
     * `paths: "bindings, etag"`
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 3;</code>
     * @return \Google\Protobuf\FieldMask|null
     */
    public function getUpdateMask()
    {
        return $this->update_mask;
    }
    public function hasUpdateMask()
    {
        return isset($this->update_mask);
    }
    public function clearUpdateMask()
    {
        unset($this->update_mask);
    }
    /**
     * OPTIONAL: A FieldMask specifying which fields of the policy to modify. Only
     * the fields in the mask will be modified. If no mask is provided, the
     * following default mask is used:
     * `paths: "bindings, etag"`
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 3;</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Dudlewebs\WPMCS\Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;
        return $this;
    }
}
