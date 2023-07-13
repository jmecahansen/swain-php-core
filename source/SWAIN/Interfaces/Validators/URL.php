<?php
    /**
     * URL
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Validators;

    /**
     * URL
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface URL {
        /**
         * checks whether a given URL is valid or not
         * @param string $url the URL we want to check
         * @return bool whether the given URL is valid or not
         * @example $check = URL::isValid("http://foo.com");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $url): bool;
    }