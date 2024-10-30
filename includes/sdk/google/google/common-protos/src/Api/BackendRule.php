<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/backend.proto
namespace Dudlewebs\WPMCS\Google\Api;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * A backend rule provides configuration for an individual API element.
 *
 * Generated from protobuf message <code>google.api.BackendRule</code>
 */
class BackendRule extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * Selects the methods to which this rule applies.
     * Refer to [selector][google.api.DocumentationRule.selector] for syntax
     * details.
     *
     * Generated from protobuf field <code>string selector = 1;</code>
     */
    protected $selector = '';
    /**
     * The address of the API backend.
     * The scheme is used to determine the backend protocol and security.
     * The following schemes are accepted:
     *    SCHEME        PROTOCOL    SECURITY
     *    http://       HTTP        None
     *    https://      HTTP        TLS
     *    grpc://       gRPC        None
     *    grpcs://      gRPC        TLS
     * It is recommended to explicitly include a scheme. Leaving out the scheme
     * may cause constrasting behaviors across platforms.
     * If the port is unspecified, the default is:
     * - 80 for schemes without TLS
     * - 443 for schemes with TLS
     * For HTTP backends, use [protocol][google.api.BackendRule.protocol]
     * to specify the protocol version.
     *
     * Generated from protobuf field <code>string address = 2;</code>
     */
    protected $address = '';
    /**
     * The number of seconds to wait for a response from a request. The default
     * varies based on the request protocol and deployment environment.
     *
     * Generated from protobuf field <code>double deadline = 3;</code>
     */
    protected $deadline = 0.0;
    /**
     * Deprecated, do not use.
     *
     * Generated from protobuf field <code>double min_deadline = 4 [deprecated = true];</code>
     * @deprecated
     */
    protected $min_deadline = 0.0;
    /**
     * The number of seconds to wait for the completion of a long running
     * operation. The default is no deadline.
     *
     * Generated from protobuf field <code>double operation_deadline = 5;</code>
     */
    protected $operation_deadline = 0.0;
    /**
     * Generated from protobuf field <code>.google.api.BackendRule.PathTranslation path_translation = 6;</code>
     */
    protected $path_translation = 0;
    /**
     * The protocol used for sending a request to the backend.
     * The supported values are "http/1.1" and "h2".
     * The default value is inferred from the scheme in the
     * [address][google.api.BackendRule.address] field:
     *    SCHEME        PROTOCOL
     *    http://       http/1.1
     *    https://      http/1.1
     *    grpc://       h2
     *    grpcs://      h2
     * For secure HTTP backends (https://) that support HTTP/2, set this field
     * to "h2" for improved performance.
     * Configuring this field to non-default values is only supported for secure
     * HTTP backends. This field will be ignored for all other backends.
     * See
     * https://www.iana.org/assignments/tls-extensiontype-values/tls-extensiontype-values.xhtml#alpn-protocol-ids
     * for more details on the supported values.
     *
     * Generated from protobuf field <code>string protocol = 9;</code>
     */
    protected $protocol = '';
    /**
     * The map between request protocol and the backend address.
     *
     * Generated from protobuf field <code>map<string, .google.api.BackendRule> overrides_by_request_protocol = 10;</code>
     */
    private $overrides_by_request_protocol;
    protected $authentication;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $selector
     *           Selects the methods to which this rule applies.
     *           Refer to [selector][google.api.DocumentationRule.selector] for syntax
     *           details.
     *     @type string $address
     *           The address of the API backend.
     *           The scheme is used to determine the backend protocol and security.
     *           The following schemes are accepted:
     *              SCHEME        PROTOCOL    SECURITY
     *              http://       HTTP        None
     *              https://      HTTP        TLS
     *              grpc://       gRPC        None
     *              grpcs://      gRPC        TLS
     *           It is recommended to explicitly include a scheme. Leaving out the scheme
     *           may cause constrasting behaviors across platforms.
     *           If the port is unspecified, the default is:
     *           - 80 for schemes without TLS
     *           - 443 for schemes with TLS
     *           For HTTP backends, use [protocol][google.api.BackendRule.protocol]
     *           to specify the protocol version.
     *     @type float $deadline
     *           The number of seconds to wait for a response from a request. The default
     *           varies based on the request protocol and deployment environment.
     *     @type float $min_deadline
     *           Deprecated, do not use.
     *     @type float $operation_deadline
     *           The number of seconds to wait for the completion of a long running
     *           operation. The default is no deadline.
     *     @type int $path_translation
     *     @type string $jwt_audience
     *           The JWT audience is used when generating a JWT ID token for the backend.
     *           This ID token will be added in the HTTP "authorization" header, and sent
     *           to the backend.
     *     @type bool $disable_auth
     *           When disable_auth is true, a JWT ID token won't be generated and the
     *           original "Authorization" HTTP header will be preserved. If the header is
     *           used to carry the original token and is expected by the backend, this
     *           field must be set to true to preserve the header.
     *     @type string $protocol
     *           The protocol used for sending a request to the backend.
     *           The supported values are "http/1.1" and "h2".
     *           The default value is inferred from the scheme in the
     *           [address][google.api.BackendRule.address] field:
     *              SCHEME        PROTOCOL
     *              http://       http/1.1
     *              https://      http/1.1
     *              grpc://       h2
     *              grpcs://      h2
     *           For secure HTTP backends (https://) that support HTTP/2, set this field
     *           to "h2" for improved performance.
     *           Configuring this field to non-default values is only supported for secure
     *           HTTP backends. This field will be ignored for all other backends.
     *           See
     *           https://www.iana.org/assignments/tls-extensiontype-values/tls-extensiontype-values.xhtml#alpn-protocol-ids
     *           for more details on the supported values.
     *     @type array|\Google\Protobuf\Internal\MapField $overrides_by_request_protocol
     *           The map between request protocol and the backend address.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Api\Backend::initOnce();
        parent::__construct($data);
    }
    /**
     * Selects the methods to which this rule applies.
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
     * Selects the methods to which this rule applies.
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
     * The address of the API backend.
     * The scheme is used to determine the backend protocol and security.
     * The following schemes are accepted:
     *    SCHEME        PROTOCOL    SECURITY
     *    http://       HTTP        None
     *    https://      HTTP        TLS
     *    grpc://       gRPC        None
     *    grpcs://      gRPC        TLS
     * It is recommended to explicitly include a scheme. Leaving out the scheme
     * may cause constrasting behaviors across platforms.
     * If the port is unspecified, the default is:
     * - 80 for schemes without TLS
     * - 443 for schemes with TLS
     * For HTTP backends, use [protocol][google.api.BackendRule.protocol]
     * to specify the protocol version.
     *
     * Generated from protobuf field <code>string address = 2;</code>
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
    /**
     * The address of the API backend.
     * The scheme is used to determine the backend protocol and security.
     * The following schemes are accepted:
     *    SCHEME        PROTOCOL    SECURITY
     *    http://       HTTP        None
     *    https://      HTTP        TLS
     *    grpc://       gRPC        None
     *    grpcs://      gRPC        TLS
     * It is recommended to explicitly include a scheme. Leaving out the scheme
     * may cause constrasting behaviors across platforms.
     * If the port is unspecified, the default is:
     * - 80 for schemes without TLS
     * - 443 for schemes with TLS
     * For HTTP backends, use [protocol][google.api.BackendRule.protocol]
     * to specify the protocol version.
     *
     * Generated from protobuf field <code>string address = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setAddress($var)
    {
        GPBUtil::checkString($var, True);
        $this->address = $var;
        return $this;
    }
    /**
     * The number of seconds to wait for a response from a request. The default
     * varies based on the request protocol and deployment environment.
     *
     * Generated from protobuf field <code>double deadline = 3;</code>
     * @return float
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
    /**
     * The number of seconds to wait for a response from a request. The default
     * varies based on the request protocol and deployment environment.
     *
     * Generated from protobuf field <code>double deadline = 3;</code>
     * @param float $var
     * @return $this
     */
    public function setDeadline($var)
    {
        GPBUtil::checkDouble($var);
        $this->deadline = $var;
        return $this;
    }
    /**
     * Deprecated, do not use.
     *
     * Generated from protobuf field <code>double min_deadline = 4 [deprecated = true];</code>
     * @return float
     * @deprecated
     */
    public function getMinDeadline()
    {
        @trigger_error('min_deadline is deprecated.', \E_USER_DEPRECATED);
        return $this->min_deadline;
    }
    /**
     * Deprecated, do not use.
     *
     * Generated from protobuf field <code>double min_deadline = 4 [deprecated = true];</code>
     * @param float $var
     * @return $this
     * @deprecated
     */
    public function setMinDeadline($var)
    {
        @trigger_error('min_deadline is deprecated.', \E_USER_DEPRECATED);
        GPBUtil::checkDouble($var);
        $this->min_deadline = $var;
        return $this;
    }
    /**
     * The number of seconds to wait for the completion of a long running
     * operation. The default is no deadline.
     *
     * Generated from protobuf field <code>double operation_deadline = 5;</code>
     * @return float
     */
    public function getOperationDeadline()
    {
        return $this->operation_deadline;
    }
    /**
     * The number of seconds to wait for the completion of a long running
     * operation. The default is no deadline.
     *
     * Generated from protobuf field <code>double operation_deadline = 5;</code>
     * @param float $var
     * @return $this
     */
    public function setOperationDeadline($var)
    {
        GPBUtil::checkDouble($var);
        $this->operation_deadline = $var;
        return $this;
    }
    /**
     * Generated from protobuf field <code>.google.api.BackendRule.PathTranslation path_translation = 6;</code>
     * @return int
     */
    public function getPathTranslation()
    {
        return $this->path_translation;
    }
    /**
     * Generated from protobuf field <code>.google.api.BackendRule.PathTranslation path_translation = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setPathTranslation($var)
    {
        GPBUtil::checkEnum($var, \Dudlewebs\WPMCS\Google\Api\BackendRule\PathTranslation::class);
        $this->path_translation = $var;
        return $this;
    }
    /**
     * The JWT audience is used when generating a JWT ID token for the backend.
     * This ID token will be added in the HTTP "authorization" header, and sent
     * to the backend.
     *
     * Generated from protobuf field <code>string jwt_audience = 7;</code>
     * @return string
     */
    public function getJwtAudience()
    {
        return $this->readOneof(7);
    }
    public function hasJwtAudience()
    {
        return $this->hasOneof(7);
    }
    /**
     * The JWT audience is used when generating a JWT ID token for the backend.
     * This ID token will be added in the HTTP "authorization" header, and sent
     * to the backend.
     *
     * Generated from protobuf field <code>string jwt_audience = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setJwtAudience($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(7, $var);
        return $this;
    }
    /**
     * When disable_auth is true, a JWT ID token won't be generated and the
     * original "Authorization" HTTP header will be preserved. If the header is
     * used to carry the original token and is expected by the backend, this
     * field must be set to true to preserve the header.
     *
     * Generated from protobuf field <code>bool disable_auth = 8;</code>
     * @return bool
     */
    public function getDisableAuth()
    {
        return $this->readOneof(8);
    }
    public function hasDisableAuth()
    {
        return $this->hasOneof(8);
    }
    /**
     * When disable_auth is true, a JWT ID token won't be generated and the
     * original "Authorization" HTTP header will be preserved. If the header is
     * used to carry the original token and is expected by the backend, this
     * field must be set to true to preserve the header.
     *
     * Generated from protobuf field <code>bool disable_auth = 8;</code>
     * @param bool $var
     * @return $this
     */
    public function setDisableAuth($var)
    {
        GPBUtil::checkBool($var);
        $this->writeOneof(8, $var);
        return $this;
    }
    /**
     * The protocol used for sending a request to the backend.
     * The supported values are "http/1.1" and "h2".
     * The default value is inferred from the scheme in the
     * [address][google.api.BackendRule.address] field:
     *    SCHEME        PROTOCOL
     *    http://       http/1.1
     *    https://      http/1.1
     *    grpc://       h2
     *    grpcs://      h2
     * For secure HTTP backends (https://) that support HTTP/2, set this field
     * to "h2" for improved performance.
     * Configuring this field to non-default values is only supported for secure
     * HTTP backends. This field will be ignored for all other backends.
     * See
     * https://www.iana.org/assignments/tls-extensiontype-values/tls-extensiontype-values.xhtml#alpn-protocol-ids
     * for more details on the supported values.
     *
     * Generated from protobuf field <code>string protocol = 9;</code>
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }
    /**
     * The protocol used for sending a request to the backend.
     * The supported values are "http/1.1" and "h2".
     * The default value is inferred from the scheme in the
     * [address][google.api.BackendRule.address] field:
     *    SCHEME        PROTOCOL
     *    http://       http/1.1
     *    https://      http/1.1
     *    grpc://       h2
     *    grpcs://      h2
     * For secure HTTP backends (https://) that support HTTP/2, set this field
     * to "h2" for improved performance.
     * Configuring this field to non-default values is only supported for secure
     * HTTP backends. This field will be ignored for all other backends.
     * See
     * https://www.iana.org/assignments/tls-extensiontype-values/tls-extensiontype-values.xhtml#alpn-protocol-ids
     * for more details on the supported values.
     *
     * Generated from protobuf field <code>string protocol = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setProtocol($var)
    {
        GPBUtil::checkString($var, True);
        $this->protocol = $var;
        return $this;
    }
    /**
     * The map between request protocol and the backend address.
     *
     * Generated from protobuf field <code>map<string, .google.api.BackendRule> overrides_by_request_protocol = 10;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getOverridesByRequestProtocol()
    {
        return $this->overrides_by_request_protocol;
    }
    /**
     * The map between request protocol and the backend address.
     *
     * Generated from protobuf field <code>map<string, .google.api.BackendRule> overrides_by_request_protocol = 10;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setOverridesByRequestProtocol($var)
    {
        $arr = GPBUtil::checkMapField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::STRING, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Api\BackendRule::class);
        $this->overrides_by_request_protocol = $arr;
        return $this;
    }
    /**
     * @return string
     */
    public function getAuthentication()
    {
        return $this->whichOneof("authentication");
    }
}
