<?php
    /**
     * mb_jaro
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("mb_jaro")) {
        /**
         * returns the (multibyte safe) jaro distance between two strings
         * @param string $a the first string
         * @param string $b the second string
         * @return float the jaro distance between the two given strings if successful, false otherwise
         * @example $distance = mb_jaro("foo", "bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function mb_jaro(string $a, string $b): float {
            $a = utf8_to_extended_ascii($a);
            $b = utf8_to_extended_ascii($b);
            $la = strlen($a);
            $lb = strlen($b);
            $distance = (int) floor(min($la, $lb) / 2.0);
            $ca = get_common_characters($a, $b, $distance);
            $cb = get_common_characters($b, $a, $distance);
            $lca = strlen($ca);
            $lcb = strlen($cb);

            if ($lca === 0 || $lcb === 0) {
                return 0;
            }

            $t = 0;
            $ub = min($lca, $lcb);

            for ($i = 0; $i < $ub; $i++) {
                if ($ca[$i] !== $cb[$i]) {
                    $t++;
                }
            }

            $t /= 2.0;
            return ($lca / ($la) + $lcb / ($lb) + ($lca - $t) / ($lca)) / 3.0;
        }
    }