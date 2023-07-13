<?php
    /**
     * mb_levenshtein
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("mb_levenshtein")) {
        /**
         * returns the (multibyte safe) levenshtein distance between two strings
         * @param string $a the first string
         * @param string $b the second string
         * @return int the levenshtein distance between the two given strings if successful, false otherwise
         * @example $distance = mb_levenshtein("foo", "bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function mb_levenshtein(string $a, string $b): int {
            return levenshtein(utf8_to_extended_ascii($a), utf8_to_extended_ascii($b));
        }
    }