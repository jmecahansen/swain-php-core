<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Validators;

    /**
     * date & time
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface DateTime {
        /**
         * checks whether a given date is valid or not
         * @param string $input the input date
         * @return bool whether the given date is valid or not
         * @example $result = DateTime::isValid("10/07/2012");
         * @example $result = DateTime::isValid("07/2012");
         * @example $result = DateTime::isValid("2012-07-10");
         * @example $result = DateTime::isValid("2012-07");
         * @example $result = DateTime::isValid("23:17");
         * @example $result = DateTime::isValid("23:17:02");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool;
    }