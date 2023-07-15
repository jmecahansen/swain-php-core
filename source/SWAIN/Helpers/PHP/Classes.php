<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers\PHP;
    use \Throwable;

    /**
     * classes
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Classes implements \SWAIN\Interfaces\Helpers\PHP\Classes {
        /**
         * returns all defined methods which exclusively owns to a given class (not counting inherited ones)
         * @param string $class the class name
         * @return array all defined methods which exclusively owns to a given class (not counting inherited ones)
         * @example $methods = Classes::getOwnMethods(__CLASS__);
         * @example $methods = Classes::getOwnMethods("\\Foo\\Bar");
         * @throws Throwable
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getOwnMethods(string $class): array {
            $reflector = new \ReflectionClass($class);

            if (!empty($methods = array_filter(
                $reflector->getMethods(\ReflectionMethod::IS_PUBLIC),
                function ($i) use ($class) {
                    return strtolower($i->class) === strtolower($class);
                }
            ))) {
                return array_map(function ($i) {
                    return $i->name;
                });
            }
        }
    }