<?php

namespace Dudlewebs\WPMCS\s3;

// Don't redefine the functions if included multiple times.
if (!\function_exists('Dudlewebs\\WPMCS\\s3\\GuzzleHttp\\Promise\\promise_for')) {
    require __DIR__ . '/functions.php';
}
