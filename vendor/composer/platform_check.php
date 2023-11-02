<?php

// platform_check.php @generated by Composer

$issues = array();

<<<<<<< HEAD
if (!(PHP_VERSION_ID >= 80000)) {
    $issues[] = 'Your Composer dependencies require a PHP version ">= 8.0.0". You are running ' . PHP_VERSION . '.';
=======
if (!(PHP_VERSION_ID >= 80100)) {
    $issues[] = 'Your Composer dependencies require a PHP version ">= 8.1.0". You are running ' . PHP_VERSION . '.';
}

if (PHP_INT_SIZE !== 8) {
    $issues[] = 'Your Composer dependencies require a 64-bit build of PHP.';
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070
}

if ($issues) {
    if (!headers_sent()) {
        header('HTTP/1.1 500 Internal Server Error');
    }
    if (!ini_get('display_errors')) {
        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            fwrite(STDERR, 'Composer detected issues in your platform:' . PHP_EOL.PHP_EOL . implode(PHP_EOL, $issues) . PHP_EOL.PHP_EOL);
        } elseif (!headers_sent()) {
            echo 'Composer detected issues in your platform:' . PHP_EOL.PHP_EOL . str_replace('You are running '.PHP_VERSION.'.', '', implode(PHP_EOL, $issues)) . PHP_EOL.PHP_EOL;
        }
    }
    trigger_error(
        'Composer detected issues in your platform: ' . implode(' ', $issues),
        E_USER_ERROR
    );
}
