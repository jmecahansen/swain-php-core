<?php
    /**
     * country
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * COUNTRY_DEFAULT
     *
     * This constant defines the default application country.
     */
    $constants["COUNTRY_DEFAULT"] = "es";

    if (!$constants["OVERRIDE"]) {
        $constants["COUNTRY_DEFAULT"] = filter_var(
            $constants["framework"]["country/default"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }