<?php

declare(strict_types=1);

namespace ZipStream\Exception;

use ZipStream\Exception;

/**
<<<<<<< HEAD
 * This Exception gets invoked if `fread` fails on a stream.
=======
 * This Exception gets invoked if a stream can't be read.
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070
 */
class StreamNotReadableException extends Exception
{
    /**
<<<<<<< HEAD
     * Constructor of the Exception
     *
     * @param string $fileName - The name of the file which the stream belongs to.
     */
    public function __construct(string $fileName)
    {
        parent::__construct("The stream for $fileName could not be read.");
=======
     * @internal
     */
    public function __construct()
    {
        parent::__construct('The stream could not be read.');
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070
    }
}
