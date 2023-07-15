<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers;
    use Throwable;

    /**
     * e-mail
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Email {
        /**
         * checks if an e-mail address is disposable
         * @param string $email the e-mail address
         * @return bool whether the e-mail address is disposable or not
         * @example $result = Email::isDisposable("baz@foobar.com");
         * @throws Throwable
         * @composer "mattketmo/email-checker": "2.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isDisposable(string $email): bool;

        /**
         * checks if a e-mail address is reachable
         * @param string $email the e-mail address
         * @param int|null $port the server connection port (optional)
         * @return bool whether the e-mail address is reachable or not
         * @example $result = Email::isReachable("baz@foobar.com");
         * @example $result = Email::isReachable("baz@foobar.com", 25);
         * @throws Throwable
         * @composer "hbattat/verifyemail": "v1.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isReachable(string $email, int $port = null): bool;
    }