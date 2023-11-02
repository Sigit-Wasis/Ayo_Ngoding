<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070
namespace Psr\Http\Message;

/**
 * Describes a data stream.
 *
 * Typically, an instance will wrap a PHP stream; this interface provides
 * a wrapper around the most common operations, including serialization of
 * the entire stream to a string.
 */
interface StreamInterface
{
    /**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * This method MUST attempt to seek to the beginning of the stream before
     * reading data and read the stream until the end is reached.
     *
     * Warning: This could attempt to load a large amount of data into memory.
     *
     * This method MUST NOT raise an exception in order to conform with PHP's
     * string casting operations.
     *
     * @see http://php.net/manual/en/language.oop5.magic.php#object.tostring
     * @return string
     */
<<<<<<< HEAD
    public function __toString();
=======
    public function __toString(): string;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
<<<<<<< HEAD
    public function close();
=======
    public function close(): void;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Separates any underlying resources from the stream.
     *
     * After the stream has been detached, the stream is in an unusable state.
     *
     * @return resource|null Underlying PHP stream, if any
     */
    public function detach();

    /**
     * Get the size of the stream if known.
     *
     * @return int|null Returns the size in bytes if known, or null if unknown.
     */
<<<<<<< HEAD
    public function getSize();
=======
    public function getSize(): ?int;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Returns the current position of the file read/write pointer
     *
     * @return int Position of the file pointer
     * @throws \RuntimeException on error.
     */
<<<<<<< HEAD
    public function tell();
=======
    public function tell(): int;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Returns true if the stream is at the end of the stream.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function eof();
=======
    public function eof(): bool;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Returns whether or not the stream is seekable.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function isSeekable();
=======
    public function isSeekable(): bool;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Seek to a position in the stream.
     *
     * @link http://www.php.net/manual/en/function.fseek.php
     * @param int $offset Stream offset
     * @param int $whence Specifies how the cursor position will be calculated
     *     based on the seek offset. Valid values are identical to the built-in
     *     PHP $whence values for `fseek()`.  SEEK_SET: Set position equal to
     *     offset bytes SEEK_CUR: Set position to current location plus offset
     *     SEEK_END: Set position to end-of-stream plus offset.
     * @throws \RuntimeException on failure.
     */
<<<<<<< HEAD
    public function seek(int $offset, int $whence = SEEK_SET);
=======
    public function seek(int $offset, int $whence = SEEK_SET): void;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Seek to the beginning of the stream.
     *
     * If the stream is not seekable, this method will raise an exception;
     * otherwise, it will perform a seek(0).
     *
     * @see seek()
     * @link http://www.php.net/manual/en/function.fseek.php
     * @throws \RuntimeException on failure.
     */
<<<<<<< HEAD
    public function rewind();
=======
    public function rewind(): void;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Returns whether or not the stream is writable.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function isWritable();
=======
    public function isWritable(): bool;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Write data to the stream.
     *
     * @param string $string The string that is to be written.
     * @return int Returns the number of bytes written to the stream.
     * @throws \RuntimeException on failure.
     */
<<<<<<< HEAD
    public function write(string $string);
=======
    public function write(string $string): int;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Returns whether or not the stream is readable.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function isReadable();
=======
    public function isReadable(): bool;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Read data from the stream.
     *
     * @param int $length Read up to $length bytes from the object and return
     *     them. Fewer than $length bytes may be returned if underlying stream
     *     call returns fewer bytes.
     * @return string Returns the data read from the stream, or an empty string
     *     if no bytes are available.
     * @throws \RuntimeException if an error occurs.
     */
<<<<<<< HEAD
    public function read(int $length);
=======
    public function read(int $length): string;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Returns the remaining contents in a string
     *
     * @return string
     * @throws \RuntimeException if unable to read or an error occurs while
     *     reading.
     */
<<<<<<< HEAD
    public function getContents();
=======
    public function getContents(): string;
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070

    /**
     * Get stream metadata as an associative array or retrieve a specific key.
     *
     * The keys returned are identical to the keys returned from PHP's
     * stream_get_meta_data() function.
     *
     * @link http://php.net/manual/en/function.stream-get-meta-data.php
     * @param string|null $key Specific metadata to retrieve.
     * @return array|mixed|null Returns an associative array if no key is
     *     provided. Returns a specific key value if a key is provided and the
     *     value is found, or null if the key is not found.
     */
    public function getMetadata(?string $key = null);
}
