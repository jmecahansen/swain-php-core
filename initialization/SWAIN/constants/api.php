<?php
    /**
     * API
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * API
     *
     * This constant provides API access, so remote management and/or data handling can be made available to 3rd party
     * applications or devices. API support depends on the relevant application modules or controllers properly handling
     * API access and the appropriate set of permissions (access tokens and its corresponding ACL entries can be managed
     * from the backend if enabled or implemented).
     */
    $constants["API"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["API"] = filter_var(
            $constants["framework"]["api"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * API_AUTHENTICATION
     *
     * This constant enables API authentication, which demands for every request made to the application to be properly
     * authenticated against a stored set of credentials. without this constant enabled, every request being made to the
     * application will be processed as-is.
     *
     * This constant depends on API being enabled.
     */
    $constants["API_AUTHENTICATION"] = false;

    if (!$constants["OVERRIDE"] && $constants["API"]) {
        $constants["API_AUTHENTICATION"] = filter_var(
            $constants["framework"]["api/authentication"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * API_LIMIT
     *
     * This constant enables API request limits, so control over the amount of requests served can be imposed. without
     * this constant, every request being made to the application will be processed as-is, regardless of available files
     * or any other limiting factor.
     *
     * This constant depends on API being enabled.
     */
    $constants["API_LIMIT"] = false;

    if (!$constants["OVERRIDE"] && $constants["API"]) {
        $constants["API_LIMIT"] = filter_var(
            $constants["framework"]["api/limit"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }