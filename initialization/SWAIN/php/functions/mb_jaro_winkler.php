<?php
    /**
     * mb_jaro_winkler
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("mb_jaro_winkler")) {
        /**
         * returns the (multi-byte safe) jaro-winkler similarity index between two given strings
         * @param string $a the first string
         * @param string $b the second string
         * @param float $scale the prefix scale (optional)
         * @return float the jaro-winkler similarity index between the two given strings
         * @example $index = mb_jaro_winkler("foo", "bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function mb_jaro_winkler(string $a, string $b, float $scale = 0.1): float {
            $a = utf8_to_extended_ascii($a);
            $b = utf8_to_extended_ascii($b);
            $la = strlen($a);
            $lb = strlen($b);
            $n = min([4, $la, $lb]);

            for ($i = 0; $i < $n; $i++) {
                if ($a[$i] !== $b[$i]) {
                    $n = $i;
                    break;
                }
            }

            $distance = mb_jaro($a, $b);
            return $distance + $n * $scale * (1.0 - $distance);
        }
    }