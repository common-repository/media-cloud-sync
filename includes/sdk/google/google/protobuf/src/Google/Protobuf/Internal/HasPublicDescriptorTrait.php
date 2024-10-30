<?php

// Protocol Buffers - Google's data interchange format
// Copyright 2008 Google Inc.  All rights reserved.
//
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file or at
// https://developers.google.com/open-source/licenses/bsd
namespace Dudlewebs\WPMCS\Google\Protobuf\Internal;

trait HasPublicDescriptorTrait
{
    private $public_desc;
    public function getPublicDescriptor()
    {
        return $this->public_desc;
    }
}
