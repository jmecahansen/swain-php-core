<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers\PHP;
    use \Throwable;

    /**
     * classes
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Classes {
        /**
         * returns all defined methods which exclusively owns to a given class (not counting inherited ones)
         * @param string $class the class name
         * @return array all defined methods which exclusively owns to a given class (not counting inherited ones)
         * @example $methods = Classes::getOwnMethods(__CLASS__);
         * @example $methods = Classes::getOwnMethods("\\Foo\\Bar");
         * @throws Throwable
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getOwnMethods(string $class): array;
    }