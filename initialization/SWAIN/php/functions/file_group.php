<?php
    /**
     * file_group
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("file_group")) {
        /**
         * returns the group of a given file
         * @param string $path the file path
         * @return false|string the group of the given file if successful, false otherwise
         * @example $group = file_group("/path/foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function file_group(string $path): false|string {
            if (
                function_exists("filegroup") &&
                function_exists("posix_getgrgid")
            ) {
                return posix_getgrgid(filegroup($path))["name"];
            }

            return false;
        }
    }