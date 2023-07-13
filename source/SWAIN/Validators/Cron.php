<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Validators;

    /**
     * periodic (cron) job
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Cron implements \SWAIN\Interfaces\Validators\Cron {
        /**
         * checks whether a given periodic (cron) job is valid or not
         * @param string $input the periodic (cron) job
         * @return bool whether the given periodic (cron) job is valid or not
         * @example $result = Cron::isValid("0 4 15-21 * 1 /foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool {
            return preg_match("/^\s*($|#|\w+\s*=|(\*(\/\d+)?|([0-5]?\d)(-([0-5]?\d)(\/\d+)?)?(,([0-5]?\d)(-(" .
            "[0-5]?\d)(\/\d+)?)?)*)\s+(\*(\/\d+)?|([01]?\d|2[0-3])(-([01]?\d|2[0-3])(\/\d+)?)?(,([01]?\d|2[0-3])(-(" .
            "[01]?\d|2[0-3])(\/\d+)?)?)*)\s+(\*(\/\d+)?|(0?[1-9]|[12]\d|3[01])(-(0?[1-9]|[12]\d|3[01])(\/\d+)?)?(,(" .
            "0?[1-9]|[12]\d|3[01])(-(0?[1-9]|[12]\d|3[01])(\/\d+)?)?)*)\s+(\*(\/\d+)?|([1-9]|1[012])(-([1-9]|1[012])" .
            "(\/\d+)?)?(,([1-9]|1[012])(-([1-9]|1[012])(\/\d+)?)?)*|jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)" .
            "\s+(\*(\/\d+)?|([0-7])(-([0-7])(\/\d+)?)?(,([0-7])(-([0-7])(\/\d+)?)?)*|mon|tue|wed|thu|fri|sat|sun)\s+" .
            "\S|(@reboot|@yearly|@annually|@monthly|@weekly|@daily|@midnight|@hourly)\s+\S)/", $input) !== 0;
        }
    }