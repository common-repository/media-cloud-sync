<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/error_reason.proto
namespace Dudlewebs\WPMCS\GPBMetadata\Google\Api;

class ErrorReason
{
    public static $is_initialized = \false;
    public static function initOnce()
    {
        $pool = \Dudlewebs\WPMCS\Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == \true) {
            return;
        }
        $pool->internalAddGeneratedFile('
�
google/api/error_reason.proto
google.api*�
ErrorReason
ERROR_REASON_UNSPECIFIED 
SERVICE_DISABLED
BILLING_DISABLED
API_KEY_INVALID
API_KEY_SERVICE_BLOCKED!
API_KEY_HTTP_REFERRER_BLOCKED
API_KEY_IP_ADDRESS_BLOCKED
API_KEY_ANDROID_APP_BLOCKED	
API_KEY_IOS_APP_BLOCKED
RATE_LIMIT_EXCEEDED
RESOURCE_QUOTA_EXCEEDED 
LOCATION_TAX_POLICY_VIOLATED

USER_PROJECT_DENIED
CONSUMER_SUSPENDED
CONSUMER_INVALID
SECURITY_POLICY_VIOLATED
ACCESS_TOKEN_EXPIRED#
ACCESS_TOKEN_SCOPE_INSUFFICIENT
ACCOUNT_STATE_INVALID!
ACCESS_TOKEN_TYPE_UNSUPPORTED
CREDENTIALS_MISSING
RESOURCE_PROJECT_INVALID
SESSION_COOKIE_INVALID
USER_BLOCKED_BY_ADMIN\'
#RESOURCE_USAGE_RESTRICTION_VIOLATED 
SYSTEM_PARAMETER_UNSUPPORTED
ORG_RESTRICTION_VIOLATION"
ORG_RESTRICTION_HEADER_INVALID
SERVICE_NOT_VISIBLE
GCP_SUSPENDEDBp
com.google.apiBErrorReasonProtoPZCgoogle.golang.org/genproto/googleapis/api/error_reason;error_reason�GAPIbproto3', \true);
        static::$is_initialized = \true;
    }
}
