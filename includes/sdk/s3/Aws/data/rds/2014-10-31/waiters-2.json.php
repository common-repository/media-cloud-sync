<?php

namespace Dudlewebs\WPMCS\s3;

// This file was auto-generated from sdk-root/src/data/rds/2014-10-31/waiters-2.json
return ['version' => 2, 'waiters' => ['DBInstanceAvailable' => ['delay' => 30, 'operation' => 'DescribeDBInstances', 'maxAttempts' => 60, 'acceptors' => [['expected' => 'available', 'matcher' => 'pathAll', 'state' => 'success', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'deleted', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'deleting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'failed', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'incompatible-restore', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'incompatible-parameters', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus']]], 'DBInstanceDeleted' => ['delay' => 30, 'operation' => 'DescribeDBInstances', 'maxAttempts' => 60, 'acceptors' => [['expected' => \true, 'matcher' => 'path', 'state' => 'success', 'argument' => 'length(DBInstances) == `0`'], ['expected' => 'DBInstanceNotFound', 'matcher' => 'error', 'state' => 'success'], ['expected' => 'creating', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'modifying', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'rebooting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus'], ['expected' => 'resetting-master-credentials', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBInstances[].DBInstanceStatus']]], 'DBSnapshotAvailable' => ['delay' => 30, 'operation' => 'DescribeDBSnapshots', 'maxAttempts' => 60, 'acceptors' => [['expected' => 'available', 'matcher' => 'pathAll', 'state' => 'success', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'deleted', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'deleting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'failed', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'incompatible-restore', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'incompatible-parameters', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status']]], 'DBSnapshotDeleted' => ['delay' => 30, 'operation' => 'DescribeDBSnapshots', 'maxAttempts' => 60, 'acceptors' => [['expected' => \true, 'matcher' => 'path', 'state' => 'success', 'argument' => 'length(DBSnapshots) == `0`'], ['expected' => 'DBSnapshotNotFound', 'matcher' => 'error', 'state' => 'success'], ['expected' => 'creating', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'modifying', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'rebooting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status'], ['expected' => 'resetting-master-credentials', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBSnapshots[].Status']]], 'DBClusterSnapshotAvailable' => ['delay' => 30, 'operation' => 'DescribeDBClusterSnapshots', 'maxAttempts' => 60, 'acceptors' => [['expected' => 'available', 'matcher' => 'pathAll', 'state' => 'success', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'deleted', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'deleting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'failed', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'incompatible-restore', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'incompatible-parameters', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status']]], 'DBClusterSnapshotDeleted' => ['delay' => 30, 'operation' => 'DescribeDBClusterSnapshots', 'maxAttempts' => 60, 'acceptors' => [['expected' => \true, 'matcher' => 'path', 'state' => 'success', 'argument' => 'length(DBClusterSnapshots) == `0`'], ['expected' => 'DBClusterSnapshotNotFoundFault', 'matcher' => 'error', 'state' => 'success'], ['expected' => 'creating', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'modifying', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'rebooting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status'], ['expected' => 'resetting-master-credentials', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusterSnapshots[].Status']]], 'DBClusterAvailable' => ['delay' => 30, 'operation' => 'DescribeDBClusters', 'maxAttempts' => 60, 'acceptors' => [['expected' => 'available', 'matcher' => 'pathAll', 'state' => 'success', 'argument' => 'DBClusters[].Status'], ['expected' => 'deleted', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status'], ['expected' => 'deleting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status'], ['expected' => 'failed', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status'], ['expected' => 'incompatible-restore', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status'], ['expected' => 'incompatible-parameters', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status']]], 'DBClusterDeleted' => ['delay' => 30, 'operation' => 'DescribeDBClusters', 'maxAttempts' => 60, 'acceptors' => [['expected' => \true, 'matcher' => 'path', 'state' => 'success', 'argument' => 'length(DBClusters) == `0`'], ['expected' => 'DBClusterNotFoundFault', 'matcher' => 'error', 'state' => 'success'], ['expected' => 'creating', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status'], ['expected' => 'modifying', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status'], ['expected' => 'rebooting', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status'], ['expected' => 'resetting-master-credentials', 'matcher' => 'pathAny', 'state' => 'failure', 'argument' => 'DBClusters[].Status']]]]];
