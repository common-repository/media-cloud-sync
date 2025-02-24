<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/dynamodb/2012-08-10/paginators-1.json
return ['pagination' => ['BatchGetItem' => ['input_token' => 'RequestItems', 'output_token' => 'UnprocessedKeys'], 'ListContributorInsights' => ['input_token' => 'NextToken', 'limit_key' => 'MaxResults', 'output_token' => 'NextToken'], 'ListExports' => ['input_token' => 'NextToken', 'limit_key' => 'MaxResults', 'output_token' => 'NextToken'], 'ListImports' => ['input_token' => 'NextToken', 'limit_key' => 'PageSize', 'output_token' => 'NextToken'], 'ListTables' => ['input_token' => 'ExclusiveStartTableName', 'limit_key' => 'Limit', 'output_token' => 'LastEvaluatedTableName', 'result_key' => 'TableNames'], 'Query' => ['input_token' => 'ExclusiveStartKey', 'limit_key' => 'Limit', 'output_token' => 'LastEvaluatedKey', 'result_key' => 'Items'], 'Scan' => ['input_token' => 'ExclusiveStartKey', 'limit_key' => 'Limit', 'output_token' => 'LastEvaluatedKey', 'result_key' => 'Items']]];
