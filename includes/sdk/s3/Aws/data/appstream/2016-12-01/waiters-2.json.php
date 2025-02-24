<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/appstream/2016-12-01/waiters-2.json
return ['version' => 2, 'waiters' => ['FleetStarted' => ['delay' => 30, 'maxAttempts' => 40, 'operation' => 'DescribeFleets', 'acceptors' => [['state' => 'success', 'matcher' => 'pathAll', 'argument' => 'Fleets[].State', 'expected' => 'ACTIVE'], ['state' => 'failure', 'matcher' => 'pathAny', 'argument' => 'Fleets[].State', 'expected' => 'PENDING_DEACTIVATE'], ['state' => 'failure', 'matcher' => 'pathAny', 'argument' => 'Fleets[].State', 'expected' => 'INACTIVE']]], 'FleetStopped' => ['delay' => 30, 'maxAttempts' => 40, 'operation' => 'DescribeFleets', 'acceptors' => [['state' => 'success', 'matcher' => 'pathAll', 'argument' => 'Fleets[].State', 'expected' => 'INACTIVE'], ['state' => 'failure', 'matcher' => 'pathAny', 'argument' => 'Fleets[].State', 'expected' => 'PENDING_ACTIVATE'], ['state' => 'failure', 'matcher' => 'pathAny', 'argument' => 'Fleets[].State', 'expected' => 'ACTIVE']]]]];
