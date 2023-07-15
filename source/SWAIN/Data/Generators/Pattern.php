<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Data\Generators;
    use \SWAIN\Helpers\Strings;
    use \SWAIN\Validators\DateTime;
    use Throwable;

    /**
     * pattern
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Pattern implements \SWAIN\Interfaces\Data\Generators\Pattern {
        /**
         * @var array $properties generator properties
         */
        private array $properties;

        // pattern element type
        const TYPE_DATE = 1;
        const TYPE_SEQUENCE = 2;
        const TYPE_STRING = 3;
        const TYPE_STRING_RANDOM = 4;

        /**
         * constructor for this class
         * @return object an instance of this class
         * @example $generator = new \SWAIN\Data\Generators\Pattern();
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function __construct() {
            $this->properties["elements"] = [];
            return $this;
        }

        /**
         * adds a date
         * @param string $format the date format (in ISO 8601 format)
         * @param null|string $input the input date (optional)
         * @return object an instance of this class
         * @example $generator->addDate("Y");
         * @example $generator->addDate("Y-m", "2017-10");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function addDate(string $format, string $input = null): object {
            if (!empty($format)) {
                $this->properties["elements"][] = array_filter([
                    "type" => self::TYPE_DATE,
                    "format" => $format,
                    "input" => DateTime::isValid($input) ? $input : null,
                ]);
            }

            return $this;
        }

        /**
         * adds a random string
         * @return object an instance of this class
         * @example $generator->addRandomString();
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function addRandomString(): object {
            $this->properties["elements"][] = [
                "type" => self::TYPE_STRING_RANDOM,
            ];

            /**
             * @todo complete the addRandomString() method
             */

            return $this;
        }

        /**
         * adds a (numerical) sequence
         * @param int $digits the number of digits
         * @param int $start the starting value (optional, 0 by default)
         * @return object an instance of this class
         * @example $generator->addSequence(3);
         * @example $generator->addSequence(3, 215);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function addSequence(int $digits, int $start = 0): object {
            if (filter_var($digits, FILTER_VALIDATE_INT) !== false) {
                $this->properties["elements"][] = array_filter([
                    "type" => self::TYPE_SEQUENCE,
                    "digits" => $digits,
                    "start" => $start > 0 ? $start : null
                ]);
            }

            return $this;
        }

        /**
         * adds a string
         * @param string $string the string
         * @return object an instance of this class
         * @example $generator->addString("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function addString(string $string): object {
            if (!empty($string)) {
                $this->properties["elements"][] = [
                    "type" => self::TYPE_STRING,
                    "content" => $string
                ];
            }

            return $this;
        }

        /**
         * generates a sample (or set of samples)
         * @param int $samples the number of samples to generate (optional, one by default)
         * @return iterable an iterator for the sample (or set of samples)
         * @example $samples = (array) $generator->generate();
         * @example $samples = (array) $generator->generate(10);
         * @example foreach ($generator->generate(10) as $sample) {
         *     $code = $sample;
         * }
         * @throws Throwable
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function generate(int $samples = 1): iterable {
            if ($samples > 0) {
                for ($i = 0; $i < $samples; $i++) {
                    $sample = null;

                    foreach ($this->properties["elements"] as $element) {
                        if ($element["type"] === self::TYPE_DATE) {
                            $timezone = new \DateTimeZone(date_default_timezone_get());

                            if (!empty($element["input"])) {
                                $sample .= date_create_from_format(
                                    $element["format"],
                                    $element["input"],
                                    $timezone
                                )->format($element["format"]);
                            } else {
                                $sample .= date_create(
                                    "now",
                                    $timezone
                                )->format($element["format"]);
                            }
                        } elseif ($element["type"] === self::TYPE_SEQUENCE) {
                            $sample .= str_pad($element["start"] + $i, $element["digits"], "0", STR_PAD_LEFT);
                        } elseif ($element["type"] === self::TYPE_STRING) {
                            $sample .= $element["content"];
                        } elseif ($element["type"] === self::TYPE_STRING_RANDOM) {
                            if (!empty($element["content"])) {
                                if (!empty($element["length"])) {
                                    if (filter_var($element["length"], FILTER_VALIDATE_INT) !== false) {
                                        if ($element["content"] === "numeric") {
                                            if (!empty($element["range"])) {
                                                if (is_array($element["range"])) {
                                                    $output .= mt_rand(0, pow(10, $element["length"]));
                                                }
                                            } else {
                                                $output .= mt_rand(current($element["range"]), next($element["range"]));
                                            }
                                        } elseif ($element["content"] === "string") {
                                            $output .= Strings::getRandom($element["length"]);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    yield $sample;
                }
            }
        }
    }