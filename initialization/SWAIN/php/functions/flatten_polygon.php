<?php
    /**
     * flatten_polygon
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("flatten_polygon")) {
        /**
         * flattens an array with the structure of a polygon
         * @param array $input the input array
         * @return array|false the flattened array if successful, false otherwise
         * @example $result = flatten_polygon([[0, 0], [0, 50], [50, 50], [50, 0], [0, 0]]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function flatten_polygon(array $input): array|false {
            if (
                !empty($input) &&
                is_polygon($input)
            ) {
                return array_merge(...$input);
            }

            return false;
        }
    }