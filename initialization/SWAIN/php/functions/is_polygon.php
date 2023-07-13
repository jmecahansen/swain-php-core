<?php
    /**
     * is_polygon
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("is_polygon")) {
        /**
         * checks whether a given array matches the structure of a polygon or not
         * @param array $input the input array
         * @return bool whether the given array matches the structure of a polygon or not
         * @example $result = is_polygon([[0, 0], [0, 50], [50, 50], [50, 0], [0, 0]]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function is_polygon(array $input): bool {
            return !empty($input) &&
            count($input) >= 3 &&
            count($input) === count(array_filter($input, function ($i) {
                return is_array($i) && count(array_filter($i, "is_numeric")) === 2;
            })) &&
            $input[0] === end($input);
        }
    }