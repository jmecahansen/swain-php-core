<?php
    /**
     * bootstrapping
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * BOOTSTRAP
     *
     * This constant allows to (re-)bootstrap (perform a factory reset) the application, so it (re-)starts with the
     * minimal set of data needed for production release (or to perform a clean (re-)test of the application). Once
     * enabled, it enables a special URL route that, once visited, proceeds to (re-)bootstrap the application. SPECIAL
     * CAUTION must be taken as this constant wipes all existing data (configuration files, database records, stored
     * files and, pretty much, EVERYTHING) and, on the other hand, it's not disabled automatically, so the bootstrapping
     * URL route will remain active until this constant is manually disabled.
     */
    $constants["BOOTSTRAP"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["BOOTSTRAP"] = filter_var(
            $constants["framework"]["bootstrap"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * BOOTSTRAP_ROUTE
     *
     * This constant defines the URL route which allows to (re-)bootstrap the application. extra caution must be taken
     * not to expose or share this URL route as an attacker or third party could use it to reset the application and,
     * thus, destroy all current data.
     *
     * This constant depends on BOOTSTRAP being enabled.
     */
    $constants["BOOTSTRAP_ROUTE"] = false;

    if (!$constants["OVERRIDE"] && $constants["BOOTSTRAP"]) {
        $constants["BOOTSTRAP_ROUTE"] = filter_var(
            $constants["framework"]["bootstrap/route"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }