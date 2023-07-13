<?php
    /**
     * sitemaps
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * SITEMAP
     *
     * This constant allows for the application sitemap to be automatically generated. Specific sitemap entries along
     * with those provided by most application modules are put together, classified (if media sitemaps are enabled for
     * images, video or both) and sent in either XML or plain text format. Sitemap limits in terms of maximum size and
     * maximum number of entries per file are handled without the need for manual intervention (sitemap indexes are
     * served in case any limit is reached), along with language selection.
     */
    $constants["SITEMAP"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["SITEMAP"] = filter_var(
            $constants["framework"]["sitemap"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * SITEMAP_MEDIA
     *
     * This constant allows to generate specific versions of the application sitemap for media elements (images and
     * videos). Caution must be taken when enabling this constant along with SITEMAP_TXT as media sitemaps only work
     * with XML sitemaps so, in case both options (XML and plain text sitemaps) are kept, media entries will be sent
     * only for XML sitemaps whereas document URLs can be sent for both.
     *
     * This constant depends on SITEMAP being enabled.
     */
    $constants["SITEMAP_MEDIA"] = false;

    if (!$constants["OVERRIDE"] && $constants["SITEMAP"]) {
        $constants["SITEMAP_MEDIA"] = filter_var(
            $constants["framework"]["sitemap/media"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * SITEMAP_MEDIA_IMAGE
     *
     * This constant allows to generate an application sitemap (in XML format) for images, which helps search engines to
     * find the image content for the application in an easier fashion and increasing the changes for the application
     * images to be included in results when using image search.
     *
     * This constant depends on SITEMAP_MEDIA being enabled.
     */
    $constants["SITEMAP_MEDIA_IMAGE"] = false;

    if (!$constants["OVERRIDE"] && $constants["SITEMAP_MEDIA"]) {
        $constants["SITEMAP_MEDIA_IMAGE"] = filter_var(
            $constants["framework"]["sitemap/media/image"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * SITEMAP_MEDIA_VIDEO
     *
     * This constant allows to generate an application sitemap (in XML format) for videos, which helps search engines to
     * find and parse the video content for the application in an easier fashion.
     *
     * This constant depends on SITEMAP_MEDIA being enabled.
     */
    $constants["SITEMAP_MEDIA_VIDEO"] = false;

    if (!$constants["OVERRIDE"] && $constants["SITEMAP_MEDIA"]) {
        $constants["SITEMAP_MEDIA_VIDEO"] = filter_var(
            $constants["framework"]["sitemap/media/video"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * SITEMAP_TXT
     *
     * This constant allows to generate a plain text version of the application sitemap (in contrast with the XML
     * sitemap, which uses XML markup), which is rarely used nowadays but supported in order to maximize compatibility
     * with different search engines on the internet.
     *
     * This constant depends on SITEMAP being enabled.
     */
    $constants["SITEMAP_TXT"] = false;

    if (!$constants["OVERRIDE"] && $constants["SITEMAP"]) {
        $constants["SITEMAP_TXT"] = filter_var(
            $constants["framework"]["sitemap/txt"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }