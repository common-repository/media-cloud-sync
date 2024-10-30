<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/route53-recovery-control-config/2020-11-02/api-2.json
return ['metadata' => ['apiVersion' => '2020-11-02', 'endpointPrefix' => 'route53-recovery-control-config', 'signingName' => 'route53-recovery-control-config', 'serviceFullName' => 'AWS Route53 Recovery Control Config', 'serviceId' => 'Route53 Recovery Control Config', 'protocol' => 'rest-json', 'jsonVersion' => '1.1', 'uid' => 'route53-recovery-control-config-2020-11-02', 'signatureVersion' => 'v4'], 'operations' => ['CreateCluster' => ['name' => 'CreateCluster', 'http' => ['method' => 'POST', 'requestUri' => '/cluster', 'responseCode' => 200], 'input' => ['shape' => 'CreateClusterRequest'], 'output' => ['shape' => 'CreateClusterResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'ServiceQuotaExceededException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'CreateControlPanel' => ['name' => 'CreateControlPanel', 'http' => ['method' => 'POST', 'requestUri' => '/controlpanel', 'responseCode' => 200], 'input' => ['shape' => 'CreateControlPanelRequest'], 'output' => ['shape' => 'CreateControlPanelResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'ServiceQuotaExceededException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'CreateRoutingControl' => ['name' => 'CreateRoutingControl', 'http' => ['method' => 'POST', 'requestUri' => '/routingcontrol', 'responseCode' => 200], 'input' => ['shape' => 'CreateRoutingControlRequest'], 'output' => ['shape' => 'CreateRoutingControlResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'ServiceQuotaExceededException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'CreateSafetyRule' => ['name' => 'CreateSafetyRule', 'http' => ['method' => 'POST', 'requestUri' => '/safetyrule', 'responseCode' => 200], 'input' => ['shape' => 'CreateSafetyRuleRequest'], 'output' => ['shape' => 'CreateSafetyRuleResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException']]], 'DeleteCluster' => ['name' => 'DeleteCluster', 'http' => ['method' => 'DELETE', 'requestUri' => '/cluster/{ClusterArn}', 'responseCode' => 200], 'input' => ['shape' => 'DeleteClusterRequest'], 'output' => ['shape' => 'DeleteClusterResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'DeleteControlPanel' => ['name' => 'DeleteControlPanel', 'http' => ['method' => 'DELETE', 'requestUri' => '/controlpanel/{ControlPanelArn}', 'responseCode' => 200], 'input' => ['shape' => 'DeleteControlPanelRequest'], 'output' => ['shape' => 'DeleteControlPanelResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'DeleteRoutingControl' => ['name' => 'DeleteRoutingControl', 'http' => ['method' => 'DELETE', 'requestUri' => '/routingcontrol/{RoutingControlArn}', 'responseCode' => 200], 'input' => ['shape' => 'DeleteRoutingControlRequest'], 'output' => ['shape' => 'DeleteRoutingControlResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'DeleteSafetyRule' => ['name' => 'DeleteSafetyRule', 'http' => ['method' => 'DELETE', 'requestUri' => '/safetyrule/{SafetyRuleArn}', 'responseCode' => 200], 'input' => ['shape' => 'DeleteSafetyRuleRequest'], 'output' => ['shape' => 'DeleteSafetyRuleResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException']]], 'DescribeCluster' => ['name' => 'DescribeCluster', 'http' => ['method' => 'GET', 'requestUri' => '/cluster/{ClusterArn}', 'responseCode' => 200], 'input' => ['shape' => 'DescribeClusterRequest'], 'output' => ['shape' => 'DescribeClusterResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'DescribeControlPanel' => ['name' => 'DescribeControlPanel', 'http' => ['method' => 'GET', 'requestUri' => '/controlpanel/{ControlPanelArn}', 'responseCode' => 200], 'input' => ['shape' => 'DescribeControlPanelRequest'], 'output' => ['shape' => 'DescribeControlPanelResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'DescribeRoutingControl' => ['name' => 'DescribeRoutingControl', 'http' => ['method' => 'GET', 'requestUri' => '/routingcontrol/{RoutingControlArn}', 'responseCode' => 200], 'input' => ['shape' => 'DescribeRoutingControlRequest'], 'output' => ['shape' => 'DescribeRoutingControlResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'DescribeSafetyRule' => ['name' => 'DescribeSafetyRule', 'http' => ['method' => 'GET', 'requestUri' => '/safetyrule/{SafetyRuleArn}', 'responseCode' => 200], 'input' => ['shape' => 'DescribeSafetyRuleRequest'], 'output' => ['shape' => 'DescribeSafetyRuleResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'ResourceNotFoundException']]], 'ListAssociatedRoute53HealthChecks' => ['name' => 'ListAssociatedRoute53HealthChecks', 'http' => ['method' => 'GET', 'requestUri' => '/routingcontrol/{RoutingControlArn}/associatedRoute53HealthChecks', 'responseCode' => 200], 'input' => ['shape' => 'ListAssociatedRoute53HealthChecksRequest'], 'output' => ['shape' => 'ListAssociatedRoute53HealthChecksResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException']]], 'ListClusters' => ['name' => 'ListClusters', 'http' => ['method' => 'GET', 'requestUri' => '/cluster', 'responseCode' => 200], 'input' => ['shape' => 'ListClustersRequest'], 'output' => ['shape' => 'ListClustersResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException']]], 'ListControlPanels' => ['name' => 'ListControlPanels', 'http' => ['method' => 'GET', 'requestUri' => '/controlpanels', 'responseCode' => 200], 'input' => ['shape' => 'ListControlPanelsRequest'], 'output' => ['shape' => 'ListControlPanelsResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException']]], 'ListRoutingControls' => ['name' => 'ListRoutingControls', 'http' => ['method' => 'GET', 'requestUri' => '/controlpanel/{ControlPanelArn}/routingcontrols', 'responseCode' => 200], 'input' => ['shape' => 'ListRoutingControlsRequest'], 'output' => ['shape' => 'ListRoutingControlsResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException']]], 'ListSafetyRules' => ['name' => 'ListSafetyRules', 'http' => ['method' => 'GET', 'requestUri' => '/controlpanel/{ControlPanelArn}/safetyrules', 'responseCode' => 200], 'input' => ['shape' => 'ListSafetyRulesRequest'], 'output' => ['shape' => 'ListSafetyRulesResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException']]], 'ListTagsForResource' => ['name' => 'ListTagsForResource', 'http' => ['method' => 'GET', 'requestUri' => '/tags/{ResourceArn}', 'responseCode' => 200], 'input' => ['shape' => 'ListTagsForResourceRequest'], 'output' => ['shape' => 'ListTagsForResourceResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException']]], 'TagResource' => ['name' => 'TagResource', 'http' => ['method' => 'POST', 'requestUri' => '/tags/{ResourceArn}', 'responseCode' => 200], 'input' => ['shape' => 'TagResourceRequest'], 'output' => ['shape' => 'TagResourceResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException']]], 'UntagResource' => ['name' => 'UntagResource', 'http' => ['method' => 'DELETE', 'requestUri' => '/tags/{ResourceArn}', 'responseCode' => 200], 'input' => ['shape' => 'UntagResourceRequest'], 'output' => ['shape' => 'UntagResourceResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException']]], 'UpdateControlPanel' => ['name' => 'UpdateControlPanel', 'http' => ['method' => 'PUT', 'requestUri' => '/controlpanel', 'responseCode' => 200], 'input' => ['shape' => 'UpdateControlPanelRequest'], 'output' => ['shape' => 'UpdateControlPanelResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'UpdateRoutingControl' => ['name' => 'UpdateRoutingControl', 'http' => ['method' => 'PUT', 'requestUri' => '/routingcontrol', 'responseCode' => 200], 'input' => ['shape' => 'UpdateRoutingControlRequest'], 'output' => ['shape' => 'UpdateRoutingControlResponse'], 'errors' => [['shape' => 'ValidationException'], ['shape' => 'InternalServerException'], ['shape' => 'AccessDeniedException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ThrottlingException'], ['shape' => 'ConflictException']]], 'UpdateSafetyRule' => ['name' => 'UpdateSafetyRule', 'http' => ['method' => 'PUT', 'requestUri' => '/safetyrule', 'responseCode' => 200], 'input' => ['shape' => 'UpdateSafetyRuleRequest'], 'output' => ['shape' => 'UpdateSafetyRuleResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ValidationException'], ['shape' => 'InternalServerException']]]], 'shapes' => ['AccessDeniedException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => '__string', 'locationName' => 'message']], 'required' => ['Message'], 'exception' => \true, 'error' => ['httpStatusCode' => 403]], 'AssertionRule' => ['type' => 'structure', 'members' => ['AssertedControls' => ['shape' => '__listOf__stringMin1Max256PatternAZaZ09'], 'ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'Name' => ['shape' => '__stringMin1Max64PatternS'], 'RuleConfig' => ['shape' => 'RuleConfig'], 'SafetyRuleArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'Status' => ['shape' => 'Status'], 'WaitPeriodMs' => ['shape' => '__integer']], 'required' => ['Status', 'ControlPanelArn', 'SafetyRuleArn', 'AssertedControls', 'RuleConfig', 'WaitPeriodMs', 'Name']], 'AssertionRuleUpdate' => ['type' => 'structure', 'members' => ['Name' => ['shape' => '__stringMin1Max64PatternS'], 'SafetyRuleArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'WaitPeriodMs' => ['shape' => '__integer']], 'required' => ['SafetyRuleArn', 'WaitPeriodMs', 'Name']], 'Cluster' => ['type' => 'structure', 'members' => ['ClusterArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'ClusterEndpoints' => ['shape' => '__listOfClusterEndpoint'], 'Name' => ['shape' => '__stringMin1Max64PatternS'], 'Status' => ['shape' => 'Status']]], 'ClusterEndpoint' => ['type' => 'structure', 'members' => ['Endpoint' => ['shape' => '__stringMin1Max128PatternAZaZ09'], 'Region' => ['shape' => '__stringMin1Max32PatternS']]], 'ConflictException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => '__string', 'locationName' => 'message']], 'required' => ['Message'], 'exception' => \true, 'error' => ['httpStatusCode' => 409]], 'ControlPanel' => ['type' => 'structure', 'members' => ['ClusterArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'DefaultControlPanel' => ['shape' => '__boolean'], 'Name' => ['shape' => '__stringMin1Max64PatternS'], 'RoutingControlCount' => ['shape' => '__integer'], 'Status' => ['shape' => 'Status']]], 'CreateClusterRequest' => ['type' => 'structure', 'members' => ['ClientToken' => ['shape' => '__stringMin1Max64PatternS', 'idempotencyToken' => \true], 'ClusterName' => ['shape' => '__stringMin1Max64PatternS'], 'Tags' => ['shape' => '__mapOf__stringMin0Max256PatternS']], 'required' => ['ClusterName']], 'CreateClusterResponse' => ['type' => 'structure', 'members' => ['Cluster' => ['shape' => 'Cluster']]], 'CreateControlPanelRequest' => ['type' => 'structure', 'members' => ['ClientToken' => ['shape' => '__stringMin1Max64PatternS', 'idempotencyToken' => \true], 'ClusterArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'ControlPanelName' => ['shape' => '__stringMin1Max64PatternS'], 'Tags' => ['shape' => '__mapOf__stringMin0Max256PatternS']], 'required' => ['ClusterArn', 'ControlPanelName']], 'CreateControlPanelResponse' => ['type' => 'structure', 'members' => ['ControlPanel' => ['shape' => 'ControlPanel']]], 'CreateRoutingControlRequest' => ['type' => 'structure', 'members' => ['ClientToken' => ['shape' => '__stringMin1Max64PatternS', 'idempotencyToken' => \true], 'ClusterArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'RoutingControlName' => ['shape' => '__stringMin1Max64PatternS']], 'required' => ['ClusterArn', 'RoutingControlName']], 'CreateRoutingControlResponse' => ['type' => 'structure', 'members' => ['RoutingControl' => ['shape' => 'RoutingControl']]], 'CreateSafetyRuleRequest' => ['type' => 'structure', 'members' => ['AssertionRule' => ['shape' => 'NewAssertionRule'], 'ClientToken' => ['shape' => '__stringMin1Max64PatternS', 'idempotencyToken' => \true], 'GatingRule' => ['shape' => 'NewGatingRule'], 'Tags' => ['shape' => '__mapOf__stringMin0Max256PatternS']]], 'CreateSafetyRuleResponse' => ['type' => 'structure', 'members' => ['AssertionRule' => ['shape' => 'AssertionRule'], 'GatingRule' => ['shape' => 'GatingRule']]], 'DeleteClusterRequest' => ['type' => 'structure', 'members' => ['ClusterArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ClusterArn']], 'required' => ['ClusterArn']], 'DeleteClusterResponse' => ['type' => 'structure', 'members' => []], 'DeleteControlPanelRequest' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ControlPanelArn']], 'required' => ['ControlPanelArn']], 'DeleteControlPanelResponse' => ['type' => 'structure', 'members' => []], 'DeleteRoutingControlRequest' => ['type' => 'structure', 'members' => ['RoutingControlArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'RoutingControlArn']], 'required' => ['RoutingControlArn']], 'DeleteRoutingControlResponse' => ['type' => 'structure', 'members' => []], 'DeleteSafetyRuleRequest' => ['type' => 'structure', 'members' => ['SafetyRuleArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'SafetyRuleArn']], 'required' => ['SafetyRuleArn']], 'DeleteSafetyRuleResponse' => ['type' => 'structure', 'members' => []], 'DescribeClusterRequest' => ['type' => 'structure', 'members' => ['ClusterArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ClusterArn']], 'required' => ['ClusterArn']], 'DescribeClusterResponse' => ['type' => 'structure', 'members' => ['Cluster' => ['shape' => 'Cluster']]], 'DescribeControlPanelRequest' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ControlPanelArn']], 'required' => ['ControlPanelArn']], 'DescribeControlPanelResponse' => ['type' => 'structure', 'members' => ['ControlPanel' => ['shape' => 'ControlPanel']]], 'DescribeRoutingControlRequest' => ['type' => 'structure', 'members' => ['RoutingControlArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'RoutingControlArn']], 'required' => ['RoutingControlArn']], 'DescribeRoutingControlResponse' => ['type' => 'structure', 'members' => ['RoutingControl' => ['shape' => 'RoutingControl']]], 'DescribeSafetyRuleRequest' => ['type' => 'structure', 'members' => ['SafetyRuleArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'SafetyRuleArn']], 'required' => ['SafetyRuleArn']], 'DescribeSafetyRuleResponse' => ['type' => 'structure', 'members' => ['AssertionRule' => ['shape' => 'AssertionRule'], 'GatingRule' => ['shape' => 'GatingRule']]], 'GatingRule' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'GatingControls' => ['shape' => '__listOf__stringMin1Max256PatternAZaZ09'], 'Name' => ['shape' => '__stringMin1Max64PatternS'], 'RuleConfig' => ['shape' => 'RuleConfig'], 'SafetyRuleArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'Status' => ['shape' => 'Status'], 'TargetControls' => ['shape' => '__listOf__stringMin1Max256PatternAZaZ09'], 'WaitPeriodMs' => ['shape' => '__integer']], 'required' => ['Status', 'TargetControls', 'ControlPanelArn', 'SafetyRuleArn', 'GatingControls', 'RuleConfig', 'WaitPeriodMs', 'Name']], 'GatingRuleUpdate' => ['type' => 'structure', 'members' => ['Name' => ['shape' => '__stringMin1Max64PatternS'], 'SafetyRuleArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'WaitPeriodMs' => ['shape' => '__integer']], 'required' => ['SafetyRuleArn', 'WaitPeriodMs', 'Name']], 'InternalServerException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => '__string', 'locationName' => 'message']], 'required' => ['Message'], 'exception' => \true, 'error' => ['httpStatusCode' => 500]], 'ListAssociatedRoute53HealthChecksRequest' => ['type' => 'structure', 'members' => ['MaxResults' => ['shape' => 'MaxResults', 'location' => 'querystring', 'locationName' => 'MaxResults'], 'NextToken' => ['shape' => '__string', 'location' => 'querystring', 'locationName' => 'NextToken'], 'RoutingControlArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'RoutingControlArn']], 'required' => ['RoutingControlArn']], 'ListAssociatedRoute53HealthChecksResponse' => ['type' => 'structure', 'members' => ['HealthCheckIds' => ['shape' => '__listOf__stringMax36PatternS'], 'NextToken' => ['shape' => '__stringMin1Max8096PatternS']]], 'ListClustersRequest' => ['type' => 'structure', 'members' => ['MaxResults' => ['shape' => 'MaxResults', 'location' => 'querystring', 'locationName' => 'MaxResults'], 'NextToken' => ['shape' => '__string', 'location' => 'querystring', 'locationName' => 'NextToken']]], 'ListClustersResponse' => ['type' => 'structure', 'members' => ['Clusters' => ['shape' => '__listOfCluster'], 'NextToken' => ['shape' => '__stringMin1Max8096PatternS']]], 'ListControlPanelsRequest' => ['type' => 'structure', 'members' => ['ClusterArn' => ['shape' => '__string', 'location' => 'querystring', 'locationName' => 'ClusterArn'], 'MaxResults' => ['shape' => 'MaxResults', 'location' => 'querystring', 'locationName' => 'MaxResults'], 'NextToken' => ['shape' => '__string', 'location' => 'querystring', 'locationName' => 'NextToken']]], 'ListControlPanelsResponse' => ['type' => 'structure', 'members' => ['ControlPanels' => ['shape' => '__listOfControlPanel'], 'NextToken' => ['shape' => '__stringMin1Max8096PatternS']]], 'ListRoutingControlsRequest' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ControlPanelArn'], 'MaxResults' => ['shape' => 'MaxResults', 'location' => 'querystring', 'locationName' => 'MaxResults'], 'NextToken' => ['shape' => '__string', 'location' => 'querystring', 'locationName' => 'NextToken']], 'required' => ['ControlPanelArn']], 'ListRoutingControlsResponse' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => '__stringMin1Max8096PatternS'], 'RoutingControls' => ['shape' => '__listOfRoutingControl']]], 'ListSafetyRulesRequest' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ControlPanelArn'], 'MaxResults' => ['shape' => 'MaxResults', 'location' => 'querystring', 'locationName' => 'MaxResults'], 'NextToken' => ['shape' => '__string', 'location' => 'querystring', 'locationName' => 'NextToken']], 'required' => ['ControlPanelArn']], 'ListSafetyRulesResponse' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => '__stringMin1Max8096PatternS'], 'SafetyRules' => ['shape' => '__listOfRule']]], 'ListTagsForResourceRequest' => ['type' => 'structure', 'members' => ['ResourceArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ResourceArn']], 'required' => ['ResourceArn']], 'ListTagsForResourceResponse' => ['type' => 'structure', 'members' => ['Tags' => ['shape' => '__mapOf__stringMin0Max256PatternS']]], 'MaxResults' => ['type' => 'integer', 'min' => 1, 'max' => 1000], 'NewAssertionRule' => ['type' => 'structure', 'members' => ['AssertedControls' => ['shape' => '__listOf__stringMin1Max256PatternAZaZ09'], 'ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'Name' => ['shape' => '__stringMin1Max64PatternS'], 'RuleConfig' => ['shape' => 'RuleConfig'], 'WaitPeriodMs' => ['shape' => '__integer']], 'required' => ['ControlPanelArn', 'AssertedControls', 'RuleConfig', 'WaitPeriodMs', 'Name']], 'NewGatingRule' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'GatingControls' => ['shape' => '__listOf__stringMin1Max256PatternAZaZ09'], 'Name' => ['shape' => '__stringMin1Max64PatternS'], 'RuleConfig' => ['shape' => 'RuleConfig'], 'TargetControls' => ['shape' => '__listOf__stringMin1Max256PatternAZaZ09'], 'WaitPeriodMs' => ['shape' => '__integer']], 'required' => ['TargetControls', 'ControlPanelArn', 'GatingControls', 'RuleConfig', 'WaitPeriodMs', 'Name']], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => '__string', 'locationName' => 'message']], 'required' => ['Message'], 'exception' => \true, 'error' => ['httpStatusCode' => 404]], 'RoutingControl' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'Name' => ['shape' => '__stringMin1Max64PatternS'], 'RoutingControlArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'Status' => ['shape' => 'Status']]], 'Rule' => ['type' => 'structure', 'members' => ['ASSERTION' => ['shape' => 'AssertionRule'], 'GATING' => ['shape' => 'GatingRule']]], 'RuleConfig' => ['type' => 'structure', 'members' => ['Inverted' => ['shape' => '__boolean'], 'Threshold' => ['shape' => '__integer'], 'Type' => ['shape' => 'RuleType']], 'required' => ['Type', 'Inverted', 'Threshold']], 'RuleType' => ['type' => 'string', 'enum' => ['ATLEAST', 'AND', 'OR']], 'ServiceQuotaExceededException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => '__string', 'locationName' => 'message']], 'required' => ['Message'], 'exception' => \true, 'error' => ['httpStatusCode' => 402]], 'Status' => ['type' => 'string', 'enum' => ['PENDING', 'DEPLOYED', 'PENDING_DELETION']], 'TagResourceRequest' => ['type' => 'structure', 'members' => ['ResourceArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ResourceArn'], 'Tags' => ['shape' => '__mapOf__stringMin0Max256PatternS']], 'required' => ['ResourceArn', 'Tags']], 'TagResourceResponse' => ['type' => 'structure', 'members' => []], 'ThrottlingException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => '__string', 'locationName' => 'message']], 'required' => ['Message'], 'exception' => \true, 'error' => ['httpStatusCode' => 429]], 'UntagResourceRequest' => ['type' => 'structure', 'members' => ['ResourceArn' => ['shape' => '__string', 'location' => 'uri', 'locationName' => 'ResourceArn'], 'TagKeys' => ['shape' => '__listOf__string', 'location' => 'querystring', 'locationName' => 'TagKeys']], 'required' => ['ResourceArn', 'TagKeys']], 'UntagResourceResponse' => ['type' => 'structure', 'members' => []], 'UpdateControlPanelRequest' => ['type' => 'structure', 'members' => ['ControlPanelArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'ControlPanelName' => ['shape' => '__stringMin1Max64PatternS']], 'required' => ['ControlPanelArn', 'ControlPanelName']], 'UpdateControlPanelResponse' => ['type' => 'structure', 'members' => ['ControlPanel' => ['shape' => 'ControlPanel']]], 'UpdateRoutingControlRequest' => ['type' => 'structure', 'members' => ['RoutingControlArn' => ['shape' => '__stringMin1Max256PatternAZaZ09'], 'RoutingControlName' => ['shape' => '__stringMin1Max64PatternS']], 'required' => ['RoutingControlName', 'RoutingControlArn']], 'UpdateRoutingControlResponse' => ['type' => 'structure', 'members' => ['RoutingControl' => ['shape' => 'RoutingControl']]], 'UpdateSafetyRuleRequest' => ['type' => 'structure', 'members' => ['AssertionRuleUpdate' => ['shape' => 'AssertionRuleUpdate'], 'GatingRuleUpdate' => ['shape' => 'GatingRuleUpdate']]], 'UpdateSafetyRuleResponse' => ['type' => 'structure', 'members' => ['AssertionRule' => ['shape' => 'AssertionRule'], 'GatingRule' => ['shape' => 'GatingRule']]], 'ValidationException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => '__string', 'locationName' => 'message']], 'required' => ['Message'], 'exception' => \true, 'error' => ['httpStatusCode' => 400]], '__boolean' => ['type' => 'boolean'], '__double' => ['type' => 'double'], '__integer' => ['type' => 'integer'], '__listOfCluster' => ['type' => 'list', 'member' => ['shape' => 'Cluster']], '__listOfClusterEndpoint' => ['type' => 'list', 'member' => ['shape' => 'ClusterEndpoint']], '__listOfControlPanel' => ['type' => 'list', 'member' => ['shape' => 'ControlPanel']], '__listOfRoutingControl' => ['type' => 'list', 'member' => ['shape' => 'RoutingControl']], '__listOfRule' => ['type' => 'list', 'member' => ['shape' => 'Rule']], '__listOf__string' => ['type' => 'list', 'member' => ['shape' => '__string']], '__listOf__stringMax36PatternS' => ['type' => 'list', 'member' => ['shape' => '__stringMax36PatternS']], '__listOf__stringMin1Max256PatternAZaZ09' => ['type' => 'list', 'member' => ['shape' => '__stringMin1Max256PatternAZaZ09']], '__long' => ['type' => 'long'], '__mapOf__stringMin0Max256PatternS' => ['type' => 'map', 'key' => ['shape' => '__string'], 'value' => ['shape' => '__stringMin0Max256PatternS']], '__string' => ['type' => 'string'], '__stringMax36PatternS' => ['type' => 'string', 'max' => 36, 'pattern' => '^\\S+$'], '__stringMin0Max256PatternS' => ['type' => 'string', 'min' => 0, 'max' => 256, 'pattern' => '^\\S+$'], '__stringMin1Max128PatternAZaZ09' => ['type' => 'string', 'min' => 1, 'max' => 128, 'pattern' => '^[A-Za-z0-9:.\\/_-]*$'], '__stringMin1Max256PatternAZaZ09' => ['type' => 'string', 'min' => 1, 'max' => 256, 'pattern' => '^[A-Za-z0-9:\\/_-]*$'], '__stringMin1Max32PatternS' => ['type' => 'string', 'min' => 1, 'max' => 32, 'pattern' => '^\\S+$'], '__stringMin1Max64PatternS' => ['type' => 'string', 'min' => 1, 'max' => 64, 'pattern' => '^\\S+$'], '__stringMin1Max8096PatternS' => ['type' => 'string', 'min' => 1, 'max' => 8096, 'pattern' => '[\\S]*'], '__timestampIso8601' => ['type' => 'timestamp', 'timestampFormat' => 'iso8601'], '__timestampUnix' => ['type' => 'timestamp', 'timestampFormat' => 'unixTimestamp']]];
