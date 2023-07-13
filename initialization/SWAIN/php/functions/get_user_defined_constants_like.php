<?php
    /**
     * get_user_defined_constants_like
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("get_user_defined_constants_like")) {
        /**
         * returns all user-defined constants looking like a given string
         * @param string $string the string
         * @return array|false all user-defined constants looking like the given string if successful, false otherwise
         * @example $constants = get_user_defined_constants_like("USERS_DEFAULT_ACL_ID");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function get_user_defined_constants_like(string $string): array|false {
            if (array_key_exists("user", $constants = get_defined_constants(true))) {
                if (!empty($keys = array_filter(array_keys($constants["user"]), function ($i) use ($string) {
                    return str_contains($i, $string);
                }))) {
                    return array_intersect_key($constants["user"], array_flip($keys));
                }
            }

            return false;
        }
    }