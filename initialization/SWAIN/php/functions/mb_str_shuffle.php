<?php
    /**
     * mb_str_shuffle
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("mb_str_shuffle")) {
        /**
         * reorders a given input string in a random fashion
         * @param string $input the input string
         * @return string the reordered string if successful, the same input string otherwise
         * @example $string = mb_str_shuffle("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function mb_str_shuffle(string $input): string {
            if (!empty($output = preg_split("//u", $input, -1, PREG_SPLIT_NO_EMPTY))) {
                shuffle($output);
                return implode($output);
            }

            return $input;
        }
    }