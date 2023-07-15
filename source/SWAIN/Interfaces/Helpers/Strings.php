<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers;
    use Throwable;

    /**
     * strings
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Strings {
        // default character set
        const CHARACTER_SET_DEFAULT = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // language detection mode
        const LANGUAGE_DETECT_CLOSEST = 2;

        /**
         * returns the language in which a given string is written
         * @param string $string the input string
         * @param int $mode the return mode for all available results (optional, the closest match will be returned)
         * @return array|false|string the language in which the given string is written if successful, false otherwise
         * @example $language = Strings::getLanguage("foo");
         * @example $language = Strings::getLanguage("foo", Strings::LANGUAGE_DETECT_ALL);
         * @throws Throwable
         * @composer "patrickschur/language-detection": "v5.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getLanguage(
            string $string,
            int $mode = self::LANGUAGE_DETECT_CLOSEST
        ): array|false|string;

        /**
         * returns the plural form for a given noun
         * WARNING: this function ONLY works for english nouns
         * @param string $noun the noun
         * @return string the plural form for the given noun
         * @example $plural = Strings::getPlural("foo");
         * @throws Throwable
         * @composer "doctrine/inflector": "2.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getPlural(string $noun): string;

        /**
         * returns a random string n characters long
         * @param int $size the string size (optional)
         * @param string $charset the character set to use (optional, the default character set will be used)
         * @return false|string a random string n characters long if successful, false otherwise
         * @example $output = Strings::getRandom();
         * @example $output = Strings::getRandom(30);
         * @example $output = Strings::getRandom(30, "ABCDEFGHIJKLMNOPQRSTUVWXYZ");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getRandom(int $size = 30, string $charset = self::CHARACTER_SET_DEFAULT): false|string;

        /**
         * returns the estimated reading time for a given string (in minutes)
         * @param string $string the input string
         * @param int $count the number of words per minute (optional)
         * @return false|int the estimated reading time for the given string (in minutes) if successful, false otherwise
         * @example $time = Strings::getReadingTime($input);
         * @example $time = Strings::getReadingTime($input, 250);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getReadingTime(string $string, int $count = 200): false|int;

        /**
         * returns the singular form for a given noun
         * WARNING: this function ONLY works for english nouns
         * @param string $noun the noun
         * @return string the singular form for the given noun
         * @example $singular = Strings::getSingular("foo");
         * @throws Throwable
         * @composer "doctrine/inflector": "2.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getSingular(string $noun): string;

        /**
         * returns the stem for a given word in a given language
         * @param string $word the word
         * @param string $language the stemming language
         * @return false|string the stem for the given word in the given language if successful, false otherwise
         * @example $stem = Strings::getStem("zapatos", "es");
         * @throws Throwable
         * @composer "wamania/php-stemmer": "v2.2.0"
         * @composer "x3wil/czech-stemmer": "v0.1"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getStem(string $word, string $language): false|string;

        /**
         * returns a given input string in n strips with a given character limit
         * @param string $string the input string
         * @param int $limit the character limit for each strip
         * @return array|false the given string in n strips with the given character limit if successful, false
         * otherwise
         * @example $strips = Strings::getStrips($input, 200);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getStrips(string $string, int $limit): array|false;

        /**
         * hyphenates a string
         * @param string $string the string
         * @param bool $lowercase whether to convert (or not) the resulting string to lowercase (optional, false by
         * default)
         * @return false|string the hyphenated string if successful, false otherwise
         * @example $output = Strings::hyphenate("foo bar");
         * @example $output = Strings::hyphenate("foo bar", true);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function hyphenate(string $string, bool $lowercase = false): false|string;

        /**
         * checks if a given string is encoded as base64 or not
         * @param string $string the input string
         * @return bool whether the given string is encoded as base64 or not
         * @example $result = Strings::isBase64($input);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isBase64(string $string): bool;

        /**
         * checks if a given string contains HTML elements in it
         * @param string $string the input string
         * @return bool whether the input string contains HTML elements in it or not
         * @example $result = Strings::isHTML($input);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isHTML(string $string): bool;

        /**
         * checks whether a given input string is JSON-structured or not
         * @param string $string the input string we want to check
         * @return bool whether the given input string is JSON-structured or not
         * @example $result = Strings::isJSON("sample string");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isJSON(string $string): bool;

        /**
         * checks if a string is serialized or not
         * @param string $string the string
         * @return bool whether the string is serialized or not
         * @example $result = Strings::isSerialized("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isSerialized(string $string): bool;

        /**
         * checks whether a given input string is encoded as UTF-8 or not
         * @param string $string the input string we want to check
         * @return bool whether the given input string is encoded as UTF-8 or not
         * @example $result = Strings::isUTF8("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isUTF8(string $string): bool;

        /**
         * checks whether a given string is structured as XML or not
         * @param string $string the string we want to check
         * @return bool whether the given string is structured as XML or not
         * @example $result = Strings::isXML("sample string");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isXML(string $string): bool;

        /**
         * scrambles a given input string
         * @param string $string the input string
         * @return false|string the scrambled string if successful, the input string otherwise
         * @example $string = Strings::scramble("A quick brown fox jumped over the lazy dog.");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function scramble(string $string): false|string;

        /**
         * converts a given input string to camel case
         * @param string $string the input string
         * @return false|string the input string converted to camel case if successful, false otherwise
         * @example $output = Strings::toCamelCase("foo and bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function toCamelCase(string $string): false|string;

        /**
         * returns an unaccented (without specific accents or marks) string out of a given string
         * @param string $string the string we want to get normalized
         * @return string the unaccented (without specific accents or marks) string out of the given string
         * @example $string = Strings::unaccent("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function unaccent(string $string): string;
    }