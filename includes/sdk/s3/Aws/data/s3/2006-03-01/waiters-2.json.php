<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/s3/2006-03-01/waiters-2.json
return ['version' => 2, 'waiters' => ['BucketExists' => ['delay' => 5, 'operation' => 'HeadBucket', 'maxAttempts' => 20, 'acceptors' => [['expected' => 200, 'matcher' => 'status', 'state' => 'success'], ['expected' => 301, 'matcher' => 'status', 'state' => 'success'], ['expected' => 403, 'matcher' => 'status', 'state' => 'success'], ['expected' => 404, 'matcher' => 'status', 'state' => 'retry']]], 'BucketNotExists' => ['delay' => 5, 'operation' => 'HeadBucket', 'maxAttempts' => 20, 'acceptors' => [['expected' => 404, 'matcher' => 'status', 'state' => 'success']]], 'ObjectExists' => ['delay' => 5, 'operation' => 'HeadObject', 'maxAttempts' => 20, 'acceptors' => [['expected' => 200, 'matcher' => 'status', 'state' => 'success'], ['expected' => 404, 'matcher' => 'status', 'state' => 'retry']]], 'ObjectNotExists' => ['delay' => 5, 'operation' => 'HeadObject', 'maxAttempts' => 20, 'acceptors' => [['expected' => 404, 'matcher' => 'status', 'state' => 'success']]]]];
