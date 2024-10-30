<?php

/*
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/*
 * GENERATED CODE WARNING
 * Generated by gapic-generator-php from the file
 * https://github.com/googleapis/googleapis/blob/master/google/longrunning/operations.proto
 * Updates to the above are reflected here through a refresh process.
 */
namespace Dudlewebs\WPMCS\Google\LongRunning\Gapic;

use Dudlewebs\WPMCS\Google\ApiCore\ApiException;
use Dudlewebs\WPMCS\Google\ApiCore\CredentialsWrapper;
use Dudlewebs\WPMCS\Google\ApiCore\GapicClientTrait;
use Dudlewebs\WPMCS\Google\ApiCore\RequestParamsHeaderDescriptor;
use Dudlewebs\WPMCS\Google\ApiCore\RetrySettings;
use Dudlewebs\WPMCS\Google\ApiCore\Transport\TransportInterface;
use Dudlewebs\WPMCS\Google\ApiCore\ValidationException;
use Dudlewebs\WPMCS\Google\Auth\FetchAuthTokenInterface;
use Dudlewebs\WPMCS\Google\LongRunning\CancelOperationRequest;
use Dudlewebs\WPMCS\Google\LongRunning\DeleteOperationRequest;
use Dudlewebs\WPMCS\Google\LongRunning\GetOperationRequest;
use Dudlewebs\WPMCS\Google\LongRunning\ListOperationsRequest;
use Dudlewebs\WPMCS\Google\LongRunning\ListOperationsResponse;
use Dudlewebs\WPMCS\Google\LongRunning\Operation;
use Dudlewebs\WPMCS\Google\LongRunning\WaitOperationRequest;
use Dudlewebs\WPMCS\Google\Protobuf\Duration;
use Dudlewebs\WPMCS\Google\Protobuf\GPBEmpty;
/**
 * Service Description: Manages long-running operations with an API service.
 *
 * When an API method normally takes long time to complete, it can be designed
 * to return [Operation][google.longrunning.Operation] to the client, and the client can use this
 * interface to receive the real response asynchronously by polling the
 * operation resource, or pass the operation resource to another API (such as
 * Google Cloud Pub/Sub API) to receive the response.  Any API service that
 * returns long-running operations should implement the `Operations` interface
 * so developers can have a consistent client experience.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $operationsClient = new OperationsClient();
 * try {
 *     $name = 'name';
 *     $operationsClient->cancelOperation($name);
 * } finally {
 *     $operationsClient->close();
 * }
 * ```
 *
 * @deprecated Please use the new service client {@see \Google\LongRunning\Client\OperationsClient}.
 */
