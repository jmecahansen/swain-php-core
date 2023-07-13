<?php
    /**
     * is_multipolygon
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("is_multipolygon")) {
        /**
         * checks whether a given array matches the structure of multiple polygons or not
         * @param array $input the input array
         * @return bool whether the given array matches the structure of multiple polygons or not
         * @example $result = is_multipolygon(
         *     [[[0, 0], [0, 50], [50, 50], [50, 0], [0, 0]],
         *     [[20, 20], [20, 80], [80, 80], [80, 20], [20, 20]]]
         * );
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function is_multipolygon(array $input): bool {
            return !empty($input) &&
            count($input) === count(array_filter($input, "is_polygon"));
        }
    }