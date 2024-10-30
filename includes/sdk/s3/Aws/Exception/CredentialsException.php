<?php

namespace Dudlewebs\WPMCS\s3\Aws\Exception;

use Dudlewebs\WPMCS\s3\Aws\HasMonitoringEventsTrait;
use Dudlewebs\WPMCS\s3\Aws\MonitoringEventsInterface;
class CredentialsException extends \RuntimeException implements MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
