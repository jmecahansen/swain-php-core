<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Data\Generators;
    use Throwable;

    /**
     * pattern
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Pattern {
        /**
         * constructor for this class
         * @return object an instance of this class
         * @example $generator = new \SWAIN\Data\Generators\Pattern();
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function __construct();

        /**
         * adds a date
         * @param string $format the date format (in ISO 8601 format)
         * @param null|string $input the input date (optional)
         * @return object an instance of this class
         * @example $generator->addDate("Y");
         * @example $generator->addDate("Y-m", "2017-10");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function addDate(string $format, string $input = null): object;

        /**
         * adds a (numerical) sequence
         * @param int $digits the number of digits
         * @param int $start the starting value (optional, 0 by default)
         * @return object an instance of this class
         * @example $generator->addSequence(3);
         * @example $generator->addSequence(3, 215);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function addSequence(int $digits, int $start = 0): object;

        /**
         * adds a string
         * @param string $string the string
         * @return object an instance of this class
         * @example $generator->addString("foo");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public function addString(string $string): object;

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
        public function generate(int $samples = 1): iterable;
    }