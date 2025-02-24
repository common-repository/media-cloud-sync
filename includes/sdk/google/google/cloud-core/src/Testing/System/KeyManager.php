<?php

/**
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Dudlewebs\WPMCS\Google\Cloud\Core\Testing\System;

use Dudlewebs\WPMCS\Google\Cloud\Core\Exception\ConflictException;
use Dudlewebs\WPMCS\Google\Cloud\Core\RequestWrapper;
use Dudlewebs\WPMCS\GuzzleHttp\Psr7\Request;
/**
 * Manage KMS keys used for system tests.
 */
class KeyManager
{
    const DEFAULT_LOCATION = 'us-west1';
    private $keyFile;
    private $serviceAccountEmail;
    private $projectId;
    private $requestWrapper;
    private $location;
    public function __construct(array $keyFile, $serviceAccountEmail = null, $projectId = null, $location = null)
    {
        $this->keyFile = $keyFile;
        $this->serviceAccountEmail = $serviceAccountEmail ?: $keyFile['client_email'];
        $this->projectId = $projectId ?: $keyFile['project_id'];
        $this->setLocation($location ?: self::DEFAULT_LOCATION);
        $this->requestWrapper = new RequestWrapper(['keyFile' => $this->keyFile, 'scopes' => ['https://www.googleapis.com/auth/cloud-platform']]);
    }
    /**
     * Set the service account email used for IAM management.
     *
     * @param string $serviceAccountEmail
     */
    public function setServiceAccountEmail($serviceAccountEmail)
    {
        $this->serviceAccountEmail = $serviceAccountEmail;
    }
    /**
     * Set keyring location.
     *
     * Location name may be in upper or lower case.
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = strtolower($location);
    }
    /**
     * Get the project data.
     *
     * @param string $projectId [optional] If not provided, uses ID given in
     *        constructor or keyfile.
     * @return array
     */
    public function getProject($projectId = null)
    {
        $projectId = $projectId ?: $this->projectId;
        $uri = 'https://cloudresourcemanager.googleapis.com/v1/projects/%s';
        $res = $this->requestWrapper->send(new Request('GET', sprintf($uri, $projectId)));
        return json_decode($res->getBody(), \true);
    }
    /**
     * A helper to get KMS keys and set correct permissions.
     *
     * @param string $keyRingId
     * @param string[] $keyIds
     * @return array
     */
    public function getKeyNames($keyRingId, array $keyIds)
    {
        $keyNames = [];
        $this->buildKeyRing($keyRingId);
        foreach ($keyIds as $keyId) {
            $keyNames[] = $this->getCryptoKeyName($keyRingId, $keyId);
        }
        return $keyNames;
    }
    /**
     * @param string $keyRingId
     */
    private function buildKeyRing($keyRingId)
    {
        try {
            $this->requestWrapper->send(new Request('POST', sprintf('https://cloudkms.googleapis.com/v1/projects/%s/locations/%s/keyRings?keyRingId=%s', $this->projectId, $this->location, $keyRingId)));
        } catch (ConflictException $ex) {
            // If it already exists, great!
        }
    }
    /**
     * @param string $keyRingId
     * @param string $cryptoKeyId
     * @return string
     */
    private function getCryptoKeyName($keyRingId, $cryptoKeyId)
    {
        $name = null;
        try {
            $uri = 'https://cloudkms.googleapis.com/v1/projects/%s/locations/%s/keyRings/%s/cryptoKeys?cryptoKeyId=%s';
            $response = $this->requestWrapper->send(new Request('POST', sprintf($uri, $this->projectId, $this->location, $keyRingId, $cryptoKeyId), [], json_encode(['purpose' => 'ENCRYPT_DECRYPT'])));
            $name = json_decode((string) $response->getBody(), \true)['name'];
        } catch (ConflictException $ex) {
            $name = sprintf('projects/%s/locations/%s/keyRings/%s/cryptoKeys/%s', $this->projectId, $this->location, $keyRingId, $cryptoKeyId);
        }
        $policy = ['policy' => ['bindings' => [['role' => 'roles/cloudkms.cryptoKeyEncrypterDecrypter', 'members' => ["serviceAccount:" . $this->serviceAccountEmail]]]]];
        $uri = 'https://cloudkms.googleapis.com/v1/projects/%s/locations/' . '%s/keyRings/%s/cryptoKeys/%s:setIamPolicy';
        $this->requestWrapper->send(new Request('POST', sprintf($uri, $this->projectId, $this->location, $keyRingId, $cryptoKeyId), [], json_encode($policy)));
        return $name;
    }
}
