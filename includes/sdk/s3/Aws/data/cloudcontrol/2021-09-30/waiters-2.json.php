<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/cloudcontrol/2021-09-30/waiters-2.json
return ['version' => 2, 'waiters' => ['ResourceRequestSuccess' => ['description' => 'Wait until resource operation request is successful', 'delay' => 5, 'maxAttempts' => 24, 'operation' => 'GetResourceRequestStatus', 'acceptors' => [['matcher' => 'path', 'argument' => 'ProgressEvent.OperationStatus', 'state' => 'success', 'expected' => 'SUCCESS'], ['matcher' => 'path', 'argument' => 'ProgressEvent.OperationStatus', 'state' => 'failure', 'expected' => 'FAILED'], ['matcher' => 'path', 'argument' => 'ProgressEvent.OperationStatus', 'state' => 'failure', 'expected' => 'CANCEL_COMPLETE']]]]];
