<?php
    /**
     * yaml_decode
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("yaml_decode")) {
        /**
         * returns the array representation for the contents of a given string (or file)
         * @param string $input the input string
         * @return array|false the array representation for the contents of the given string (or file) if successful,
         * false otherwise
         * @example $result = yaml_decode($input);
         * @example $result = yaml_decode("/path/foo.yaml");
         * @composer "mustangostang/spyc": "0.6.3"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function yaml_decode(string $input): array|false {
            if (
                !empty($input) &&
                class_exists("Spyc")
            ) {
                return Spyc::YAMLLoad($input);
            }

            return false;
        }
    }