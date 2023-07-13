<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Validators;

    /**
     * periodic (cron) job
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Cron {
        /**
         * checks whether a given date is valid or not
         * @param string $input the input date
         * @return bool whether the given date is valid or not
         * @example $result = Cron::isValid("0 4 15-21 * 1 /foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool;
    }