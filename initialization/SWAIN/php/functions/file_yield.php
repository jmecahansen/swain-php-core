<?php
    /**
     * file_yield
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("file_yield")) {
        /**
         * yield the contents of a given file line by line
         * @param string $source the file source
         * @return iterable an iterator for the file contents
         * @example $contents = file_yield("/path/foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function file_yield(string $source): iterable {
            if (
                file_exists($source) &&
                !empty($handler = fopen($source, "r"))
            ) {
                while (!feof($handler)) {
                    yield trim(fgets($handler));
                }

                fclose($handler);
            }
        }
    }