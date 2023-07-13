<?php
    /**
     * get_user_defined_constants_matching
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("get_user_defined_constants_matching")) {
        /**
         * returns all user-defined constants with their key matching a given regular expression
         * @param string $expression the regular expression
         * @return array|false all user-defined constants with their key matching the given regular expression if
         * successful, false otherwise
         * @example $constants = get_user_defined_constants_matching("/FOO_(?:LI|MA)KES_BAR/");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function get_user_defined_constants_matching(string $expression): array|false {
            if (array_key_exists("user", $constants = get_defined_constants(true))) {
                if (!empty($keys = array_filter(array_keys($constants["user"]), function ($i) use ($expression) {
                    return preg_match($expression, $i);
                }))) {
                    return array_intersect_key($constants["user"], array_flip($keys));
                }
            }

            return false;
        }
    }