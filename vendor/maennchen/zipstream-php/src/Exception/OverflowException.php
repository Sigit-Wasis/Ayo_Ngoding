<?php

declare(strict_types=1);

namespace ZipStream\Exception;

use ZipStream\Exception;

/**
 * This Exception gets invoked if a counter value exceeds storage size
 */
class OverflowException extends Exception
{
<<<<<<< HEAD
=======
    /**
     * @internal
     */
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070
    public function __construct()
    {
        parent::__construct('File size exceeds limit of 32 bit integer. Please enable "zip64" option.');
    }
}
