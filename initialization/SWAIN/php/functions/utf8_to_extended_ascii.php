<?php
    /**
     * utf8_to_extended_ascii
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("utf8_to_extended_ascii")) {
        /**
         * converts a UTF-8 encoded string to a single-byte string suitable for functions such as levenshtein()
         * @param string $input the input string
         * @param array $map the encoding map
         * @return string the converted string
         * @example $result = utf8_to_extended_ascii("foo", []);
         * @author luciole75w <luciole75w@gmail.com>
         */
        function utf8_to_extended_ascii(string $input, array &$map = []): string {
            $matches = [];

            // find all multibyte characters (cf. utf-8 encoding specs)
            if (!preg_match_all("/[\xC0-\xF7][\x80-\xBF]+/", $input, $matches)) {
                return $input;
            }

            // update the encoding map with the characters not already met
            foreach ($matches[0] as $mbc) {
                if (!isset($map[$mbc])) {
                    $map[$mbc] = chr(128 + count($map));
                }
            }

            // remap non-ascii characters
            return strtr($input, $map);
        }
    }