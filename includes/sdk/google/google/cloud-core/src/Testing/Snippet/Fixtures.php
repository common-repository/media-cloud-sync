<?php

/**
 * Copyright 2018 Google Inc.
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
namespace Dudlewebs\WPMCS\Google\Cloud\Core\Testing\Snippet;

/**
 * Class containing static functions to provide path to shared test fixtures
 *
 * @experimental
 * @internal
 */
class Fixtures
{
    /**
     * @return string Path the keyfile-stub.json fixture
     */
    public static function KEYFILE_STUB_FIXTURE()
    {
        return __DIR__ . '/keyfile-stub.json';
    }
}
