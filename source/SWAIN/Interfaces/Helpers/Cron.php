<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers;

    /**
     * periodic job (cron job)
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Cron {
        /**
         * outputs all defined jobs as a file
         * @param array $jobs the list of periodic jobs
         * @param string $file the output file
         * @return bool whether all defined jobs where successfully written to the output file or not
         * @example $string = Cron::asFile([
         *     "/foo" => "0 4 15-21 * 1"
         * ], "/foo/bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function asFile(array $jobs, string $file): bool;

        /**
         * outputs all defined jobs as a string
         * @param array $jobs the list of periodic jobs
         * @return false|string all defined jobs as a string if successful, false otherwise
         * @example $string = Cron::asString([
         *     "/foo" => "0 4 15-21 * 1"
         * ], "/foo/bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function asString(array $jobs): false|string;

        /**
         * extracts the cron expression from a given file
         * @param string $file the file
         * @return false|string the cron expression if successful, false otherwise
         * @example $expression = Cron::fromFile("/foo/bar");
         * @composer "ajbdev/cronlingo": "v0.1.1"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function fromFile(string $file): false|string;
    }