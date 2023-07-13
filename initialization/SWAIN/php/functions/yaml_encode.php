<?php
    /**
     * yaml_encode
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("yaml_encode")) {
        /**
         * outputs the YAML representation for a given array
         * @param array $input the input array
         * @param int $indent the indentation level (2 spaces by default)
         * @param int $wordwrap the word wrapping threshold (40 by default, set 0 for no wrapping)
         * @param bool $no_opening_dashes whether to start YAML file with "---\n" or not (false by default)
         * @return false|string the YAML representation of the given array if successful, false otherwise
         * @example $output = yaml_encode($input);
         * @example $output = yaml_encode($input, 4);
         * @example $output = yaml_encode($input, 4, 120);
         * @example $output = yaml_encode($input, 4, 120, true);
         * @composer "mustangostang/spyc": "0.6.3"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function yaml_encode(array $input, int $indent = 2, int $wordwrap = 40, bool $no_opening_dashes = false): false|string {
            if (
                !empty($input) &&
                class_exists("Spyc")
            ) {
                return Spyc::YAMLDump($input, $indent, $wordwrap, $no_opening_dashes);
            }

            return false;
        }
    }