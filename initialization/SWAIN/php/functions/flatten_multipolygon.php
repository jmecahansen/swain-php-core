<?php
    /**
     * flatten_multipolygon
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("flatten_multipolygon")) {
        /**
         * flattens an array with the structure of a polygon
         * @param array $input the input array
         * @return array|false the flattened array if successful, false otherwise
         * @example $result = flatten_polygon([[0, 0], [0, 50], [50, 50], [50, 0], [0, 0]]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function flatten_multipolygon(array $input): array|false {
            if (
                !empty($input) &&
                is_multipolygon($input)
            ) {
                return array_merge(...array_map("flatten_polygon", $input));
            }

            return false;
        }
    }