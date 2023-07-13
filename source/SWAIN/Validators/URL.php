<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Validators;

    /**
     * URL
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class URL implements \SWAIN\Interfaces\Validators\URL {
        /**
         * checks whether a given URL is valid or not
         * @param string $url the URL we want to check
         * @return bool whether the given URL is valid or not
         * @example $check = URL::isValid("http://foo.com");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $url): bool {
            return filter_var($url, FILTER_VALIDATE_URL) !== false;
        }
    }