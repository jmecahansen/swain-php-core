<?php
    /**
     * timelapse
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * TIMELAPSE
     *
     * This constant enables the timelapse mode, which allows to load any given document and show its contents as if
     * they were being viewed at a given specific date. Applying this allows to go back and forth in time
     * (content-wise). As this constant is just intentional, proper controller logic must be written to enforce this.
     */
    $constants["TIMELAPSE"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["TIMELAPSE"] = filter_var(
            $constants["framework"]["timelapse"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }
