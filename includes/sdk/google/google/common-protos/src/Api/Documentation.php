<?php

# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/documentation.proto
namespace Dudlewebs\WPMCS\Google\Api;

use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\RepeatedField;
use Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBUtil;
/**
 * `Documentation` provides the information for describing a service.
 * Example:
 * <pre><code>documentation:
 *   summary: >
 *     The Google Calendar API gives access
 *     to most calendar features.
 *   pages:
 *   - name: Overview
 *     content: &#40;== include google/foo/overview.md ==&#41;
 *   - name: Tutorial
 *     content: &#40;== include google/foo/tutorial.md ==&#41;
 *     subpages;
 *     - name: Java
 *       content: &#40;== include google/foo/tutorial_java.md ==&#41;
 *   rules:
 *   - selector: google.calendar.Calendar.Get
 *     description: >
 *       ...
 *   - selector: google.calendar.Calendar.Put
 *     description: >
 *       ...
 * </code></pre>
 * Documentation is provided in markdown syntax. In addition to
 * standard markdown features, definition lists, tables and fenced
 * code blocks are supported. Section headers can be provided and are
 * interpreted relative to the section nesting of the context where
 * a documentation fragment is embedded.
 * Documentation from the IDL is merged with documentation defined
 * via the config at normalization time, where documentation provided
 * by config rules overrides IDL provided.
 * A number of constructs specific to the API platform are supported
 * in documentation text.
 * In order to reference a proto element, the following
 * notation can be used:
 * <pre><code>&#91;fully.qualified.proto.name]&#91;]</code></pre>
 * To override the display text used for the link, this can be used:
 * <pre><code>&#91;display text]&#91;fully.qualified.proto.name]</code></pre>
 * Text can be excluded from doc using the following notation:
 * <pre><code>&#40;-- internal comment --&#41;</code></pre>
 * A few directives are available in documentation. Note that
 * directives must appear on a single line to be properly
 * identified. The `include` directive includes a markdown file from
 * an external source:
 * <pre><code>&#40;== include path/to/file ==&#41;</code></pre>
 * The `resource_for` directive marks a message to be the resource of
 * a collection in REST view. If it is not specified, tools attempt
 * to infer the resource from the operations in a collection:
 * <pre><code>&#40;== resource_for v1.shelves.books ==&#41;</code></pre>
 * The directive `suppress_warning` does not directly affect documentation
 * and is documented together with service config validation.
 *
 * Generated from protobuf message <code>google.api.Documentation</code>
 */
