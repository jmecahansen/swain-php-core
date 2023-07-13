<?php
    /**
     * get_common_characters
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("get_common_characters")) {
        /**
         * returns all common characters between two strings
         * @param string $a the first string
         * @param string $b the second string
         * @param int $distance the maximum distance between the two strings
         * @return null|string all common characters between the two strings if successful, null otherwise
         * @example $common = get_common_characters("bar", "baz", 2);
         * @author Ivo Ugrina <ivo@iugrina.com>
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function get_common_characters(string $a, string $b, int $distance): null|string {
            $a = utf8_to_extended_ascii($a);
            $b = utf8_to_extended_ascii($b);
            $c = $b;
            $la = strlen($a);
            $lb = strlen($b);
            $output = null;

            for ($i = 0; $i < $la; $i++) {
                $match = false;

                for ($j = max(0, $i - $distance); !$match && $j < min($i + $distance + 1, $lb); $j++) {
                    if ($c[$j] === $a[$i]) {
                        $match = true;
                        $output .= $a[$i];
                        $c[$j] = " ";
                    }
                }
            }

            return $output;
        }
    }