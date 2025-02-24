<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/acm/2015-12-08/waiters-2.json
return ['version' => 2, 'waiters' => ['CertificateValidated' => ['delay' => 60, 'maxAttempts' => 40, 'operation' => 'DescribeCertificate', 'acceptors' => [['matcher' => 'pathAll', 'expected' => 'SUCCESS', 'argument' => 'Certificate.DomainValidationOptions[].ValidationStatus', 'state' => 'success'], ['matcher' => 'pathAny', 'expected' => 'PENDING_VALIDATION', 'argument' => 'Certificate.DomainValidationOptions[].ValidationStatus', 'state' => 'retry'], ['matcher' => 'path', 'expected' => 'FAILED', 'argument' => 'Certificate.Status', 'state' => 'failure'], ['matcher' => 'error', 'expected' => 'ResourceNotFoundException', 'state' => 'failure']]]]];
