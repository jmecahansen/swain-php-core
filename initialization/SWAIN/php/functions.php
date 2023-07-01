<?php
    /**
     * built-in functions
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    // include other (constant) definitions
    $files = glob(__DIR__ . "/functions/*.php", GLOB_NOSORT);

    if ($files !== false) {
        foreach ($files as $file) {
            include_once($file);
        }
    }

    // free all allocated resources
    unset($file, $files);