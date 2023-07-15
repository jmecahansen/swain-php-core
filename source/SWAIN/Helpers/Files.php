<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers;
    use Throwable;
    use wapmorgan\BinaryStream\BinaryStream;

    /**
     * files
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Files implements \SWAIN\Interfaces\Helpers\Files {
        // excluded directories
        const DIRECTORIES_EXCLUDED = [
            ".",
            "..",
            ".idea",
            ".vscode",
            "nbproject",
        ];

        // line ending
        const ENDING_DOS = "\r\n";
        const ENDING_MAC = "\r";
        const ENDING_UNIX = "\n";

        // excluded files
        const FILES_EXCLUDED = [
            "desktop.ini",
            ".DS_Store",
            ".gitconfig",
            ".gitignore",
        ];

        // file size
        const SIZE_EXABYTE = 1152921504606846976;
        const SIZE_GIGABYTE = 1073741824;
        const SIZE_KILOBYTE = 1024;
        const SIZE_MEGABYTE = 1048576;
        const SIZE_PETABYTE = 1125899906842624;
        const SIZE_TERABYTE = 1099511627776;
        const SIZE_YOTTABYTE = 1208925819614629174706176;
        const SIZE_ZETTABYTE = 1180591620717411303424;

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
        public static function getBinaryStream(string $source): object {
            return new BinaryStream($source);
        }

        /**
         * returns the MIME type for a file
         * @param string $path the file path
         * @return false|string the MIME type if successful, false otherwise
         * @example $type = Files::getMIMEType("/foo/bar.mp4");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getMIMEType(string $path): false|string {
            if (
                file_exists($path) &&
                ($resource = finfo_open(FILEINFO_MIME_TYPE)) !== false
            ) {
                $type = finfo_file($resource, $path);
                finfo_close($resource);
                return $type;
            }

            return false;
        }

        /**
         * returns a properly formatted string with the size of a given file
         * @param int $size the file size (in bytes)
         * @return false|string a string if successful, false otherwise
         * @example $size = Files::getSize(1048576);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getSize(int $size): false|string {
            if (
                $size >= 0 &&
                $size < self::SIZE_KILOBYTE
            ) {
                return sprintf("%sB", $size);
            }

            if (
                $size >= self::SIZE_KILOBYTE &&
                $size < self::SIZE_MEGABYTE
            ) {
                return number_format(($size / self::SIZE_KILOBYTE) + 0, 2) . "KB";
            }

            if (
                $size >= self::SIZE_MEGABYTE &&
                $size < self::SIZE_GIGABYTE
            ) {
                return number_format(($size / self::SIZE_MEGABYTE) + 0, 2) . "MB";
            }

            if (
                $size >= self::SIZE_GIGABYTE &&
                $size < self::SIZE_TERABYTE
            ) {
                return number_format(($size / self::SIZE_GIGABYTE) + 0, 2) . "GB";
            }

            if (
                $size >= self::SIZE_TERABYTE &&
                $size < self::SIZE_PETABYTE
            ) {
                return number_format(($size / self::SIZE_TERABYTE) + 0, 2) . "TB";
            }

            if (
                $size >= self::SIZE_PETABYTE &&
                $size < self::SIZE_EXABYTE
            ) {
                return number_format(($size / self::SIZE_PETABYTE) + 0, 2) . "PB";
            }

            if (
                $size >= self::SIZE_EXABYTE &&
                $size < self::SIZE_ZETTABYTE
            ) {
                return number_format(($size / self::SIZE_EXABYTE) + 0, 2) . "EB";
            }

            if (
                $size >= self::SIZE_ZETTABYTE &&
                $size < self::SIZE_YOTTABYTE
            ) {
                return number_format(($size / self::SIZE_YOTTABYTE) + 0, 2) . "ZB";
            }

            if ($size >= self::SIZE_YOTTABYTE) {
                return number_format(($size / self::SIZE_YOTTABYTE) + 0, 2) . "YB";
            }

            return false;
        }

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
        public static function send(string $source, int $rate = self::RATE_DEFAULT, string $name = null): bool {
            if (
                file_exists($source) &&
                $rate > 0 &&
                !empty($t = ini_get("max_execution_time"))
            ) {
                ini_set("max_execution_time", -1);

                if (!empty($f = fopen($source, "r"))) {
                    header("Cache-control: private");
                    header("Content-Type: application/octet-stream");
                    header(sprintf("Content-Length: %d", filesize($source)));
                    header(sprintf("Content-Disposition: filename=\"%s\";",$name ?? $source));

                    while (!feof($f)) {
                        echo fread($f, $rate << 8);
                        flush();
                        usleep(250000);
                    }

                    ini_set("max_execution_time", $t);
                    return fclose($f);
                }
            }

            return false;
        }

        /**
         * streams a given file
         * @param string $source the file source
         * @param int $buffer the buffer size (in kilobytes) (optional)
         * @example Files::stream("/path/foo.zip");
         * @example Files::stream("/path/foo.zip", 100);
         * @throws Throwable
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function stream(string $source, int $buffer = self::SIZE_DEFAULT): void {
            if (
                file_exists($source) &&
                $buffer > 0
            ) {
                $type = self::getMIMEType($source);

                if (
                    in_array($type, MIME::getTypes(), true) &&
                    !empty($stream = fopen($source, "rb"))
                ) {
                    ob_get_clean();
                    header("Content-Type: {$type}");
                    header("Cache-Control: max-age=2592000, public");
                    header("Expires: " . gmdate("D, d M Y H:i:s", time() + 2592000) . " GMT");
                    header("Last-Modified: " . gmdate("D, d M Y H:i:s", filemtime($source)) . " GMT");
                    header("Accept-Ranges: 0-" . ($end = ($size = filesize($source)) - 1));
                    $start = $i = 0;
                    $b = $end;

                    if (!empty($_SERVER["HTTP_RANGE"])) {
                        $range = $_SERVER["HTTP_RANGE"];

                        if (!empty($elements = explode("=", $_SERVER["HTTP_RANGE"], 2))) {
                            $range = end($elements);
                        }

                        if (str_contains($range, ",")) {
                            http_response_code(416);
                            header("Content-Range: bytes {$start}-{$end}/{$size}");
                            terminate_request();
                        }

                        if ($range === "-") {
                            $a = $size - substr($range, 1);
                        } else {
                            $range = explode("-", $range);
                            $a = $range[0];

                            if (
                                !empty($range[1]) &&
                                is_numeric($range[1])
                            ) {
                                $b = $range[1];
                            }
                        }

                        $b = min($b, $end);

                        if ($a > $b || $a > ($size - 1) || $b >= $size) {
                            http_response_code(416);
                            header("Content-Range: bytes {$start}-{$end}/{$size}");
                            terminate_request();
                        }

                        $start = $a;
                        $end = $b;
                        $length = ($end - $start) + 1;
                        fseek($stream, $start);
                        http_response_code(206);
                        header("Content-Length: {$length}");
                        header("Content-Range: bytes {$start}-{$end}/{$size}");
                    } else {
                        header("Content-Length: {$size}");
                    }

                    set_time_limit(0);

                    while (
                        !feof($stream) &&
                        $i <= $end
                    ) {
                        $amount = $buffer << 10;

                        if (($i + $amount) > $end) {
                            $amount = ($end - $i) + 1;
                        }

                        echo fread($stream, $amount);
                        flush();
                    }

                    fclose($stream);
                    terminate_request();
                }
            }
        }
    }