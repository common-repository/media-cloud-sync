<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/schemas/2019-12-02/waiters-2.json
return ['version' => 2, 'waiters' => ['CodeBindingExists' => ['description' => 'Wait until code binding is generated', 'delay' => 2, 'operation' => 'DescribeCodeBinding', 'maxAttempts' => 30, 'acceptors' => [['expected' => 'CREATE_COMPLETE', 'matcher' => 'path', 'state' => 'success', 'argument' => 'Status'], ['expected' => 'CREATE_IN_PROGRESS', 'matcher' => 'path', 'state' => 'retry', 'argument' => 'Status'], ['expected' => 'CREATE_FAILED', 'matcher' => 'path', 'state' => 'failure', 'argument' => 'Status'], ['matcher' => 'error', 'expected' => 'NotFoundException', 'state' => 'failure']]]]];
