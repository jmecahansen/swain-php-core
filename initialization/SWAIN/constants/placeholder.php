<?php
    /**
     * placeholder
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * PLACEHOLDER
     *
     * This constant activates the placeholder mode, which allows for the site to be deployed with a minimal set of
     * assets so development can take place under the hood while potential visitors take a first look at the
     * application.
     */
    $constants["PLACEHOLDER"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["PLACEHOLDER"] = filter_var(
            $constants["framework"]["placeholder"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * PLACEHOLDER_AUTHENTICATION
     *
     * This constant defines the HTTP authentication method to use (basic or digest) when using the placeholder mode.
     * Caution must be taken when choosing the authentication method as basic authentication provides no encryption
     * mechanism for credentials rather than being base64-encoded, whereas digest authentication applies a hash
     * function. Digest authentication is the preferred way of handling HTTP authentication and, thus, the default
     * placeholder authentication method.
     *
     * This constant depends on PLACEHOLDER being enabled.
     */
    $constants["PLACEHOLDER_AUTHENTICATION"] = "digest";

    if (!$constants["OVERRIDE"]) {
        $constants["PLACEHOLDER_AUTHENTICATION"] = $constants["framework"]["placeholder/authentication"];
    }