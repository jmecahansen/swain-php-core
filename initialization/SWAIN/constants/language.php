<?php
    /**
     * language
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * LANGUAGE_DEFAULT
     * 
     * This constant defines the default application language.
     */
    $constants["LANGUAGE_DEFAULT"] = "es";

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_DEFAULT"] = filter_var(
            $constants["framework"]["language/default"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * LANGUAGE_AVAILABLE
     * 
     * This constant defines the available languages for the application. Being available and enabled are two different
     * things: the application can have as many languages available as wanted and have only a small subset of them
     * allowed (an application can have the English, German and French languages available but just the German language
     * enabled), so languages defined here must be enabled using the LANGUAGE_ENABLED constant in order to use them.
     * 
     * This constant depends on LANGUAGE_DEFAULT being defined.
     */
    $constants["LANGUAGE_AVAILABLE"] = [$constants["LANGUAGE_DEFAULT"]];

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_AVAILABLE"] = $constants["framework"]["language/available"];
    }

    /**
     * LANGUAGE_ENABLED
     * 
     * This constant defines, among all available application languages, how many of them are actually enabled and,
     * thus, allowed to be used. If you specify more languages to be enabled than they are actually available, any
     * non-matching language is ignored.
     * 
     * This constant depends on LANGUAGE_AVAILABLE being defined.
     */
    $constants["LANGUAGE_ENABLED"] = $constants["LANGUAGE_AVAILABLE"];

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_ENABLED"] = $constants["framework"]["language/enabled"];
    }

    /**
     * LANGUAGE_ENABLED_BACKEND
     * 
     * This constant provides with the ability to have fine-grained control on how many languages are actually enabled
     * for the backend (given that the application has a backend). If This constant is defined, it will be used instead
     * of LANGUAGE_ENABLED and, like the former constant, any non-matching language is ignored.
     */
    $constants["LANGUAGE_ENABLED_BACKEND"] = [];

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_ENABLED_BACKEND"] = $constants["framework"]["language/enabled/backend"];
    }

    /**
     * LANGUAGE_ENABLED_FRONTEND
     * 
     * This constant provides with the ability to have fine-grained control on how many languages are actually enabled
     * for the frontend. If This constant is defined, it will be used instead of LANGUAGE_ENABLED and, like the former
     * constant, any non-matching language is ignored.
     */
    $constants["LANGUAGE_ENABLED_FRONTEND"] = [];

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_ENABLED_FRONTEND"] = $constants["framework"]["language/enabled/frontend"];
    }

    /**
     * LANGUAGE_FALLBACK
     * 
     * This constant provides a cascading language fallback in case the requested language is not active, enabled or
     * existing. The fallback cascade is a multidimensional array with the requested language as the key and the
     * candidate fallback languages as an array ordered by preference (e.g.: ["de" => ["en", "es"]]). for fine-grained
     * control, the LANGUAGE_FALLBACK_BACKEND and LANGUAGE_FALLBACK_FRONTEND constants can be used instead.
     */
    $constants["LANGUAGE_FALLBACK"] = [];

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_FALLBACK"] = $constants["framework"]["language/fallback"];
    }

    /**
     * LANGUAGE_FALLBACK_BACKEND
     * 
     * This constant provides with the ability to have fine-grained control on the cascading language fallback for the
     * backend. If this constant is defined, it will be used instead of LANGUAGE_FALLBACK.
     */
    $constants["LANGUAGE_FALLBACK_BACKEND"] = [];

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_FALLBACK_BACKEND"] = $constants["framework"]["language/fallback/backend"];
    }

    /**
     * LANGUAGE_FALLBACK_FRONTEND
     * 
     * This constant provides with the ability to have fine-grained control on the cascading language fallback for the
     * frontend. If this constant is defined, it will be used instead of LANGUAGE_FALLBACK.
     */
    $constants["LANGUAGE_FALLBACK_FRONTEND"] = [];

    if (!$constants["OVERRIDE"]) {
        $constants["LANGUAGE_FALLBACK_FRONTEND"] = $constants["framework"]["language/fallback/frontend"];
    }

    /**
     * LANGUAGE_MULTIPLE
     * 
     * This constant tells us if there are multiple languages available for the application. It asks the application for
     * any language defined in the LANGUAGE_AVAILABLE constant and, if two or more languages are available, this
     * constant is automatically true. Otherwise, it's false.
     */
    $constants["LANGUAGE_MULTIPLE"] = count($constants["LANGUAGE_AVAILABLE"]) > 1 && (
        count($constants["LANGUAGE_ENABLED"]) > 1 ||
        count($constants["LANGUAGE_ENABLED_FRONTEND"]) > 1 ||
        count($constants["LANGUAGE_ENABLED_BACKEND"]) > 1
    );