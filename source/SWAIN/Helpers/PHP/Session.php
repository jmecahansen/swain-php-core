<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers\PHP;

    /**
     * session
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Session implements \SWAIN\Interfaces\Helpers\PHP\Session {
        /**
         * returns the session identifier
         * @return false|string the session identifier if successful, false otherwise
         * @example $id = Session::getId();
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getId(): false|string {
            self::start();
            return session_id();
        }

        /**
         * returns the value for a given key
         * @param string $key the key we want to get from the session
         * @return mixed the value  for the given key if successful, false otherwise
         * @example $value = Session::getKey("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getKey(string $key): mixed {
            self::start();
            return array_key_exists($key, $_SESSION) ? unserialize($_SESSION[$key]) : false;
        }

        /**
         * returns all session keys (or a subset when filtered)
         * @param array $filter the filter to retrieve a specific set of keys (optional)
         * @return array all session keys (or a subset when filtered)
         * @example $keys = Session::getKeys();
         * @example $keys = Session::getKeys(["foo", "bar", "baz"]);
         * @example $keys = Session::getKeys(["like" => ["foo", "bar", "baz"]]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getKeys(array $filter = []): array {
            self::start();

            if (empty($filter)) {
                return $_SESSION;
            } else {
                $keys = [];

                foreach ($filter as $k1 => $v1) {
                    $k2 = array_keys($_SESSION);

                    if (
                        is_numeric($k1) &&
                        in_array($v1, $k2, true)
                    ) {
                        $keys[$k1] = self::getKey($v1);
                    } elseif ($k1 === "like") {
                        foreach ($v1 as $v2) {
                            $keys = array_merge($keys, array_filter($k2, function($i) use ($v2) {
                                return str_contains($i, $v2);
                            }));
                        }
                    }
                }

                return $keys;
            }
        }

        /**
         * removes a given key
         * @param string $key the key to remove
         * @example $result = Session::removeKey("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function removeKey(string $key): void {
            self::start();

            if (array_key_exists($key, $_SESSION)) {
                unset($_SESSION[$key]);
            }
        }

        /**
         * removes all session keys (or a subset when filtered)
         * @param array $filter the filter to retrieve a specific set of keys (optional)
         * @example $result = Session::removeKeys();
         * @example $result = Session::removeKeys(["foo", "bar", "baz"]);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function removeKeys(array $filter = []): void {
            self::start();

            if (empty($filter)) {
                session_unset();
            } else {
                foreach ($filter as $key => $value) {
                    if (is_numeric($key)) {
                        unset($_SESSION[$value]);
                    } elseif ($key === "like") {
                        array_walk($_SESSION, function ($i) use ($value) {
                            if (str_contains($i, $value)) {
                                unset($_SESSION[$value]);
                            }
                        });
                    }
                }
            }
        }

        /**
         * sets a session key
         * @param string $key the key
         * @param mixed $value the value for the key
         * @return bool whether the session key was successfully set or not
         * @example $result = Session::setKey("foo", "bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function setKey(string $key, mixed $value): bool {
            self::start();

            if (
                !empty($key)
                && !empty($value)
            ) {
                $_SESSION[$key] = serialize($value);
                return true;
            }

            return false;
        }

        /**
         * starts the session
         * @example Session::start();
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function start(): void {
            if (
                session_status() !== PHP_SESSION_ACTIVE &&
                !headers_sent()
            ) {
                session_start();
            }
        }
    }