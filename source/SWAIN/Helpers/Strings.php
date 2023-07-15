<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers;
    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\Inflector;
    use Doctrine\Inflector\Rules\English\Rules as InflectorRules;
    use Doctrine\Inflector\RulesetInflector;
    use LanguageDetection\Language as LanguageDetector;
    use Throwable;
    use Wamania\Snowball\StemmerFactory;
    use x3wil\CzechStemmer;

    /**
     * strings
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Strings implements \SWAIN\Interfaces\Helpers\Strings {
        // inflector exceptions (singular terms without an accurate result)
        const INFLECTOR_EXCEPTIONS_SINGULAR = [
            "ellipses" => "ellipsis",
            "fezzes" => "fez",
        ];

        // inflector exceptions (plural terms without an accurate result)
        const INFLECTOR_EXCEPTIONS_PLURAL = [
            "fez" => "fezzes",
        ];

        // language detection mode
        const LANGUAGE_DETECT_ALL = 1;

        // stemmer languages
        const STEMMER_LANGUAGES = [
            "ca", "cs", "da", "de", "en",
            "es", "fi", "fr", "it", "nl",
            "no", "pt", "ro", "ru", "sv",
        ];

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
        ): array|false|string {
            $detector = new LanguageDetector();
            $results = $detector->detect($string)->bestResults();

            if (!empty($results)) {
                if ($mode === self::LANGUAGE_DETECT_ALL) {
                    return $results->close();
                } elseif ($mode === self::LANGUAGE_DETECT_CLOSEST) {
                    return $results->__toString();
                }
            }

            return false;
        }

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
        public static function getPlural(string $noun): string {
            static $inflector;

            if (empty($inflector)) {
                $inflector = new Inflector(
                    new CachedWordInflector(new RulesetInflector(InflectorRules::getSingularRuleset())),
                    new CachedWordInflector(new RulesetInflector(InflectorRules::getPluralRuleset()))
                );
            }

            $plural = $inflector->pluralize($noun);

            if (array_key_exists($noun, self::INFLECTOR_EXCEPTIONS_PLURAL)) {
                $plural = self::INFLECTOR_EXCEPTIONS_PLURAL[$noun];
            }

            return $plural;
        }

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
        public static function getRandom(int $size = 30, string $charset = self::CHARACTER_SET_DEFAULT): false|string {
            if ($size > 0) {
                $length = mb_strlen($charset, "UTF-8");
                $string = "";

                for ($i = 0; $i < $size; $i++) {
                    $string .= $charset[mt_rand(1, $length) - 1];
                }

                return $string;
            }

            return false;
        }

        /**
         * returns the estimated reading time for a given string (in minutes)
         * @param string $string the input string
         * @param int $count the number of words per minute (optional)
         * @return false|int the estimated reading time for the given string (in minutes) if successful, false otherwise
         * @example $time = Strings::getReadingTime($input);
         * @example $time = Strings::getReadingTime($input, 250);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getReadingTime(string $string, int $count = 200): false|int {
            return $count > 0 ? intval(ceil(str_word_count(strip_tags($string)) / $count)) : false;
        }

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
        public static function getSingular(string $noun): string {
            static $inflector;

            if (empty($inflector)) {
                $inflector = new Inflector(
                    new CachedWordInflector(new RulesetInflector(InflectorRules::getSingularRuleset())),
                    new CachedWordInflector(new RulesetInflector(InflectorRules::getPluralRuleset()))
                );
            }

            $singular = $inflector->singularize($noun);

            if (array_key_exists($noun, self::INFLECTOR_EXCEPTIONS_SINGULAR)) {
                $singular = self::INFLECTOR_EXCEPTIONS_SINGULAR[$noun];
            }

            return $singular;
        }

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
        public static function getStem(string $word, string $language): false|string {
            if (
                !empty($language) &&
                in_array($language, self::STEMMER_LANGUAGES, true)
            ) {
                if (in_array($language, [
                    "ca", "da", "de", "en", "es",
                    "fi", "fr", "it", "nl", "no",
                    "pt", "ro", "ru", "sv",
                ], true)) {
                    return StemmerFactory::create($language)->stem($word);
                } elseif ($language === "cs") {
                    return (new CzechStemmer())->stemmAgressive($word);
                }
            }

            return false;
        }

        /**
         * returns a given input string in n strips with a given character limit
         * @param string $string the input string
         * @param int $limit the character limit for each strip
         * @return array|false the given string in n strips with the given character limit if successful, false
         * otherwise
         * @example $strips = Strings::getStrips($input, 200);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getStrips(string $string, int $limit): array|false {
            return $limit > 0 ? explode("\n", wordwrap($string, $limit)) : false;
        }

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
        public static function hyphenate(string $string, bool $lowercase = false): false|string {
            if (str_contains($string, " ")) {
                $result = str_replace(" ", "-", preg_replace("#(?<=[a-z])([A-Z])#", "-$0", $string));

                if ($lowercase) {
                    return mb_strtolower($result, "UTF-8");
                }

                return $result;
            }

            return false;
        }

        /**
         * checks if a given string is encoded as base64 or not
         * @param string $string the input string
         * @return bool whether the given string is encoded as base64 or not
         * @example $result = Strings::isBase64($input);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isBase64(string $string): bool {
            return (
                $result = preg_match("/^([A-Za-z\d+\/]{4})*([A-Za-z\d+\/]{3}=|[A-Za-z\d+\/]{2}==)?$/", $string)
            ) !== false && $result > 0;
        }

        /**
         * checks if a given string contains HTML elements in it
         * @param string $string the input string
         * @return bool whether the input string contains HTML elements in it or not
         * @example $result = Strings::isHTML($input);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isHTML(string $string): bool {
            return mb_strlen($string, "UTF-8") !== mb_strlen(strip_tags($string), "UTF-8");
        }

        /**
         * checks whether a given input string is JSON-structured or not
         * @param string $string the input string we want to check
         * @return bool whether the given input string is JSON-structured or not
         * @example $result = Strings::isJSON("sample string");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isJSON(string $string): bool {
            return is_array(json_decode($string, true));
        }

        /**
         * checks if a string is serialized or not
         * @param string $string the string
         * @return bool whether the string is serialized or not
         * @example $result = Strings::isSerialized("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isSerialized(string $string): bool {
            $string = trim($string);

            if ($string === "N;") {
                return true;
            } elseif (strlen($string) >= 4) {
                if ($string[1] === ":") {
                    if (in_array(substr($string, -1), [
                        ";",
                        "}"
                    ], true)) {
                        if (!empty($token = $string[0])) {
                            if (in_array($token, [
                                "s",
                                "a",
                                "O"
                            ], true)) {
                                if ($token === "s") {
                                    if (substr($string, -2, 1) === "\"") {
                                        if (preg_match("/^{$token}:[0-9]+:/s", $string)) {
                                            return true;
                                        }
                                    }
                                } elseif (preg_match("/^{$token}:[0-9]+:/s", $string)) {
                                    return true;
                                }
                            } elseif (in_array($token, [
                                "b",
                                "i",
                                "d"
                            ], true)) {
                                if (preg_match("/^{$token}:[0-9.E-]+;$/", $string)) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }

            return false;
        }

        /**
         * checks whether a given input string is encoded as UTF-8 or not
         * @param string $string the input string we want to check
         * @return bool whether the given input string is encoded as UTF-8 or not
         * @example $result = Strings::isUTF8("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isUTF8(string $string): bool {
            return ($result = preg_match("!!u", $string)) !== false && $result > 0;
        }

        /**
         * checks whether a given string is structured as XML or not
         * @param string $string the string we want to check
         * @return bool whether the given string is structured as XML or not
         * @example $result = Strings::isXML("sample string");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isXML(string $string): bool {
            if (!str_contains($string, "<!DOCTYPE html>")) {
                libxml_use_internal_errors(true);
                simplexml_load_string($string);
                $errors = libxml_get_errors();
                libxml_clear_errors();
                return empty($errors);
            }

            return false;
        }

        /**
         * scrambles a given input string
         * @param string $string the input string
         * @return false|string the scrambled string if successful, the input string otherwise
         * @example $string = Strings::scramble("A quick brown fox jumped over the lazy dog.");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function scramble(string $string): false|string {
            if (!str_contains($string, " ")) {
                $length = mb_strlen($string, "UTF-8");

                if ($length > 2) {
                    return mb_substr($string, 0, 1, "UTF-8") .
                    mb_str_shuffle(mb_substr($string, 1, -1, "UTF-8")) .
                    mb_substr($string, -1, 1, "UTF-8");
                }
            }

            return $string;
        }

        /**
         * converts a given input string to camel case
         * @param string $string the input string
         * @return false|string the input string converted to camel case if successful, false otherwise
         * @example $output = Strings::toCamelCase("foo and bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function toCamelCase(string $string): false|string {
            return str_contains($string, " ") ? lcfirst(str_replace(
                " ",
                "",
                ucwords(str_replace(["-", "_"], " ", $string))
            )) : false;
        }

        /**
         * returns an unaccented (without specific accents or marks) string out of a given string
         * @param string $string the string we want to get normalized
         * @return string the unaccented (without specific accents or marks) string out of the given string
         * @example $string = Strings::unaccent("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function unaccent(string $string): string {
            return strtr($string, [
                "Š" => "S", "š" => "s", "Đ" => "Dj", "đ" => "dj", "Ž" => "Z",
                "ž" => "z", "Č" => "C", "č" => "c", "Ć" => "C", "ć" => "c",
                "À" => "A", "Á" => "A", "Â" => "A", "Ã" => "A", "Ä" => "A",
                "Å" => "A", "Æ" => "A", "Ç" => "C", "È" => "E", "É" => "E",
                "Ê" => "E", "Ë" => "E", "Ì" => "I", "Í" => "I", "Î" => "I",
                "Ï" => "I", "Ñ" => "N", "Ò" => "O", "Ó" => "O", "Ô" => "O",
                "Õ" => "O", "Ö" => "O", "Ø" => "O", "Ù" => "U", "Ú" => "U",
                "Û" => "U", "Ü" => "U", "Ý" => "Y", "Þ" => "B", "ß" => "Ss",
                "à" => "a", "á" => "a", "â" => "a", "ã" => "a", "ä" => "a",
                "å" => "a", "æ" => "a", "ç" => "c", "è" => "e", "é" => "e",
                "ê" => "e", "ë" => "e", "ì" => "i", "í" => "i", "î" => "i",
                "ï" => "i", "ð" => "o", "ñ" => "n", "ò" => "o", "ó" => "o",
                "ô" => "o", "õ" => "o", "ö" => "o", "ø" => "o", "ù" => "u",
                "ú" => "u", "û" => "u", "ü" => "u", "ý" => "y", "þ" => "b",
                "ÿ" => "y", "Ŕ" => "R", "ŕ" => "r"
            ]);
        }
    }