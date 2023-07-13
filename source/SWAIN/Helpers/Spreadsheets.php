<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers;
    use OpenSpout\Common\Entity\Row;
    use OpenSpout\Reader\Common\Creator\ReaderFactory;
    use OpenSpout\Writer\Common\Creator\WriterFactory;
    use Throwable;
    use Traversable;

    /**
     * spreadsheets
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Spreadsheets implements \SWAIN\Interfaces\Helpers\Spreadsheets {
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
        public static function fromFile(string $file, int $index = null): Traversable {
            if (file_exists($file)) {
                $reader = ReaderFactory::createFromFile($file);
                $reader->open($file);

                foreach ($reader->getSheetIterator() as $sheet) {
                    $traverse = false;

                    if (is_null($index) || (
                        $index >= 0 &&
                        $index === $sheet->getIndex()
                    )) {
                        $traverse = true;
                    }

                    if ($traverse) {
                        foreach ($sheet->getRowIterator() as $row) {
                            yield $row->toArray();
                        }
                    }
                }

                $reader->close();
            }
        }

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
        public static function toCSV(array $data, string $file): bool {
            if (
                !empty($data) &&
                !empty($file) &&
                str_ends_with($file, ".csv")
            ) {
                $writer = WriterFactory::createFromFile($file);
                $writer->openToFile($file);

                foreach ($data as $row) {
                    $writer->addRow(Row::fromValues($row));
                }

                $writer->close();
                return true;
            }

            return false;
        }

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
        public static function toODS(array $data, string $file): bool {
            if (
                !empty($data) &&
                !empty($file) &&
                str_ends_with($file, ".ods")
            ) {
                $writer = WriterFactory::createFromFile($file);
                $writer->openToFile($file);

                foreach ($data as $row) {
                    $writer->addRow(Row::fromValues($row));
                }

                $writer->close();
                return true;
            }

            return false;
        }

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
        public static function toXLSX(array $data, string $file): bool {
            if (
                !empty($data) &&
                !empty($file) &&
                str_ends_with($file, ".xlsx")
            ) {
                $writer = WriterFactory::createFromFile($file);
                $writer->openToFile($file);

                foreach ($data as $row) {
                    $writer->addRow(Row::fromValues($row));
                }

                $writer->close();
                return true;
            }

            return false;
        }
    }