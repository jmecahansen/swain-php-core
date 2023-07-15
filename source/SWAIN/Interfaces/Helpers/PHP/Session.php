<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers\PHP;
    use Throwable;

    /**
     * session
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Session {
        /**
         * returns the session identifier
         * @return false|string the session identifier if successful, false otherwise
         * @example $id = Session::getId();
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getId(): false|string;

        /**
         * returns the value for a given key
         * @param string $key the key we want to get from the session
         * @return mixed the value  for the given key if successful, false otherwise
         * @example $value = Session::getKey("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getKey(string $key): mixed;

        /**
         * returns all session keys (or a subset when filtered)
         * @param array $filter the filter to retrieve a specific set of keys (optional)
         * @return array all session keys (or a subset when filtered)
         * @example $keys = Session::getKeys();
         * @example $keys = Session::getKeys(["foo", "bar", "baz"]);
         * @example $keys = Session::getKeys(["like" => ["foo", "bar", "baz"]]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getKeys(array $filter = []): array;

        /**
         * removes a given key
         * @param string $key the key to remove
         * @example $result = Session::removeKey("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function removeKey(string $key): void;

        /**
         * removes all session keys (or a subset when filtered)
         * @param array $filter the filter to retrieve a specific set of keys (optional)
         * @example $result = Session::removeKeys();
         * @example $result = Session::removeKeys(["foo", "bar", "baz"]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function removeKeys(array $filter = []): void;

        /**
         * sets a session key
         * @param string $key the key
         * @param mixed $value the value for the key
         * @return bool whether the session key was successfully set or not
         * @example $result = Session::setKey("foo", "bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function setKey(string $key, mixed $value): bool;

        /**
         * starts the session
         * @example Session::start();
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function start(): void;
    }