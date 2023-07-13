<?php
    /**
     * database
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * DATABASE
     *
     * This constant provides with advanced features for database operation, like table and field name hashing (for
     * increased security), row locking, soft record deletion and record history. each feature has its pros and cons, so
     * proper planning must be done to ensure every enabled feature will work as expected (data usage and performance-
     * wise).
     */
    $constants["DATABASE"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["DATABASE"] = filter_var(
            $constants["framework"]["database"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * DATABASE_DELETION
     *
     * This constant activates the virtual deletion mode, which overrides the way records are deleted from the database.
     * Instead of deleting a given record from the database, it marks it as deleted so any related database query will
     * not take this record into account. Deletion for any record with a dependency on this given record (i.e.:
     * translation contents, references, etc.) will be ignored under this mode as the given record will not really be
     * deleted (just marked as deleted).
     *
     * This constant depends on DATABASE being enabled.
     */
    $constants["DATABASE_DELETION"] = false;

    if (!$constants["OVERRIDE"] && $constants["DATABASE"]) {
        $constants["DATABASE_DELETION"] = filter_var(
            $constants["framework"]["database/deletion"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * DATABASE_ENCRYPTION
     *
     * This constant enables the use of encryption to store and retrieve information from the database. Not every single
     * field has to be encrypted but for those where encryption is necessary to protect sensitive information the
     * database will transparently handle them. Really careful planning must be done as encryption and/or decryption
     * comes at the price of performance when storing/retrieving information to/from the database but also at the time
     * of running queries against the database related (mainly) to data models.
     *
     * This constant depends on DATABASE being enabled.
     */
    $constants["DATABASE_ENCRYPTION"] = false;

    if (!$constants["OVERRIDE"] && $constants["DATABASE"]) {
        $constants["DATABASE_ENCRYPTION"] = filter_var(
            $constants["framework"]["database/encryption"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * DATABASE_HASHES
     *
     * This constant enables obfuscation of tables and fields by hashing them with a flexible set of encoding methods.
     * This process is reversible, so it can be enabled or disabled at will. Hashing can be done once or many times,
     * whether its process is left to be done automatically or on demand. Careful planning must be done as this constant
     * doesn't make the database queries slower, but it makes every table and field unreadable for direct inspection.
     *
     * This constant depends on DATABASE being enabled.
     */
    $constants["DATABASE_HASHES"] = false;

    if (!$constants["OVERRIDE"] && $constants["DATABASE"]) {
        $constants["DATABASE_HASHES"] = filter_var(
            $constants["framework"]["database/hashes"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * DATABASE_HISTORY
     *
     * This constant activates the database history mode, which records all changes (insert, delete and update) applied
     * to all application modules and related database tables, allowing for data correction and forensics if needed.
     * Disk space provisions must be considered when using this mode, as disk usage increases with each recorded change.
     *
     * This constant depends on DATABASE being enabled.
     */
    $constants["DATABASE_HISTORY"] = false;

    if (!$constants["OVERRIDE"] && $constants["DATABASE"]) {
        $constants["DATABASE_HISTORY"] = filter_var(
            $constants["framework"]["database/history"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * DATABASE_HISTORY_DEPTH
     *
     * This constant defines how many levels of database record history are going to be kept. there's not a standard
     * recommendation about setting this constant to a given exact value. It's 5 levels by default and there's no limit
     * but each level adds further database space consumption, so caution and some provisions must be taken when setting
     * the value for this constant.
     *
     * This constant depends on DATABASE_HISTORY being enabled.
     */
    $constants["DATABASE_HISTORY_DEPTH"] = 5;

    if (!$constants["OVERRIDE"] && $constants["DATABASE_HISTORY"]) {
        $constants["DATABASE_HISTORY_DEPTH"] = $constants["framework"]["database/history/depth"];
    }