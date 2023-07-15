<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Interfaces\Helpers;

    /**
     * devices
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    interface Devices {
        /**
         * dispatches any devices running a given OS to a given target URL
         * @param string $os the target OS
         * @param string $target the target URL
         * @example Devices::dispatch(Devices::OS_ANDROID, "market://details?id=com.google.android.apps.xxxx");
         * @example Devices::dispatch(Devices::OS_IOS, "https://itunes.apple.com/us/app/xxxx/idxxxx?mt=8");
         * @example Devices::dispatch(Devices::OS_WINDOWS, "http://www.windowsphone.com/en-us/store/app/xxxx/yyyy");
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function dispatch(string $os, string $target): void;

        /**
         * returns the client browser
         * @return false|string the client browser if successful, false otherwise
         * @example $browser = Devices::getBrowser();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getBrowser(): false|string;

        /**
         * returns the client browser device
         * @return string the client browser device
         * @example $device = Devices::getDevice();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getDevice(): string;

        /**
         * returns the client device information
         * @return array the client device information
         * @example $information = Devices::getInformation();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getInformation(): array;

        /**
         * returns the client browser operating system
         * @return false|string the client browser operating system if successful, false otherwise
         * @example $os = Devices::getOS();
         * @composer "mobiledetect/mobiledetectlib": "3.*"
         * @author Julio María Meca Hansen <jmecahansen@gmail.com>
         */
        public static function getOS(): false|string;
    }