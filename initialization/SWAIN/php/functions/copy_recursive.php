<?php
    /**
     * copy_recursive
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    if (!function_exists("copy_recursive")) {
        /**
         * copy a resource (file or folder (along with its contents)) to a given target path
         * @param string $source the source path
         * @param string $target the target path
         * @param int $permissions the folder permissions
         * @return bool whether the resource was successfully copied or not
         * @example $result = copy_recursive("foo.txt", "/foo/bar/");
         * @example $result = copy_recursive("foo.txt", "/foo/bar/", 2770);
         * @example $result = copy_recursive("/foo/bar", "/foo/baz");
         * @example $result = copy_recursive("/foo/bar", "/foo/baz", 0777);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        function copy_recursive(string $source, string $target, int $permissions = 0755): bool {
            // check for symlinks
            if (
                is_link($source) &&
                !file_exists($target)
            ) {
                return symlink(readlink($source), $target);
            }

            // if it's a file, copy it
            if (is_file($source)) {
                return copy($source, $target);
            }

            // create target directory if it doesn't exist
            if (!is_dir($target)) {
                foreach ([
                    "/cache",
                    "/logs",
                ] as $needle) {
                    if (str_contains($target, $needle)) {
                        $permissions = 0777;
                    }
                }

                mkdir($target, $permissions);
            }

            // traverse the folder
            if (!empty($t = dir($source))) {
                while (!empty($i = $t->read())) {
                    if (in_array($i, [
                        ".",
                        ".."
                    ], true)) {
                        continue;
                    }

                    // make a deep copy
                    copy_recursive("{$source}/{$i}", "{$target}/{$i}", $permissions);
                }

                $t->close();
            }

            return true;
        }
    }