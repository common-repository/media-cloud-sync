<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/ssm/2014-11-06/waiters-2.json
return ['version' => 2, 'waiters' => ['CommandExecuted' => ['delay' => 5, 'operation' => 'GetCommandInvocation', 'maxAttempts' => 20, 'acceptors' => [['expected' => 'Pending', 'matcher' => 'path', 'state' => 'retry', 'argument' => 'Status'], ['expected' => 'InProgress', 'matcher' => 'path', 'state' => 'retry', 'argument' => 'Status'], ['expected' => 'Delayed', 'matcher' => 'path', 'state' => 'retry', 'argument' => 'Status'], ['expected' => 'Success', 'matcher' => 'path', 'state' => 'success', 'argument' => 'Status'], ['expected' => 'Cancelled', 'matcher' => 'path', 'state' => 'failure', 'argument' => 'Status'], ['expected' => 'TimedOut', 'matcher' => 'path', 'state' => 'failure', 'argument' => 'Status'], ['expected' => 'Failed', 'matcher' => 'path', 'state' => 'failure', 'argument' => 'Status'], ['expected' => 'Cancelling', 'matcher' => 'path', 'state' => 'failure', 'argument' => 'Status'], ['state' => 'retry', 'matcher' => 'error', 'expected' => 'InvocationDoesNotExist']]]]];