class Documentation extends \Dudlewebs\WPMCS\Google\Protobuf\Internal\Message
{
    /**
     * A short description of what the service does. The summary must be plain
     * text. It becomes the overview of the service displayed in Google Cloud
     * Console.
     * NOTE: This field is equivalent to the standard field `description`.
     *
     * Generated from protobuf field <code>string summary = 1;</code>
     */
    protected $summary = '';
    /**
     * The top level pages for the documentation set.
     *
     * Generated from protobuf field <code>repeated .google.api.Page pages = 5;</code>
     */
    private $pages;
    /**
     * A list of documentation rules that apply to individual API elements.
     * **NOTE:** All service configuration rules follow "last one wins" order.
     *
     * Generated from protobuf field <code>repeated .google.api.DocumentationRule rules = 3;</code>
     */
    private $rules;
    /**
     * The URL to the root of documentation.
     *
     * Generated from protobuf field <code>string documentation_root_url = 4;</code>
     */
    protected $documentation_root_url = '';
    /**
     * Specifies the service root url if the default one (the service name
     * from the yaml file) is not suitable. This can be seen in any fully
     * specified service urls as well as sections that show a base that other
     * urls are relative to.
     *
     * Generated from protobuf field <code>string service_root_url = 6;</code>
     */
    protected $service_root_url = '';
    /**
     * Declares a single overview page. For example:
     * <pre><code>documentation:
     *   summary: ...
     *   overview: &#40;== include overview.md ==&#41;
     * </code></pre>
     * This is a shortcut for the following declaration (using pages style):
     * <pre><code>documentation:
     *   summary: ...
     *   pages:
     *   - name: Overview
     *     content: &#40;== include overview.md ==&#41;
     * </code></pre>
     * Note: you cannot specify both `overview` field and `pages` field.
     *
     * Generated from protobuf field <code>string overview = 2;</code>
     */
    protected $overview = '';
    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $summary
     *           A short description of what the service does. The summary must be plain
     *           text. It becomes the overview of the service displayed in Google Cloud
     *           Console.
     *           NOTE: This field is equivalent to the standard field `description`.
     *     @type array<\Google\Api\Page>|\Google\Protobuf\Internal\RepeatedField $pages
     *           The top level pages for the documentation set.
     *     @type array<\Google\Api\DocumentationRule>|\Google\Protobuf\Internal\RepeatedField $rules
     *           A list of documentation rules that apply to individual API elements.
     *           **NOTE:** All service configuration rules follow "last one wins" order.
     *     @type string $documentation_root_url
     *           The URL to the root of documentation.
     *     @type string $service_root_url
     *           Specifies the service root url if the default one (the service name
     *           from the yaml file) is not suitable. This can be seen in any fully
     *           specified service urls as well as sections that show a base that other
     *           urls are relative to.
     *     @type string $overview
     *           Declares a single overview page. For example:
     *           <pre><code>documentation:
     *             summary: ...
     *             overview: &#40;== include overview.md ==&#41;
     *           </code></pre>
     *           This is a shortcut for the following declaration (using pages style):
     *           <pre><code>documentation:
     *             summary: ...
     *             pages:
     *             - name: Overview
     *               content: &#40;== include overview.md ==&#41;
     *           </code></pre>
     *           Note: you cannot specify both `overview` field and `pages` field.
     * }
     */
    public function __construct($data = NULL)
    {
        \Dudlewebs\WPMCS\GPBMetadata\Google\Api\Documentation::initOnce();
        parent::__construct($data);
    }
    /**
     * A short description of what the service does. The summary must be plain
     * text. It becomes the overview of the service displayed in Google Cloud
     * Console.
     * NOTE: This field is equivalent to the standard field `description`.
     *
     * Generated from protobuf field <code>string summary = 1;</code>
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
    /**
     * A short description of what the service does. The summary must be plain
     * text. It becomes the overview of the service displayed in Google Cloud
     * Console.
     * NOTE: This field is equivalent to the standard field `description`.
     *
     * Generated from protobuf field <code>string summary = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSummary($var)
    {
        GPBUtil::checkString($var, True);
        $this->summary = $var;
        return $this;
    }
    /**
     * The top level pages for the documentation set.
     *
     * Generated from protobuf field <code>repeated .google.api.Page pages = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPages()
    {
        return $this->pages;
    }
    /**
     * The top level pages for the documentation set.
     *
     * Generated from protobuf field <code>repeated .google.api.Page pages = 5;</code>
     * @param array<\Google\Api\Page>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPages($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Api\Page::class);
        $this->pages = $arr;
        return $this;
    }
    /**
     * A list of documentation rules that apply to individual API elements.
     * **NOTE:** All service configuration rules follow "last one wins" order.
     *
     * Generated from protobuf field <code>repeated .google.api.DocumentationRule rules = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRules()
    {
        return $this->rules;
    }
    /**
     * A list of documentation rules that apply to individual API elements.
     * **NOTE:** All service configuration rules follow "last one wins" order.
     *
     * Generated from protobuf field <code>repeated .google.api.DocumentationRule rules = 3;</code>
     * @param array<\Google\Api\DocumentationRule>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRules($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Dudlewebs\WPMCS\Google\Protobuf\Internal\GPBType::MESSAGE, \Dudlewebs\WPMCS\Google\Api\DocumentationRule::class);
        $this->rules = $arr;
        return $this;
    }
    /**
     * The URL to the root of documentation.
     *
     * Generated from protobuf field <code>string documentation_root_url = 4;</code>
     * @return string
     */
    public function getDocumentationRootUrl()
    {
        return $this->documentation_root_url;
    }
    /**
     * The URL to the root of documentation.
     *
     * Generated from protobuf field <code>string documentation_root_url = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setDocumentationRootUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->documentation_root_url = $var;
        return $this;
    }
    /**
     * Specifies the service root url if the default one (the service name
     * from the yaml file) is not suitable. This can be seen in any fully
     * specified service urls as well as sections that show a base that other
     * urls are relative to.
     *
     * Generated from protobuf field <code>string service_root_url = 6;</code>
     * @return string
     */
    public function getServiceRootUrl()
    {
        return $this->service_root_url;
    }
    /**
     * Specifies the service root url if the default one (the service name
     * from the yaml file) is not suitable. This can be seen in any fully
     * specified service urls as well as sections that show a base that other
     * urls are relative to.
     *
     * Generated from protobuf field <code>string service_root_url = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setServiceRootUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->service_root_url = $var;
        return $this;
    }
    /**
     * Declares a single overview page. For example:
     * <pre><code>documentation:
     *   summary: ...
     *   overview: &#40;== include overview.md ==&#41;
     * </code></pre>
     * This is a shortcut for the following declaration (using pages style):
     * <pre><code>documentation:
     *   summary: ...
     *   pages:
     *   - name: Overview
     *     content: &#40;== include overview.md ==&#41;
     * </code></pre>
     * Note: you cannot specify both `overview` field and `pages` field.
     *
     * Generated from protobuf field <code>string overview = 2;</code>
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }
    /**
     * Declares a single overview page. For example:
     * <pre><code>documentation:
     *   summary: ...
     *   overview: &#40;== include overview.md ==&#41;
     * </code></pre>
     * This is a shortcut for the following declaration (using pages style):
     * <pre><code>documentation:
     *   summary: ...
     *   pages:
     *   - name: Overview
     *     content: &#40;== include overview.md ==&#41;
     * </code></pre>
     * Note: you cannot specify both `overview` field and `pages` field.
     *
     * Generated from protobuf field <code>string overview = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setOverview($var)
    {
        GPBUtil::checkString($var, True);
        $this->overview = $var;
        return $this;
    }
}
