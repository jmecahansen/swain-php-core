<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers;
    use Throwable;

    /**
     * files
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Files {
        // default download rate (in kilobytes per second)
        const RATE_DEFAULT = 100;

        // default stream buffer size (in kilobytes)
        const SIZE_DEFAULT = 100;

        /**
         * returns a binary stream for a given source (a file, a socket or a stream)
         * @param string $source the source for the binary stream
         * @return object the binary stream for the given source (a file, a socket or a stream)
         * @example $stream = Files::getBinaryStream("/foo/bar.mp3");
         * @example $stream = Files::getBinaryStream($socket);
         * @example $stream = Files::getBinaryStream($stream);
         * @throws Throwable
         * @composer "wapmorgan/binary-stream": "0.4.0"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getBinaryStream(string $source): object;

        /**
         * returns the MIME type for a file
         * @param string $path the file path
         * @return false|string the MIME type if successful, false otherwise
         * @example $type = Files::getMIMEType("/foo/bar.mp4");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getMIMEType(string $path): false|string;

        /**
         * returns a properly formatted string with the size of a given file
         * @param int $size the file size (in bytes)
         * @return false|string a string if successful, false otherwise
         * @example $size = Files::getSize(1048576);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getSize(int $size): false|string;

        /**
         * sends a source file at a given rate with, optionally, a specific file name
         * @param string $source the source file we want to send
         * @param int $rate the download rate (in KB/s) (optional)
         * @param null|string $name the file name (optional)
         * @return bool whether the file was successfully sent or not
         * @example $result = Files::send("/assets/storage/sample.png");
         * @example $result = Files::send("/assets/storage/sample.png", 100);
         * @example $result = Files::send("/assets/storage/sample.png", 100, "report.png");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function send(string $source, int $rate = self::RATE_DEFAULT, string $name = null): bool;

        /**
         * streams a given file
         * @param string $source the file source
         * @param int $buffer the buffer size (in kilobytes) (optional)
         * @example Files::stream("/path/foo.zip");
         * @example Files::stream("/path/foo.zip", 100);
         * @throws Throwable
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function stream(string $source, int $buffer = self::SIZE_DEFAULT): void;
    }