<?php
    /**
     * file_owner
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("file_owner")) {
        /**
         * returns the owner of a given file
         * @param string $path the file path
         * @return false|string the owner of the given file if successful, false otherwise
         * @example $owner = file_owner("/path/foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function file_owner(string $path): false|string {
            if (
                function_exists("fileowner") &&
                function_exists("posix_getpwuid")
            ) {
                return posix_getpwuid(fileowner($path))["name"];
            }

            return false;
        }
    }