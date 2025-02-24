<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/dynamodb/2011-12-05/waiters-2.json
return ['version' => 2, 'waiters' => ['TableExists' => ['delay' => 20, 'operation' => 'DescribeTable', 'maxAttempts' => 25, 'acceptors' => [['expected' => 'ACTIVE', 'matcher' => 'path', 'state' => 'success', 'argument' => 'Table.TableStatus'], ['expected' => 'ResourceNotFoundException', 'matcher' => 'error', 'state' => 'retry']]], 'TableNotExists' => ['delay' => 20, 'operation' => 'DescribeTable', 'maxAttempts' => 25, 'acceptors' => [['expected' => 'ResourceNotFoundException', 'matcher' => 'error', 'state' => 'success']]]]];
