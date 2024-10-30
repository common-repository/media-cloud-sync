<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/metric.proto
namespace Dudlewebs\WPMCS\Google\Api;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * A specific metric, identified by specifying values for all of the
 * labels of a [`MetricDescriptor`][google.api.MetricDescriptor].
 *
 * Generated from protobuf message <code>google.api.Metric</code>
 */
class Metric extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * An existing metric type, see
     * [google.api.MetricDescriptor][google.api.MetricDescriptor]. For example,
     * `custom.googleapis.com/invoice/paid/amount`.
     *
     * Generated from protobuf field <code>string type = 3;</code>
     */
    protected $type = '';
    /**
     * The set of label values that uniquely identify this metric. All
     * labels listed in the `MetricDescriptor` must be assigned values.
     *
     * Generated from protobuf field <code>map<string, string> labels = 2;</code>
     */
    private $labels;
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $type
     *           An existing metric type, see
     *           [google.api.MetricDescriptor][google.api.MetricDescriptor]. For example,
     *           `custom.googleapis.com/invoice/paid/amount`.
     *     @type array|\Google\Protobuf\Internal\MapField $labels
     *           The set of label values that uniquely identify this metric. All
     *           labels listed in the `MetricDescriptor` must be assigned values.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Api\Metric::initOnce();
        parent::__construct($data);
    }
    /**
     * An existing metric type, see
     * [google.api.MetricDescriptor][google.api.MetricDescriptor]. For example,
     * `custom.googleapis.com/invoice/paid/amount`.
     *
     * Generated from protobuf field <code>string type = 3;</code>
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * An existing metric type, see
     * [google.api.MetricDescriptor][google.api.MetricDescriptor]. For example,
     * `custom.googleapis.com/invoice/paid/amount`.
     *
     * Generated from protobuf field <code>string type = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkString($var, True);
        $this->type = $var;
        return $this;
    }
    /**
     * The set of label values that uniquely identify this metric. All
     * labels listed in the `MetricDescriptor` must be assigned values.
     *
     * Generated from protobuf field <code>map<string, string> labels = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getLabels()
    {
        return $this->labels;
    }
    /**
     * The set of label values that uniquely identify this metric. All
     * labels listed in the `MetricDescriptor` must be assigned values.
     *
     * Generated from protobuf field <code>map<string, string> labels = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setLabels($var)
    {
        $arr = GPBUtil::checkMapField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::STRING, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::STRING);
        $this->labels = $arr;
        return $this;
    }
}
