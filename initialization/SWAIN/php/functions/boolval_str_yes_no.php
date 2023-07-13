<?php
    /**
     * boolval_str_yes_no
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("boolval_str_yes_no")) {
        /**
         * returns the string representation (yes/no) of a given boolean value
         * @param bool $value the value
         * @return string the string representation (yes/no) of the given boolean value
         * @example $value = boolval_str_yes_no(true);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function boolval_str_yes_no(bool $value): string {
            return [
                false => "no",
                true => "yes"
            ][$value];
        }
    }