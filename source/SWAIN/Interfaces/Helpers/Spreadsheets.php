<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers;
    use \Throwable;
    use \Traversable;

    /**
     * spreadsheets
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Spreadsheets {
        /**
         * imports a block of data from a given file
         * @param string $file the input file
         * @param int|null $index the sheet index (optional, 0-based)
         * @return Traversable a traversable object for the block of data
         * @example $data = Spreadsheets::fromFile("/foo.csv");
         * @example $data = Spreadsheets::fromFile("/foo.csv", 2);
         * @throws Throwable
         * @composer "openspout/openspout": "v4.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function fromFile(string $file, int $index = null): Traversable;

        /**
         * outputs a block of data to a CSV file
         * @param array $data the block of data
         * @param string $file the output CSV file
         * @return bool whether the block of data was successfully written to the given CSV file or not
         * @example $result = Spreadsheets::toCSV([
         *     ["foo", "bar"],
         *     ["baz", "bax"]
         * ], "/foo.csv");
         * @throws Throwable
         * @composer "openspout/openspout": "v4.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function toCSV(array $data, string $file): bool;

        /**
         * outputs a block of data to an ODS file
         * @param array $data the block of data
         * @param string $file the output ODS file
         * @return bool whether the block of data was successfully written to the given ODS file or not
         * @example $result = Spreadsheets::toODS([
         *     ["foo", "bar"],
         *     ["baz", "bax"]
         * ], "/foo.ods");
         * @throws Throwable
         * @composer "openspout/openspout": "v4.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function toODS(array $data, string $file): bool;

        /**
         * outputs a block of data to an XLSX (Excel) file
         * @param array $data the block of data
         * @param string $file the output XLSX (Excel) file
         * @return bool whether the block of data was successfully written to the given XLSX (Excel) file or not
         * @example $result = Spreadsheets::toXLSX([
         *     ["foo", "bar"],
         *     ["baz", "bax"]
         * ], "/foo.xlsx");
         * @throws Throwable
         * @composer "openspout/openspout": "v4.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function toXLSX(array $data, string $file): bool;
    }