<?php
    // enforce strict types
    declare(strict_types = 1);

    /**
     * constant definitions
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    // initialize the constant definitions
    $constants = [];

    /**
     * OVERRIDE
     *
     * This constant allows to perform a manual override of the framework preferences. Under normal operation, all
     * preferences are retrieved from the database. With this constant enabled (it's disabled by default), specific
     * preferences can be manually enabled or disabled. If DEBUG is active, a warning will be issued on any document
     * load (as a reminder). Caution, however, is advised for this constant not to be left active on production
     * environments (it's designed as a measure to manually test a given feature on development or testing
     * environments).
     */
    $constants["OVERRIDE"] = true;

    // include other (constant) definitions
    $files = glob(__DIR__ . "/constants/*.php", GLOB_NOSORT);

    if ($files !== false) {
        foreach ($files as $file) {
            include_once($file);
        }
    }

    // register all defined constants
    foreach ($constants as $key => $value) {
        define($key, $value);
    }

    // free all allocated resources
    unset($constants, $file, $files, $key, $value);