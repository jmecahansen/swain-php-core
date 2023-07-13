<?php
    /**
     * maintenance
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * MAINTENANCE
     *
     * This constant activates the maintenance mode, where all application activity is put on hold while development or
     * maintenance tasks are executed in order to keep the application up-to-date or apply fixes and/or patches.
     */
    $constants["MAINTENANCE"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["MAINTENANCE"] = filter_var(
            $constants["framework"]["maintenance"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }