<?php
    /**
     * array_compare_recursive
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("array_compare_recursive")) {
        /**
         * checks whether two arrays are equal or not
         * @param array $a the first array
         * @param array $b the second array
         * @return bool whether the two given arrays are equal or not
         * @example $result = array_compare_recursive($a, $b);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function array_compare_recursive(array $a, array $b): bool {
            if (count($a) !== count($b)) {
                return false;
            }

            foreach ($a as $k => $v) {
                if (is_array($v)) {
                    if (!isset($b[$k]) || !is_array($b[$k])) {
                        return false;
                    } elseif (!array_compare_recursive($v, $b[$k])) {
                        return false;
                    }
                } elseif (!isset($b[$k]) || $b[$k] !== $v) {
                    return false;
                }
            }

            return true;
        }
    }