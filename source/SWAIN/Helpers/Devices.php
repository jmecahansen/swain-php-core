<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers;
    use SWAIN\Validators\URL as URL_Validator;
    use Mobile_Detect;

    /**
     * devices
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class Devices implements \SWAIN\Interfaces\Helpers\Devices {
        // device type
        const TYPE_DESKTOP = "desktop";
        const TYPE_MOBILE = "mobile";
        const TYPE_TABLET = "tablet";

        // device OS
        const OS_ANDROID = "android";
        const OS_IOS = "ios";
        const OS_WINDOWS = "windows";

        // device browser
        const BROWSER_CHROME = "chrome";
        const BROWSER_EDGE = "edge";
        const BROWSER_FIREFOX = "firefox";
        const BROWSER_IE = "ie";
        const BROWSER_OPERA = "opera";
        const BROWSER_SAFARI = "safari";

        /**
         * dispatches any devices running a given OS to a given target URL
         * @param string $os the target OS
         * @param string $target the target URL
         * @example Devices::dispatch(Devices::OS_ANDROID, "market://details?id=com.google.android.apps.xxxx");
         * @example Devices::dispatch(Devices::OS_IOS, "https://itunes.apple.com/us/app/xxxx/idxxxx?mt=8");
         * @example Devices::dispatch(Devices::OS_WINDOWS, "http://www.windowsphone.com/en-us/store/app/xxxx/yyyy");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function dispatch(string $os, string $target): void {
            if (
                $os === self::getOS() &&
                (
                    file_exists($target) ||
                    URL_Validator::isValid($target)
                )
            ) {
                terminate_request(function () use ($target) {
                    header("Location: $target");
                });
            }
        }

        /**
         * returns the client browser
         * @return false|string the client browser if successful, false otherwise
         * @example $browser = Devices::getBrowser();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getBrowser(): false|string {
            $device = new Mobile_Detect();

            if ($device->is("Chrome")) {
                return self::BROWSER_CHROME;
            } elseif ($device->is("Edge")) {
                return self::BROWSER_EDGE;
            } elseif ($device->is("Firefox")) {
                return self::BROWSER_FIREFOX;
            } elseif ($device->is("IE")) {
                return self::BROWSER_IE;
            } elseif ($device->is("Opera")) {
                return self::BROWSER_OPERA;
            } elseif ($device->is("Safari")) {
                return self::BROWSER_SAFARI;
            }

            return false;
        }

        /**
         * returns the client browser device
         * @return string the client browser device
         * @example $device = Devices::getDevice();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getDevice(): string {
            $device = new Mobile_Detect();

            if ($device->isMobile()) {
                return self::TYPE_MOBILE;
            } elseif ($device->isTablet()) {
                return self::TYPE_TABLET;
            }

            return self::TYPE_DESKTOP;
        }

        /**
         * returns the client device information
         * @return array the client device information
         * @example $information = Devices::getInformation();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getInformation(): array {
            $device = new Mobile_Detect();
            $information = [
                "type" => self::TYPE_DESKTOP,
            ];

            if ($device->isMobile()) {
                $information["type"] = self::TYPE_MOBILE;
            } elseif ($device->isTablet()) {
                $information["type"] = self::TYPE_TABLET;
            }

            if ($device->is("AndroidOS")) {
                $information["os"] = self::OS_ANDROID;
            } elseif ($device->is("iOS")) {
                $information["os"] = self::OS_IOS;
            } elseif ($device->is("WindowsPhoneOS")) {
                $information["os"] = self::OS_WINDOWS;
            }

            if ($device->is("Chrome")) {
                $information["browser"] = self::BROWSER_CHROME;
            } elseif ($device->is("Edge")) {
                $information["browser"] = self::BROWSER_EDGE;
            } elseif ($device->is("Firefox")) {
                $information["browser"] = self::BROWSER_FIREFOX;
            } elseif ($device->is("IE")) {
                $information["browser"] = self::BROWSER_IE;
            } elseif ($device->is("Opera")) {
                $information["browser"] = self::BROWSER_OPERA;
            } elseif ($device->is("Safari")) {
                $information["browser"] = self::BROWSER_SAFARI;
            }

            return $information;
        }

        /**
         * returns the client browser operating system
         * @return false|string the client browser operating system if successful, false otherwise
         * @example $os = Devices::getOS();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getOS(): false|string {
            $device = new Mobile_Detect();

            if ($device->is("AndroidOS")) {
                return self::OS_ANDROID;
            } elseif ($device->is("iOS")) {
                return self::OS_IOS;
            } elseif ($device->is("WindowsPhoneOS")) {
                return self::OS_WINDOWS;
            }

            return false;
        }
    }