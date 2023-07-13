<?php
    /**
     * mb_levenshtein_ratio
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("mb_levenshtein_ratio")) {
        /**
         * returns the (multibyte safe) levenshtein distance ratio between two given strings
         * @param string $a the first string
         * @param string $b the second string
         * @return int the levenshtein distance ratio between the two given strings if successful, false otherwise
         * @example $index = mb_levenshtein_ratio("foo", "bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function mb_levenshtein_ratio(string $a, string $b): int {
            $la = mb_strlen($a, "UTF-8");
            $lb = mb_strlen($b, "UTF-8");
            return round((1 - mb_levenshtein($a, $b) / max($la, $lb)) * 100, 0);
        }
    }