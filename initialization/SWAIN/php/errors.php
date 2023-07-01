<?php
    /**
     * errors
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    // report all errors, notifications and warnings
    error_reporting(E_ALL);

    // show errors, notifications and warnings but ONLY in debug mode
    ini_set("display_errors", constant("DEBUG"));

    // set the default error log file
    ini_set("error_log", "{$_SERVER["DOCUMENT_ROOT"]}/logs/" . date("Y-m-d") . "-php.log");