<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers;

    /**
     * objects
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Objects implements \SWAIN\Interfaces\Helpers\Objects {
        // hash algorithm
        const HASH_ALGORITHM = "xxh128";

        /**
         * returns the hash for a given object
         * @param object $object the object
         * @return string the hash for the given object
         * @example $hash = Objects::getHash($foo);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getHash(object $object): string {
            return hash(
                self::HASH_ALGORITHM,
                json_encode($object, JSON::FLAGS_DEFAULT)
            );
        }

        /**
         * checks whether two given objects are equal or not
         * @param object $a the first object
         * @param object $b the second object
         * @return bool whether the given objects are equal or not
         * @example $result = Objects::isEqual($a, $b);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isEqual(object $a, object $b): bool {
            return self::getHash($a) === self::getHash($b);
        }
    }