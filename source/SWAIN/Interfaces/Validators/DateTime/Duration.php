<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Validators\DateTime;

    /**
     * duration
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Duration {
        /**
         * checks whether the given input duration is valid or not
         * @param string $input the input duration (in ISO 8601 format)
         * @return bool whether the input duration is valid or not
         * @example $result = Duration::isValid("P1W");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool;
    }