<?php

declare(strict_types=1);

namespace ZipStream\Exception;

use ZipStream\Exception;

/**
 * This Exception gets invoked if a file wasn't found
 */
class FileNotReadableException extends Exception
{
    /**
<<<<<<< HEAD
     * Constructor of the Exception
     *
     * @param String $path - The path which wasn't found
     */
    public function __construct(string $path)
    {
=======
     * @internal
     */
    public function __construct(
        public readonly string $path
    ) {
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070
        parent::__construct("The file with the path $path isn't readable.");
    }
}
