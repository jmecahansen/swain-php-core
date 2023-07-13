<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers\PHP;

    /**
     * documentation
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Documentation {
        /**
         * returns all defined comment blocks from a given source block
         * @param string $source the source block
         * @return array all defined comment blocks from the given source
         * @example $blocks = Documentation::getBlocks($source);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getBlocks(string $source): array;

        /**
         * returns all defined metadata elements for a given comment block
         * @param string $block the comment block
         * @return array all defined metadata elements for the given comment block
         * @example $metadata = Documentation::getMetadata($block);
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getMetadata(string $block): array;
    }