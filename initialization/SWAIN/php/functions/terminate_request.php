<?php
    /**
     * terminate_request
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("terminate_request")) {
        /**
         * terminates the current request
         * @param callable|null $function the function to execute before terminating the request (optional)
         * @example terminate_request();
         * @example terminate_request(function () { http_response_code(500); });
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function terminate_request(callable $function = null): void {
            if (!empty($function)) {
                $function();
            }

            if (!str_contains($_SERVER["PHP_SELF"], "phpunit")) {
                if (str_ends_with(PHP_SAPI, "fcgi")) {
                    function_exists("fastcgi_finish_request") ? fastcgi_finish_request() : exit();
                } else {
                    exit();
                }
            }
        }
    }