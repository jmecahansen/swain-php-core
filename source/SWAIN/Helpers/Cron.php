<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers;
    use CronLingo\CronLingo;
    use SWAIN\Helpers\PHP\Documentation;
    use SWAIN\Validators\Cron as Cron_Validator;

    /**
     * periodic job (cron job)
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Cron implements \SWAIN\Interfaces\Helpers\Cron {
        /**
         * outputs all defined jobs as a file
         * @param array $jobs the list of periodic jobs
         * @param string $file the output file
         * @return bool whether all defined jobs where successfully written to the output file or not
         * @example $string = Cron::asFile([
         *     "/foo" => "0 4 15-21 * 1"
         * ], "/foo/bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function asFile(array $jobs, string $file): bool {
            if (
                !empty($jobs) &&
                is_writable(dirname($file)) &&
                !empty($output = self::asString($jobs))
            ) {
                return ($result = file_put_contents($file, $output)) !== false && $result > 0;
            }

            return false;
        }

        /**
         * outputs all defined jobs as a string
         * @param array $jobs the list of periodic jobs
         * @return false|string all defined jobs as a string if successful, false otherwise
         * @example $string = Cron::asString([
         *     "/foo" => "0 4 15-21 * 1"
         * ], "/foo/bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function asString(array $jobs): false|string {
            if (!empty($jobs = array_filter($jobs, function ($i) {
                return Cron_Validator::isValid($i);
            }))) {
                $length = max(array_map("strlen", $jobs));
                $lines = [];

                foreach ($jobs as $file => $expression) {
                    $lines[] = implode("\t", [str_pad($expression, $length), "php {$file}"]) . PHP_EOL;
                }

                return implode($lines);
            }

            return false;
        }

        /**
         * extracts the cron expression from a given file
         * @param string $file the file
         * @return false|string the cron expression if successful, false otherwise
         * @example $expression = Cron::fromFile("/foo/bar");
         * @composer "ajbdev/cronlingo": "v0.1.1"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function fromFile(string $file): false|string {
            if (file_exists($file)) {
                $source = file_get_contents($file);

                if (
                    !empty($blocks = Documentation::getBlocks($source)) &&
                    !empty($metadata = Documentation::getMetadata($blocks[0])) &&
                    !empty($metadata["parameters"]["cron"])
                ) {
                    return CronLingo::fromExpression($metadata["parameters"]["cron"][0]);
                }
            }

            return false;
        }
    }