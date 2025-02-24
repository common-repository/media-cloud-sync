<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: grpc_gcp.proto
namespace Dudlewebs\WPMCS\Grpc\Gcp;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * Generated from protobuf message <code>grpc.gcp.ApiConfig</code>
 */
class ApiConfig extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * The channel pool configurations.
     *
     * Generated from protobuf field <code>.grpc.gcp.ChannelPoolConfig channel_pool = 2;</code>
     */
    private $channel_pool = null;
    /**
     * The method configurations.
     *
     * Generated from protobuf field <code>repeated .grpc.gcp.MethodConfig method = 1001;</code>
     */
    private $method;
    public function __construct()
    {
        \Dudlewebs\WPMCS\GPBMetadata\GrpcGcp::initOnce();
        parent::__construct();
    }
    /**
     * The channel pool configurations.
     *
     * Generated from protobuf field <code>.grpc.gcp.ChannelPoolConfig channel_pool = 2;</code>
     * @return \Grpc\Gcp\ChannelPoolConfig
     */
    public function getChannelPool()
    {
        return $this->channel_pool;
    }
    /**
     * The channel pool configurations.
     *
     * Generated from protobuf field <code>.grpc.gcp.ChannelPoolConfig channel_pool = 2;</code>
     * @param \Grpc\Gcp\ChannelPoolConfig $var
     * @return $this
     */
    public function setChannelPool($var)
    {
        GPBUtil::checkMessage($var, \Dudlewebs\WPMCS\Grpc\Gcp\ChannelPoolConfig::class);
        $this->channel_pool = $var;
        return $this;
    }
    /**
     * The method configurations.
     *
     * Generated from protobuf field <code>repeated .grpc.gcp.MethodConfig method = 1001;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMethod()
    {
        return $this->method;
    }
    /**
     * The method configurations.
     *
     * Generated from protobuf field <code>repeated .grpc.gcp.MethodConfig method = 1001;</code>
     * @param \Grpc\Gcp\MethodConfig[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setMethod($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Grpc\Gcp\MethodConfig::class);
        $this->method = $arr;
        return $this;
    }
}
