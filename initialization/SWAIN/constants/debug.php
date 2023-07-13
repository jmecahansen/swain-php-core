<?php
    /**
     * debug
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * DEBUG
     *
     * This constant activates the debugging mode, which shows all errors and warnings. Additionally, it saves all
     * important information (SQL queries, error messages, etc.) to the daily log, which is accessible in the /logs
     * folder. Each log entry contains a descriptive message and, for some entries, a set of data objects related to the
     * entry to help in the debug process.
     */
    $constants["DEBUG"] = true;

    if (!$constants["OVERRIDE"]) {
        $constants["DEBUG"] = filter_var(
            $constants["framework"]["debug"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }