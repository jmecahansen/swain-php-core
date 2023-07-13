<?php
    /**
     * compression
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * COMPRESSION
     *
     * This constant activates the compression mode, which compacts all relevant files (CSS, HTML and Javascript) to
     * allow for much shorter resource downloads and, thus, faster delivery of any incoming request.
     *
     * This constant depends on DEBUG being disabled.
     */
    $constants["COMPRESSION"] = !($pagespeed = (function () {
        $output = false;

        if (function_exists("apache_get_modules")) {
            if (in_array("mod_pagespeed", apache_get_modules(), true)) {
                $output = true;
            }
        }

        return $output;
    })());

    if (!$constants["OVERRIDE"]) {
        $constants["COMPRESSION"] = filter_var(
            $constants["framework"]["compression"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * COMPRESSION_CSS
     *
     * This constant activates the CSS compression mode, which compacts all CSS declarations (either in file or source
     * form) to allow for much smaller declarations and, thus, smaller resource downloads and faster interpretation.
     *
     * This constant depends on COMPRESSION being enabled.
     */
    $constants["COMPRESSION_CSS"] = false;

    if (!$constants["OVERRIDE"] && $constants["COMPRESSION"]) {
        $constants["COMPRESSION_CSS"] = filter_var(
            $constants["framework"]["compression/css"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * COMPRESSION_HTML
     *
     * This constant activates the HTML compression mode, which compacts the HTML output to allow for much shorter
     * document delivery.
     *
     * This constant depends on COMPRESSION being enabled.
     */
    $constants["COMPRESSION_HTML"] = false;

    if (!$constants["OVERRIDE"] && $constants["COMPRESSION"]) {
        $constants["COMPRESSION_HTML"] = filter_var(
            $constants["framework"]["compression/html"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * COMPRESSION_JAVASCRIPT
     *
     * This constant activates the Javascript compression mode, which compacts all Javascript code (either in file or
     * source form) to allow for much smaller code and, thus, smaller resource downloads and faster execution.
     *
     * This constant depends on COMPRESSION being enabled.
     */
    $constants["COMPRESSION_JAVASCRIPT"] = false;

    if (!$constants["OVERRIDE"] && $constants["COMPRESSION"]) {
        $constants["COMPRESSION_JAVASCRIPT"] = filter_var(
            $constants["framework"]["compression/javascript"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }