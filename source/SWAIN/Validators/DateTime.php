<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Validators;

    /**
     * date & time
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class DateTime implements \SWAIN\Interfaces\Validators\DateTime {
        /**
         * checks whether a given date is valid or not
         * @param string $input the input date
         * @return bool whether the given date is valid or not
         * @example $result = DateTime::isValid("10/07/2012");
         * @example $result = DateTime::isValid("07/2012");
         * @example $result = DateTime::isValid("2012-07-10");
         * @example $result = DateTime::isValid("2012-07");
         * @example $result = DateTime::isValid("23:17");
         * @example $result = DateTime::isValid("23:17:02");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function isValid(string $input): bool {
            $matches = [];

            if ((
                $result = preg_match("/^(\d{4})[-.\/](\d{1,2})[-.\/](\d{1,2})$/", $input, $matches)
            ) !== false && $result > 0) {

                /**
                 * 2012-07-10
                 * 2012.07.10
                 * 2012/07/10
                 */

                $object = date_create_from_format("Y-m-d", implode("-", [
                    str_pad($matches[1], 4, "0", STR_PAD_LEFT),
                    str_pad($matches[2], 2, "0", STR_PAD_LEFT),
                    str_pad($matches[3], 2, "0", STR_PAD_LEFT)
                ]));

                if ($object !== false) {
                    return $object->format("Y-m-d") === $input ||
                    $object->format("Y-m-j") === $input ||
                    $object->format("Y-n-d") === $input ||
                    $object->format("Y-n-j") === $input ||
                    $object->format("Y/m/d") === $input ||
                    $object->format("Y/m/j") === $input ||
                    $object->format("Y/n/d") === $input ||
                    $object->format("Y/n/j") === $input ||
                    $object->format("Y.m.d") === $input ||
                    $object->format("Y.m.j") === $input ||
                    $object->format("Y.n.d") === $input ||
                    $object->format("Y.n.j") === $input;
                }
            } elseif ((
                $result = preg_match("/^(\d{1,2})[-.\/](\d{1,2})[-.\/](\d{4})$/", $input, $matches)
            ) !== false && $result > 0) {

                /**
                 * 10-07-2012
                 * 10.07.2012
                 * 10/07/2012
                 */

                $object = date_create_from_format("d-m-Y", implode("-", [
                    str_pad($matches[1], 2, "0", STR_PAD_LEFT),
                    str_pad($matches[2], 2, "0", STR_PAD_LEFT),
                    str_pad($matches[3], 4, "0", STR_PAD_LEFT)
                ]));

                if ($object !== false) {
                    return $object->format("d-m-Y") === $input ||
                    $object->format("j-m-Y") === $input ||
                    $object->format("d-n-Y") === $input ||
                    $object->format("j-n-Y") === $input ||
                    $object->format("d/m/Y") === $input ||
                    $object->format("j/m/Y") === $input ||
                    $object->format("d/n/Y") === $input ||
                    $object->format("j/n/Y") === $input ||
                    $object->format("d.m.Y") === $input ||
                    $object->format("j.m.Y") === $input ||
                    $object->format("d.n.Y") === $input ||
                    $object->format("j.n.Y") === $input;
                }
            } elseif ((
                $result = preg_match("/^(\d{4})[-.\/](\d{1,2})$/", $input, $matches)
            ) !== false && $result > 0) {

                /**
                 * 2012-07
                 * 2012/07
                 * 2012.07
                 */

                $object = date_create_from_format("Y-m", implode("-", [
                    str_pad($matches[1], 4, "0", STR_PAD_LEFT),
                    str_pad($matches[2], 2, "0", STR_PAD_LEFT)
                ]));

                if ($object !== false) {
                    return $object->format("Y-m") === $input ||
                    $object->format("Y/m") === $input ||
                    $object->format("Y.m") === $input;
                }
            } elseif ((
                $result = preg_match("/^(\d{1,2})[-.\/](\d{4})$/", $input, $matches)
            ) !== false && $result > 0) {

                /**
                 * 07-2012
                 * 07/2012
                 * 07.2012
                 */

                $object = date_create_from_format("m-Y", implode("-", [
                    str_pad($matches[1], 2, "0", STR_PAD_LEFT),
                    str_pad($matches[2], 4, "0", STR_PAD_LEFT)
                ]));

                if ($object !== false) {
                    return $object->format("m-Y") === $input ||
                    $object->format("m/Y") === $input ||
                    $object->format("m.Y") === $input;
                }
            } elseif (str_contains($input, " ")) {

                /**
                 * 07-2012 23:17
                 * 07/2012 23:17
                 * 07.2012 23:17
                 * 07-2012 23:17:05
                 * 07/2012 23:17:05
                 * 07.2012 23:17:05
                 * 10-07-2012 23:17
                 * 10/07/2012 23:17
                 * 10.07.2012 23:17
                 * 10-07-2012 23:17:05
                 * 10/07/2012 23:17:05
                 * 10.07.2012 23:17:05
                 * 2012-07 23:17
                 * 2012/07 23:17
                 * 2012.07 23:17
                 * 2012-07 23:17:05
                 * 2012/07 23:17:05
                 * 2012.07 23:17:05
                 * 2012-07-10 23:17
                 * 2012/07/10 23:17
                 * 2012.07.10 23:17
                 * 2012-07-10 23:17:05
                 * 2012/07/10 23:17:05
                 * 2012.07.10 23:17:05
                 */

                $input = explode(" ", $input);

                if (count($input) === 2) {
                    return self::isValid($input[0]) && self::isValid($input[1]);
                }
            } else {

                /**
                 * 23:17
                 * 23:17:05
                 */

                return (
                    $result = preg_match("/^([01]?\d|2[0-3]):[0-5]\d:[0-5]\d$/", $input, $matches)
                ) !== false && $result > 0 ||
                (
                    $result = preg_match("/^([01]?\d|2[0-3]):[0-5]\d$/", $input, $matches)
                ) !== false && $result > 0 ||
                (
                    $result = preg_match("/^[0-5]\d:[0-5]\d$/", $input, $matches)
                ) !== false && $result > 0;
            }

            return false;
        }
    }