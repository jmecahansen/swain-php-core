<?php
    /**
     * rmdir_recursive
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("rmdir_recursive")) {
        /**
         * removes a directory along with its contents recursively
         * @param string $target the target directory
         * @return bool whether the directory was successfully removed or not
         * @example $result = rmdir_recursive("/foo/bar");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function rmdir_recursive(string $target): bool {
            if (
                !empty($target) &&
                !empty($handler = opendir($target))
            ) {
                while (!empty($entry = readdir($handler))) {
                    if (!in_array($entry, [
                        ".",
                        ".."
                    ], true)) {
                        $entry = "{$target}/{$entry}";

                        if (!is_dir($entry)) {
                            unlink($entry);
                        } else {
                            rmdir_recursive($entry);
                        }
                    }
                }

                closedir($handler);
                rmdir($target);
                return true;
            }

            return false;
        }
    }