<?php
    /**
     * dump
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * DUMP
     *
     * This constant activates the data dump mode, which dumps all template data for debugging and analysis purposes.
     * Provisions must be taken when using this mode in the long run, as it increases log size by a considerable margin.
     *
     * This constant depends on DEBUG being defined.
     */
    $constants["DUMP"] = true;

    if (!$constants["OVERRIDE"]) {
        $constants["DUMP"] = filter_var(
            $constants["framework"]["dump"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }