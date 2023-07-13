<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Validators;

    /**
     * e-mail
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Email implements \SWAIN\Interfaces\Validators\Email {
        /**
         * checks whether a given e-mail address is valid or not
         * @param string $input the input e-mail address
         * @return bool whether the given e-mail address is valid or not
         * @example $result = Email::isValid("baz@foobar.com");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool {
            return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
        }
    }