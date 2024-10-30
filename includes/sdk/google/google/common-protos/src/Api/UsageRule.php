<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/usage.proto
namespace Dudlewebs\WPMCS\Google\Api;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * Usage configuration rules for the service.
 * NOTE: Under development.
 * Use this rule to configure unregistered calls for the service. Unregistered
 * calls are calls that do not contain consumer project identity.
 * (Example: calls that do not contain an API key).
 * By default, API methods do not allow unregistered calls, and each method call
 * must be identified by a consumer project identity. Use this rule to
 * allow/disallow unregistered calls.
 * Example of an API that wants to allow unregistered calls for entire service.
 *     usage:
 *       rules:
 *       - selector: "*"
 *         allow_unregistered_calls: true
 * Example of a method that wants to allow unregistered calls.
 *     usage:
 *       rules:
 *       - selector: "google.example.library.v1.LibraryService.CreateBook"
 *         allow_unregistered_calls: true
 *
 * Generated from protobuf message <code>google.api.UsageRule</code>
 */
class UsageRule extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Selects the methods to which this rule applies. Use '*' to indicate all
     * methods in all APIs.
     * Refer to [selector][google.api.DocumentationRule.selector] for syntax
     * details.
     *
     * Generated from protobuf field <code>string selector = 1;</code>
     */
    protected $selector = '';
    /**
     * If true, the selected method allows unregistered calls, e.g. calls
     * that don't identify any user or application.
     *
     * Generated from protobuf field <code>bool allow_unregistered_calls = 2;</code>
     */
    protected $allow_unregistered_calls = \false;
    /**
     * If true, the selected method should skip service control and the control
     * plane features, such as quota and billing, will not be available.
     * This flag is used by Google Cloud Endpoints to bypass checks for internal
     * methods, such as service health check methods.
     *
     * Generated from protobuf field <code>bool skip_service_control = 3;</code>
     */
    protected $skip_service_control = \false;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $selector
     *           Selects the methods to which this rule applies. Use '*' to indicate all
     *           methods in all APIs.
     *           Refer to [selector][google.api.DocumentationRule.selector] for syntax
     *           details.
     *     @type bool $allow_unregistered_calls
     *           If true, the selected method allows unregistered calls, e.g. calls
     *           that don't identify any user or application.
     *     @type bool $skip_service_control
     *           If true, the selected method should skip service control and the control
     *           plane features, such as quota and billing, will not be available.
     *           This flag is used by Google Cloud Endpoints to bypass checks for internal
     *           methods, such as service health check methods.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Api\Usage::initOnce();
        parent::__construct($data);
    }
    /**
     * Selects the methods to which this rule applies. Use '*' to indicate all
     * methods in all APIs.
     * Refer to [selector][google.api.DocumentationRule.selector] for syntax
     * details.
     *
     * Generated from protobuf field <code>string selector = 1;</code>
     * @return string
     */
    public function getSelector()
    {
        return $this->selector;
    }
    /**
     * Selects the methods to which this rule applies. Use '*' to indicate all
     * methods in all APIs.
     * Refer to [selector][google.api.DocumentationRule.selector] for syntax
     * details.
     *
     * Generated from protobuf field <code>string selector = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSelector($var)
    {
        GPBUtil::checkString($var, True);
        $this->selector = $var;
        return $this;
    }
    /**
     * If true, the selected method allows unregistered calls, e.g. calls
     * that don't identify any user or application.
     *
     * Generated from protobuf field <code>bool allow_unregistered_calls = 2;</code>
     * @return bool
     */
    public function getAllowUnregisteredCalls()
    {
        return $this->allow_unregistered_calls;
    }
    /**
     * If true, the selected method allows unregistered calls, e.g. calls
     * that don't identify any user or application.
     *
     * Generated from protobuf field <code>bool allow_unregistered_calls = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setAllowUnregisteredCalls($var)
    {
        GPBUtil::checkBool($var);
        $this->allow_unregistered_calls = $var;
        return $this;
    }
    /**
     * If true, the selected method should skip service control and the control
     * plane features, such as quota and billing, will not be available.
     * This flag is used by Google Cloud Endpoints to bypass checks for internal
     * methods, such as service health check methods.
     *
     * Generated from protobuf field <code>bool skip_service_control = 3;</code>
     * @return bool
     */
    public function getSkipServiceControl()
    {
        return $this->skip_service_control;
    }
    /**
     * If true, the selected method should skip service control and the control
     * plane features, such as quota and billing, will not be available.
     * This flag is used by Google Cloud Endpoints to bypass checks for internal
     * methods, such as service health check methods.
     *
     * Generated from protobuf field <code>bool skip_service_control = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setSkipServiceControl($var)
    {
        GPBUtil::checkBool($var);
        $this->skip_service_control = $var;
        return $this;
    }
}
