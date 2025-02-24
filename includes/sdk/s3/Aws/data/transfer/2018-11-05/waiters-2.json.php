<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/transfer/2018-11-05/waiters-2.json
return ['version' => 2, 'waiters' => ['ServerOffline' => ['acceptors' => [['argument' => 'Server.State', 'expected' => 'OFFLINE', 'matcher' => 'path', 'state' => 'success'], ['argument' => 'Server.State', 'expected' => 'STOP_FAILED', 'matcher' => 'path', 'state' => 'failure']], 'delay' => 30, 'maxAttempts' => 120, 'operation' => 'DescribeServer', 'type' => 'api'], 'ServerOnline' => ['acceptors' => [['argument' => 'Server.State', 'expected' => 'ONLINE', 'matcher' => 'path', 'state' => 'success'], ['argument' => 'Server.State', 'expected' => 'START_FAILED', 'matcher' => 'path', 'state' => 'failure']], 'delay' => 30, 'maxAttempts' => 120, 'operation' => 'DescribeServer', 'type' => 'api']]];
