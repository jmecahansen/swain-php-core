<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Validators\Strings;

    /**
     * UUID
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface UUID {
        /**
         * checks whether the given input UUID is valid or not
         * @param string $input the input UUID
         * @return bool whether the input UUID is valid or not
         * @example $result = UUID::isValid("931d3ff1-bb4e-46d8-ad3d-32912dc41649");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool;
    }