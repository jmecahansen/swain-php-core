<?php
    /**
     * double_metaphone
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("double_metaphone")) {
        /**
         * returns the double metaphone of a given input string
         * @param string $input the input string
         * @return false|string the double metaphone of the given input string if successful, false otherwise
         * @example $metaphone = double_metaphone("foo");
         * @composer "noodlesnz/double-metaphone": "1.0.1"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function double_metaphone(string $input): false|string {
            if (
                !empty($input) &&
                class_exists("DoubleMetaphone")
            ) {
                $double_metaphone = new DoubleMetaphone($input);

                if (!empty($double_metaphone->primary)) {
                    return $double_metaphone->primary;
                }
            }

            return false;
        }
    }