class OperationsGapicClient
{
    use GapicClientTrait;
    /** The name of the service. */
    const SERVICE_NAME = 'google.longrunning.Operations';
    /**
     * The default address of the service.
     *
     * @deprecated SERVICE_ADDRESS_TEMPLATE should be used instead.
     */
    const SERVICE_ADDRESS = 'longrunning.googleapis.com';
    /** The address template of the service. */
    private const SERVICE_ADDRESS_TEMPLATE = 'longrunning.UNIVERSE_DOMAIN';
    /** The default port of the service. */
    const DEFAULT_SERVICE_PORT = 443;
    /** The name of the code generator, to be included in the agent header. */
    const CODEGEN_NAME = 'gapic';
    /** The default scopes required by the service. */
    public static $serviceScopes = [];
    private static function getClientDefaults()
    {
        return ['serviceName' => self::SERVICE_NAME, 'apiEndpoint' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT, 'clientConfig' => __DIR__ . '/../resources/operations_client_config.json', 'descriptorsConfigPath' => __DIR__ . '/../resources/operations_descriptor_config.php', 'gcpApiConfigPath' => __DIR__ . '/../resources/operations_grpc_config.json', 'credentialsConfig' => ['defaultScopes' => self::$serviceScopes], 'transportConfig' => ['rest' => ['restClientConfigPath' => __DIR__ . '/../resources/operations_rest_client_config.php']]];
    }
    /**
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $apiEndpoint
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'longrunning.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the
     *           client. For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()} .
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either
     *           a path to a JSON file, or a PHP array containing the decoded JSON data. By
     *           default this settings points to the default client config file, which is
     *           provided in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string
     *           `rest` or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already
     *           instantiated {@see \Google\ApiCore\Transport\TransportInterface} object. Note
     *           that when this object is provided, any settings in $transportConfig, and any
     *           $apiEndpoint setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...],
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     *     @type callable $clientCertSource
     *           A callable which returns the client cert as a string. This can be used to
     *           provide a certificate and private key to the transport layer for mTLS.
     * }
     *
     * @throws ValidationException
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
    }
    /**
     * Starts asynchronous cancellation on a long-running operation.  The server
     * makes a best effort to cancel the operation, but success is not
     * guaranteed.  If the server doesn't support this method, it returns
     * `google.rpc.Code.UNIMPLEMENTED`.  Clients can use
     * [Operations.GetOperation][google.longrunning.Operations.GetOperation] or
     * other methods to check whether the cancellation succeeded or whether the
     * operation completed despite cancellation. On successful cancellation,
     * the operation is not deleted; instead, it becomes an operation with
     * an [Operation.error][google.longrunning.Operation.error] value with a [google.rpc.Status.code][google.rpc.Status.code] of 1,
     * corresponding to `Code.CANCELLED`.
     *
     * Sample code:
     * ```
     * $operationsClient = new OperationsClient();
     * try {
     *     $name = 'name';
     *     $operationsClient->cancelOperation($name);
     * } finally {
     *     $operationsClient->close();
     * }
     * ```
     *
     * @param string $name         The name of the operation resource to be cancelled.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     */
    public function cancelOperation($name, array $optionalArgs = [])
    {
        $request = new CancelOperationRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CancelOperation', GPBEmpty::class, $optionalArgs, $request)->wait();
    }
    /**
     * Deletes a long-running operation. This method indicates that the client is
     * no longer interested in the operation result. It does not cancel the
     * operation. If the server doesn't support this method, it returns
     * `google.rpc.Code.UNIMPLEMENTED`.
     *
     * Sample code:
     * ```
     * $operationsClient = new OperationsClient();
     * try {
     *     $name = 'name';
     *     $operationsClient->deleteOperation($name);
     * } finally {
     *     $operationsClient->close();
     * }
     * ```
     *
     * @param string $name         The name of the operation resource to be deleted.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     */
    public function deleteOperation($name, array $optionalArgs = [])
    {
        $request = new DeleteOperationRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('DeleteOperation', GPBEmpty::class, $optionalArgs, $request)->wait();
    }
    /**
     * Gets the latest state of a long-running operation.  Clients can use this
     * method to poll the operation result at intervals as recommended by the API
     * service.
     *
     * Sample code:
     * ```
     * $operationsClient = new OperationsClient();
     * try {
     *     $name = 'name';
     *     $response = $operationsClient->getOperation($name);
     * } finally {
     *     $operationsClient->close();
     * }
     * ```
     *
     * @param string $name         The name of the operation resource.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return \Google\LongRunning\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function getOperation($name, array $optionalArgs = [])
    {
        $request = new GetOperationRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetOperation', Operation::class, $optionalArgs, $request)->wait();
    }
    /**
     * Lists operations that match the specified filter in the request. If the
     * server doesn't support this method, it returns `UNIMPLEMENTED`.
     *
     * NOTE: the `name` binding allows API services to override the binding
     * to use different resource name schemes, such as `users/&#42;/operations`. To
     * override the binding, API services can add a binding such as
     * `"/v1/{name=users/*}/operations"` to their service configuration.
     * For backwards compatibility, the default name includes the operations
     * collection id, however overriding users must ensure the name binding
     * is the parent resource, without the operations collection id.
     *
     * Sample code:
     * ```
     * $operationsClient = new OperationsClient();
     * try {
     *     $name = 'name';
     *     $filter = 'filter';
     *     // Iterate over pages of elements
     *     $pagedResponse = $operationsClient->listOperations($name, $filter);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *     // Alternatively:
     *     // Iterate through all elements
     *     $pagedResponse = $operationsClient->listOperations($name, $filter);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $operationsClient->close();
     * }
     * ```
     *
     * @param string $name         The name of the operation's parent resource.
     * @param string $filter       The standard list filter.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type int $pageSize
     *           The maximum number of resources contained in the underlying API
     *           response. The API may return fewer values in a page, even if
     *           there are additional values to be retrieved.
     *     @type string $pageToken
     *           A page token is used to specify a page of values to be returned.
     *           If no page token is specified (the default), the first page
     *           of values will be returned. Any page token used here must have
     *           been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function listOperations($name, $filter, array $optionalArgs = [])
    {
        $request = new ListOperationsRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $request->setFilter($filter);
        $requestParamHeaders['name'] = $name;
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->getPagedListResponse('ListOperations', $optionalArgs, ListOperationsResponse::class, $request);
    }
    /**
     * Waits until the specified long-running operation is done or reaches at most
     * a specified timeout, returning the latest state.  If the operation is
     * already done, the latest state is immediately returned.  If the timeout
     * specified is greater than the default HTTP/RPC timeout, the HTTP/RPC
     * timeout is used.  If the server does not support this method, it returns
     * `google.rpc.Code.UNIMPLEMENTED`.
     * Note that this method is on a best-effort basis.  It may return the latest
     * state before the specified timeout (including immediately), meaning even an
     * immediate response is no guarantee that the operation is done.
     *
     * Sample code:
     * ```
     * $operationsClient = new OperationsClient();
     * try {
     *     $response = $operationsClient->waitOperation();
     * } finally {
     *     $operationsClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $name
     *           The name of the operation resource to wait on.
     *     @type Duration $timeout
     *           The maximum duration to wait before timing out. If left blank, the wait
     *           will be at most the time permitted by the underlying HTTP/RPC protocol.
     *           If RPC context deadline is also specified, the shorter one will be used.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return \Google\LongRunning\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function waitOperation(array $optionalArgs = [])
    {
        $request = new WaitOperationRequest();
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
        }
        if (isset($optionalArgs['timeout'])) {
            $request->setTimeout($optionalArgs['timeout']);
        }
        return $this->startCall('WaitOperation', Operation::class, $optionalArgs, $request)->wait();
    }
}
