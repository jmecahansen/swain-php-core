<?php
    /**
     * file_pipe
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("file_pipe")) {
        /**
         * pipe the contents of a given file into another
         * @param string $source the source file
         * @param string $target the target file
         * @param bool whether to overwrite the target file if it exists (optional, false by default)
         * @return bool whether the piping operation was successful or not
         * @example $result = file_pipe("/path/foo", "/path/bar");
         * @example $result = file_pipe("/path/foo", "/path/bar", true);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function file_pipe(string $source, string $target, bool $overwrite = false): bool {
            if (file_exists($source)) {
                if (!empty($a = fopen($source, "r"))) {
                    if (
                        $overwrite === true ||
                        !file_exists($target) ||
                        filesize($target) === 0
                    ) {
                        if (!empty($b = fopen($target, "w"))) {
                            if (stream_copy_to_stream($a, $b) > 0) {
                                return true;
                            }

                            fclose($b);
                        }
                    }

                    fclose($a);
                }
            }

            return false;
        }
    }