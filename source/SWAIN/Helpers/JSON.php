<?php
    // enforce strict types
    declare(strict_types = 1);

    // namespace and/or aliases/imports
    namespace SWAIN\Helpers;

    /**
     * JSON
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */
    class JSON implements \SWAIN\Interfaces\Helpers\JSON {
        // default flags
        const FLAGS_DEFAULT = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE;
    }