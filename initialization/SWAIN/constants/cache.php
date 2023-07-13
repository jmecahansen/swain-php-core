<?php
    /**
     * cache
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * CACHE
     *
     * This constant activates the cache in order to accelerate certain data I/O operations, like database queries.
     * This can be combined with other system-level optimizations like query and opcode caching, CDN content storage and
     * assets compression. Caching works in a non-preemptive fashion, so asking for an uncached resource takes the full
     * computational hit. On a second request, the cache kicks in and the resource is served from it.
     */
    $constants["CACHE"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["CACHE"] = filter_var(
            $constants["framework"]["cache"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_AJAX
     *
     * This constant enables the AJAX cache which stores the data retrieved from AJAX requests, so it is available in
     * subsequent calls. An SHA-1 hash is generated for the AJAX call parameters, so subsequent calls with the same
     * parameters get looked up on the cache and served without firing another request. Data is kept as long as the user
     * session lives or an explicit cache key removal is requested. In any case, caution must be taken as to when to
     * cache (or not to cache) the contents we need for such requests.
     *
     * This constant depends on CACHE being enabled.
     */
    $constants["CACHE_AJAX"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_AJAX"] = filter_var(
            $constants["framework"]["cache/ajax"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_DATA
     *
     * This constant enables the data cache. The use of this constant is recommended as it will provide with a
     * noticeable increase in speed for every request being made because the server won't have to ask for a given piece
     * of data (i.e.: a list of the most recent properties in a real estate application) if it's already cached.
     *
     * This constant depends on CACHE being enabled.
     */
    $constants["CACHE_DATA"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_DATA"] = filter_var(
            $constants["framework"]["cache/data"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_MEDIA
     *
     * This constant enables the cache for media (audio, images and video) files. the use of this constant is
     * recommended in those cases where small data files (audio fragments, thumbnails, etc.) are needed. It's not
     * intended as a replacement for a good media storage strategy but a tool for accelerating the preview of certain
     * media files.
     *
     * This constant depends on CACHE being enabled.
     */
    $constants["CACHE_MEDIA"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_MEDIA"] = filter_var(
            $constants["framework"]["cache/media"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_MEDIA_AUDIO
     *
     * This constant enables the cache for audio files. The use of this constant is recommended if you need to preview
     * or store small audio fragments (like audio sampling for full tracks or text-to-speech, among other uses).
     *
     * This constant depends on CACHE_MEDIA being enabled.
     */
    $constants["CACHE_MEDIA_AUDIO"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE_MEDIA"]) {
        $constants["CACHE_MEDIA_AUDIO"] = filter_var(
            $constants["framework"]["cache/media/audio"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_MEDIA_IMAGES
     *
     * This constant enables the cache for image files. the use of this constant is recommended for scenarios like
     * generating thumbnails, image sets and video previews, among other uses.
     *
     * This constant depends on CACHE_MEDIA being enabled.
     */
    $constants["CACHE_MEDIA_IMAGES"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE_MEDIA"]) {
        $constants["CACHE_MEDIA_IMAGES"] = filter_var(
            $constants["framework"]["cache/media/images"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_MEDIA_VIDEO
     *
     * This constant enables the cache for video files. the use of this constant is recommended if you need to preview
     * video files at a fraction of their original size.
     *
     * This constant depends on CACHE_MEDIA being enabled.
     */
    $constants["CACHE_MEDIA_VIDEO"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE_MEDIA"]) {
        $constants["CACHE_MEDIA_VIDEO"] = filter_var(
            $constants["framework"]["cache/media/video"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_PAGES
     *
     * This constant enables the cache for static HTML pages. The use of this constant is useful only if static content
     * is going to be served. Otherwise, and given the dynamic nature of the application controllers, it's best to leave
     * it disabled.
     *
     * This constant depends on CACHE being enabled.
     */
    $constants["CACHE_PAGES"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_PAGES"] = filter_var(
            $constants["framework"]["cache/pages"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_ROUTES
     *
     * This constant enables the cache for the URL router. the use of this constant is recommended as it will provide
     * with a noticeable increase in speed for every request being made because the URL router must be initialized and
     * look for every URL route definitions (AJAX, API, backend, dynamic, frontend, hooks, SSE, etc.) before matching
     * any URL request.
     *
     * This constant depends on CACHE being enabled.
     */
    $constants["CACHE_ROUTES"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_ROUTES"] = filter_var(
            $constants["framework"]["cache/routes"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_TEMPLATES
     *
     * This constant enables the cache for TWIG templates. The use of this constant is recommended as it will provide
     * with a noticeable increase in speed for every request being made because TWIG won't have to recompile any
     * non-changing (or pre-rendered) element when rendering the HTML output for any given document.
     *
     * This constant depends on CACHE being enabled.
     */
    $constants["CACHE_TEMPLATES"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_TEMPLATES"] = filter_var(
            $constants["framework"]["cache/templates"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_TTL_OVERRIDE
     *
     * This constant allows to override the default (or specific) TTL (time-to-live) for a specific set of keys,
     * allowing for custom caching strategies. When this constant is enabled and the setKey() method is called, the
     * provided key is matched against a set of specific keys (defined in the CACHE_TTL_OVERRIDE_KEYS constant below)
     * and, if a match is found, the specific override value is used instead of the value provided when calling the
     * setKey() method.
     *
     * This constant depends on CACHE being enabled.
     */
    $constants["CACHE_TTL_OVERRIDE"] = false;

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_TTL_OVERRIDE"] = filter_var(
            $constants["framework"]["cache/ttl/override"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * CACHE_TTL_OVERRIDE_KEYS
     *
     * This constant defines those specific cache keys for which their TTL value will be overriden rather than having
     * their default (or assigned) value.
     *
     * This constant depends on CACHE_TTL_OVERRIDE being enabled.
     */
    $constants["CACHE_TTL_OVERRIDE_KEYS"] = [];

    if (!$constants["OVERRIDE"] && $constants["CACHE"]) {
        $constants["CACHE_TTL_OVERRIDE_KEYS"] = filter_var(
            $constants["framework"]["cache/ttl/override/keys"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }