<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers;

    /**
     * objects
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Objects {
        /**
         * returns the hash for a given object
         * @param object $object the object
         * @return string the hash for the given object
         * @example $hash = Objects::getHash($foo);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getHash(object $object): string;

        /**
         * checks whether two given objects are equal or not
         * @param object $a the first object
         * @param object $b the second object
         * @return bool whether the given objects are equal or not
         * @example $result = Objects::isEqual($a, $b);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isEqual(object $a, object $b): bool;
    }