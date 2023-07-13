<?php
    /**
     * session
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * SESSION
     *
     * This constant defines the way PHP sessions are handled, and if they are used at all. Different session handlers
     * are available (file, database, redis, memcache, etc.) to use, resorting to file-based storage by default (the
     * usual way PHP stores the session).
     */
    $constants["SESSION"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["SESSION"] = filter_var(
            $constants["framework"]["session"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * SESSION_AUTOSTART
     *
     * This constant defines whether the PHP session is automatically initialized on request or not. When enabled, any
     * incoming request automatically initializes the PHP session so using functions like session_start() is not
     * necessary. Caution must be taken as this is just a way to initialize the PHP session in an automated fashion.
     * Session regeneration or destruction need to be handled as usual.
     *
     * This constant depends on SESSION being enabled.
     */
    $constants["SESSION_AUTOSTART"] = false;

    if (!$constants["OVERRIDE"] && $constants["SESSION"]) {
        $constants["SESSION_AUTOSTART"] = filter_var(
            $constants["framework"]["session/autostart"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * SESSION_HANDLER
     *
     * This constant defines the handler for PHP sessions, which can be managed through files (by default), database and
     * cache servers like Redis or Memcache. Depending on the handler being chosen, SESSION_CONFIGURATION will need to
     * be specified to reflect the specific configuration for such handler.
     *
     * This constant depends on SESSION being enabled.
     */
    $constants["SESSION_HANDLER"] = "files";

    if (!$constants["OVERRIDE"] && $constants["SESSION"]) {
        $constants["SESSION_HANDLER"] = $constants["framework"]["session/handler"];
    }

    /**
     * SESSION_HANDLER_CONFIGURATION
     *
     * This constant defines the specific configuration for PHP session handlers like database and cache servers like
     * Redis or Memcache. When working with the default PHP session handler (file-based), this constant has no use.
     * Structure-wise, it's a JSON-encoded array of configuration values to be passed to the session handler for proper
     * initialization.
     *
     * This constant depends on SESSION_HANDLER being enabled.
     */
    $constants["SESSION_HANDLER_CONFIGURATION"] = "files";

    if (!$constants["OVERRIDE"] && $constants["SESSION_HANDLER"]) {
        $constants["SESSION_HANDLER_CONFIGURATION"] = !empty($constants["framework"]["session/handler/configuration"])
        ? $constants["framework"]["session/handler/configuration"]
        : [];
    }

    /**
     * SESSION_LENGTH_ENCODING
     *
     * This constant defines the number of bits used to encode the PHP session identifier. Allowed values are 4 (0-9,
     * a-f), 5 (0-9, a-v) and 6 (0-9, a-z, A-Z, "-", ","). The more bits are used, the stronger the PHP session
     * identifier will be.
     *
     * This constant depends on SESSION being enabled.
     */
    $constants["SESSION_LENGTH_ENCODING"] = 6;

    if (!$constants["OVERRIDE"] && $constants["SESSION"]) {
        $constants["SESSION_LENGTH_ENCODING"] = $constants["framework"]["session/length/encoding"];
    }

    /**
     * SESSION_LENGTH_ID
     *
     * This constant defines the string length for the PHP session identifier. Length can be anything between 22 and 256
     * characters. By definition, a longer PHP session identifier is harder to guess, but it can also pollute the URL
     * (the maximum recommended size for a URL is 2048 characters not to conflict with old browsers or even search
     * engines) so caution is advised before specifying the value for this constant.
     *
     * This constant depends on SESSION being enabled.
     */
    $constants["SESSION_LENGTH_ID"] = 64;

    if (!$constants["OVERRIDE"] && $constants["SESSION"]) {
        $constants["SESSION_LENGTH_ID"] = $constants["framework"]["session/length/id"];
    }

    /**
     * SESSION_NAME
     *
     * This constant defines the default name for the PHP session identifier. PHP defaults this name to PHPSESSID, but
     * it can be anything as long as there are only alphanumeric characters in it.
     *
     * This constant depends on SESSION being enabled.
     */
    $constants["SESSION_NAME"] = "SID";

    if (!$constants["OVERRIDE"] && $constants["SESSION"]) {
        $constants["SESSION_NAME"] = $constants["framework"]["session/name"];
    }

    /**
     * SESSION_TTL
     *
     * This constant defines the TTL (time-to-live) for the PHP session. This represents the maximum amount of time (in
     * seconds) the PHP session is kept alive before destroying and/or re-creating it. In order for this to work, proper
     * controller logic must be written to enforce such behavior.
     *
     * This constant depends on SESSION being enabled.
     */
    $constants["SESSION_TTL"] = 3600;

    if (!$constants["OVERRIDE"] && $constants["SESSION"]) {
        $constants["SESSION_TTL"] = $constants["framework"]["session/ttl"];
    }