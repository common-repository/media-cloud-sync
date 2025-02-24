<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/amp/2020-08-01/waiters-2.json
return ['version' => 2, 'waiters' => ['WorkspaceActive' => ['description' => 'Wait until a workspace reaches ACTIVE status', 'delay' => 2, 'maxAttempts' => 60, 'operation' => 'DescribeWorkspace', 'acceptors' => [['matcher' => 'path', 'argument' => 'workspace.status.statusCode', 'state' => 'success', 'expected' => 'ACTIVE'], ['matcher' => 'path', 'argument' => 'workspace.status.statusCode', 'state' => 'retry', 'expected' => 'UPDATING'], ['matcher' => 'path', 'argument' => 'workspace.status.statusCode', 'state' => 'retry', 'expected' => 'CREATING']]], 'WorkspaceDeleted' => ['description' => 'Wait until a workspace reaches DELETED status', 'delay' => 2, 'maxAttempts' => 60, 'operation' => 'DescribeWorkspace', 'acceptors' => [['matcher' => 'error', 'state' => 'success', 'expected' => 'ResourceNotFoundException'], ['matcher' => 'path', 'argument' => 'workspace.status.statusCode', 'state' => 'retry', 'expected' => 'DELETING']]]]];
