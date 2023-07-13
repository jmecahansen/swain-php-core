<?php
    /**
     * cookies
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * COOKIES
     *
     * This constant enables (or disables) the use of cookies in the application. When disabled, the PHP session
     * identifier will be kept as a parameter in the URL. Careful planning must be performed when using this constant as
     * cookie-dependent applications could stop working or experience some issues if disabled.
     */
    $constants["COOKIES"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["COOKIES"] = filter_var(
            $constants["framework"]["cookies"], FILTER_VALIDATE_BOOLEAN
        ) !== false && filter_var(
            $constants["general"]["cookies"], FILTER_VALIDATE_BOOLEAN
        ) !== false && filter_var(
            $constants["user"]["cookies"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * COOKIES_AUTHENTICATION
     *
     * This constant enables (or disables) the user of cookie-based (pre)authentication. This is designed to offer the
     * ability to log a given user automatically if a special cookie is detected and the selector and validator tokens
     * it contains are properly validated. Extra consideration and caution must be exercised when using this feature as
     * it's not generally recommended to allow for cookie-based (pre)authentication in web applications as it allows for
     * ease of use for end users at (usually) the expense of security.
     *
     * This constant depends on COOKIES being enabled.
     */
    $constants["COOKIES_AUTHENTICATION"] = false;

    if (!$constants["OVERRIDE"] && $constants["COOKIES"]) {
        $constants["COOKIES_AUTHENTICATION"] = filter_var(
            $constants["framework"]["cookies/authentication"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * COOKIES_AUTHENTICATION_BACKEND
     *
     * This constant enables the use of cookie-based (pre)authentication for the application backend.
     *
     * This constant depends on COOKIES_AUTHENTICATION being enabled.
     */
    $constants["COOKIES_AUTHENTICATION_BACKEND"] = false;

    if (!$constants["OVERRIDE"] && $constants["COOKIES_AUTHENTICATION"]) {
        $constants["COOKIES_AUTHENTICATION_BACKEND"] = filter_var(
            $constants["framework"]["cookies/authentication/backend"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * COOKIES_AUTHENTICATION_FRONTEND
     *
     * This constant enables the use of cookie-based (pre)authentication for the application frontend.
     *
     * This constant depends on COOKIES_AUTHENTICATION being enabled.
     */
    $constants["COOKIES_AUTHENTICATION_FRONTEND"] = false;

    if (!$constants["OVERRIDE"] && $constants["COOKIES_AUTHENTICATION"]) {
        $constants["COOKIES_AUTHENTICATION_FRONTEND"] = filter_var(
            $constants["framework"]["cookies/authentication/frontend"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }