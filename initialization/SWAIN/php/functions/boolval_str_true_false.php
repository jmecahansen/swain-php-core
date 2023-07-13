<?php
    /**
     * boolval_str_true_false
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("boolval_str_true_false")) {
        /**
         * returns the string representation (true/false) of a given boolean value
         * @param bool $value the value
         * @return string the string representation (true/false) of the given boolean value
         * @example $value = boolval_str_true_false(true);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function boolval_str_true_false(bool $value): string {
            return [
                false => "false",
                true => "true"
            ][$value];
        }
    }