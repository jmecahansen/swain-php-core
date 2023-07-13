<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Validators\Strings;

    /**
     * UUID
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class UUID implements \SWAIN\Interfaces\Validators\Strings\UUID {
        /**
         * checks whether the given input UUID is valid or not
         * @param string $input the input UUID
         * @return bool whether the input UUID is valid or not
         * @example $result = UUID::isValid("931d3ff1-bb4e-46d8-ad3d-32912dc41649");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool {
            return (
                $result = preg_match(
                    "/^[\da-f]{8}-[\da-f]{4}-4[\da-f]{3}-[89ab][\da-f]{3}-[\da-f]{12}$/i",
                    $input
                )
            ) !== false && $result > 0;
        }
    }