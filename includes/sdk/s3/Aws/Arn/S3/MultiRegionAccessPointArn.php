<?php

namespace Dudlewebs\WPMCS\s3\Aws\Arn\S3;

use Dudlewebs\WPMCS\s3\Aws\Arn\Arn;
use Dudlewebs\WPMCS\s3\Aws\Arn\ResourceTypeAndIdTrait;
/**
 * This class represents an S3 multi-region bucket ARN, which is in the
 * following format:
 *
 * @internal
 */
class MultiRegionAccessPointArn extends AccessPointArn
{
    use ResourceTypeAndIdTrait;
    /**
     * Parses a string into an associative array of components that represent
     * a MultiRegionArn
     *
     * @param $string
     * @return array
     */
    public static function parse($string)
    {
        return parent::parse($string);
    }
    /**
     *
     * @param array $data
     */
    public static function validate(array $data)
    {
        Arn::validate($data);
    }
}
