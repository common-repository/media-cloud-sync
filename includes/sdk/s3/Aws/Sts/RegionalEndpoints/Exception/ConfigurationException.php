<?php

namespace Dudlewebs\WPMCS\s3\Aws\Sts\RegionalEndpoints\Exception;

use Dudlewebs\WPMCS\s3\Aws\HasMonitoringEventsTrait;
use Dudlewebs\WPMCS\s3\Aws\MonitoringEventsInterface;
/**
 * Represents an error interacting with configuration for sts regional endpoints
 */
class ConfigurationException extends \RuntimeException implements MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
