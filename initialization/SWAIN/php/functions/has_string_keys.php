<?php
    /**
     * has_string_keys
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("has_string_keys")) {
        /**
         * checks whether a given array has string keys or not
         * @param array $input the input array
         * @return bool whether the given array has string keys or not
         * @example $result = has_string_keys(["foo" => 1, "bar" => 2]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function has_string_keys(array $input): bool {
            return count(array_filter(array_keys($input), "is_string")) > 0;
        }
    }