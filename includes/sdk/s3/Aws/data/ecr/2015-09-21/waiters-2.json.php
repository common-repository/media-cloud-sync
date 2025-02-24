<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/ecr/2015-09-21/waiters-2.json
return ['version' => 2, 'waiters' => ['ImageScanComplete' => ['description' => 'Wait until an image scan is complete and findings can be accessed', 'operation' => 'DescribeImageScanFindings', 'delay' => 5, 'maxAttempts' => 60, 'acceptors' => [['state' => 'success', 'matcher' => 'path', 'argument' => 'imageScanStatus.status', 'expected' => 'COMPLETE'], ['state' => 'failure', 'matcher' => 'path', 'argument' => 'imageScanStatus.status', 'expected' => 'FAILED']]], 'LifecyclePolicyPreviewComplete' => ['description' => 'Wait until a lifecycle policy preview request is complete and results can be accessed', 'operation' => 'GetLifecyclePolicyPreview', 'delay' => 5, 'maxAttempts' => 20, 'acceptors' => [['state' => 'success', 'matcher' => 'path', 'argument' => 'status', 'expected' => 'COMPLETE'], ['state' => 'failure', 'matcher' => 'path', 'argument' => 'status', 'expected' => 'FAILED']]]]];
