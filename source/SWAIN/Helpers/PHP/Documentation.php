<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers\PHP;

    /**
     * documentation
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Documentation implements \SWAIN\Interfaces\Helpers\PHP\Documentation {
        /**
         * returns all defined comment blocks from a given source block
         * @param string $source the source block
         * @return array all defined comment blocks from the given source
         * @example $blocks = Documentation::getBlocks($source);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getBlocks(string $source): array {
            if (!empty($source)) {
                set_time_limit(0);
                $tokens = token_get_all($source);

                if (!empty($comments = array_filter($tokens, function ($i) {
                    return ($i[0] === T_DOC_COMMENT);
                }))) {
                    return array_map(function ($i) {
                        return $i[1];
                    }, $comments);
                }
            }

            return [];
        }

        /**
         * returns all defined metadata elements for a given comment block
         * @param string $block the comment block
         * @return array all defined metadata elements for the given comment block
         * @example $metadata = Documentation::getMetadata($block);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getMetadata(string $block): array {
            if (!empty($block)) {
                $metadata = [];

                foreach (explode(PHP_EOL, $block) as $line) {
                    if (
                        preg_match("/^(?=\s+?\*[^\/])(.+)/", $line, $m1) !== false &&
                        !empty($m1)
                    ) {
                        $line = preg_replace("/^(\*\s+?)/", "", trim($m1[1]));

                        if (!is_null($line)) {
                            if ($line[0] !== "@") {
                                $metadata["description"][] = $line;
                            } elseif (
                                preg_match("/@(\w+)/", $line, $m2) !== false &&
                                !empty($m2) &&
                                !empty($value = str_replace("@{$m2[1]}", "", $line))
                            ) {
                                $metadata["parameters"][$m2[1]][] = $value;
                            }
                        }
                    }
                }

                return $metadata;
            }

            return [];
        }
    }