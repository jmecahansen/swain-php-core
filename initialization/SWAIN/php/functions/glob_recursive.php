<?php
    /**
     * glob_recursive
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("glob_recursive")) {
        /**
         * performs a recursive glob to find all files and/or folders for a given pattern
         * @param string $pattern the pattern to match against
         * @param int $flags any applicable flags for the glob function
         * @return array all files and/or folders for the given pattern
         * @example $result = glob_recursive("*.foo", GLOB_NOSORT);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function glob_recursive(string $pattern, int $flags = 0): array {
            $output = [];

            foreach (glob(dirname($pattern) . "/*", GLOB_ONLYDIR|GLOB_NOSORT) ?: [] as $folder) {
                $output = array_merge($output, glob_recursive("{$folder}/" . basename($pattern), $flags));
            }

            return array_merge($output, glob($pattern, $flags) ?: []);
        }
    }