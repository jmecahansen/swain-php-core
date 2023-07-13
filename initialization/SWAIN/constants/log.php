<?php
    /**
     * log
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    /**
     * LOG
     * 
     * This constant enables application logging, which saves all important information (SQL queries, error messages,
     * etc.) to the daily log, which is accessible in the /logs folder. Each log entry contains a descriptive message
     * and, for some entries, a set of data objects related to the entry. In contrast with the DEBUG constant, this one
     * just implements application logging. no exceptions or special conditions apply when this constant is in use.
     */
    $constants["LOG"] = false;

    if (!$constants["OVERRIDE"]) {
        $constants["LOG"] = filter_var(
            $constants["framework"]["log"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * LOG_BACKUP
     * 
     * This constant enables log files backup (log files are not backed up by default). When enabled, existing log files
     * are packed, compressed and stored using a specific storage driver (or a set of them if multiple storage handlers
     * are required).
     * 
     * This constant depends on LOG being enabled.
     */
    $constants["LOG_BACKUP"] = false;

    if (!$constants["OVERRIDE"] && $constants["LOG"]) {
        $constants["LOG_BACKUP"] = filter_var(
            $constants["framework"]["log/backup"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * LOG_BACKUP_STORAGE
     * 
     * This constant specifies which storage driver is going to be used to handle the log backups. As the log backup
     * storage is provided by the storage service, any driver (or a combination of them) can be used.
     * The LOG_BACKUP_STORAGE_CONFIGURATION constant is also needed to provide the specific configuration for the driver
     * (or each of them, if multiple drivers are specified).
     * 
     * This constant depends on LOG_BACKUP being enabled.
     */
    $constants["LOG_BACKUP_STORAGE"] = false;

    if (!$constants["OVERRIDE"] && $constants["LOG_BACKUP"]) {
        $constants["LOG_BACKUP_STORAGE"] = !empty($constants["framework"]["log/backup/storage"])
        ? $constants["framework"]["log/backup/storage"]
        : "Local";
    }

    /**
     * LOG_BACKUP_STORAGE_CONFIGURATION
     * 
     * This constant defines the specific configuration for initializing the driver (or set of drivers) handling the log
     * backup storage. Special care must be taken when providing the configuration options manually as it could lead to
     * broken (or misconfigured) storage drivers and, thus, leave the log backup storage in a non-working status.
     * 
     * This constant depends on LOG_BACKUP_STORAGE being enabled.
     */
    $constants["LOG_BACKUP_STORAGE_CONFIGURATION"] = false;

    if (!$constants["OVERRIDE"] && $constants["LOG_BACKUP_STORAGE"]) {
        $constants["LOG_BACKUP_STORAGE_CONFIGURATION"] = !empty($constants["framework"]["log/backup/storage/configuration"])
        ? $constants["framework"]["log/backup/storage/configuration"]
        : ["path" => $_SERVER["DOCUMENT_ROOT"]];
    }

    /**
     * LOG_BACKUP_STORAGE_DIRECTORY
     * 
     * This constant defines the directory to save the log backup file to. In contrast to the LOG_BACKUP_STORAGE and
     * LOG_BACKUP_STORAGE_CONFIGURATION constants, you can define a single value here in order to keep consistency
     * between storage drivers.
     * 
     * This constant depends on LOG_BACKUP_STORAGE being enabled.
     */
    $constants["LOG_BACKUP_STORAGE_DIRECTORY"] = false;

    if (!$constants["OVERRIDE"] && $constants["LOG_BACKUP_STORAGE"]) {
        $constants["LOG_BACKUP_STORAGE_DIRECTORY"] = !empty($constants["framework"]["log/backup/storage/directory"])
        ? $constants["framework"]["log/backup/storage/directory"]
        : "/logs/backup";
    }

    /**
     * LOG_CLEAN
     * 
     * This constant enables log files removal (log files are not removed by default). A maximum log file age can be
     * specified with the LOG_CLEAN_AGE constant. When active, the application will scan the /logs folder every minute
     * for log files exceeding the maximum log file age, cleaning (deleting) them.
     * 
     * This constant depends on LOG being enabled.
     */
    $constants["LOG_CLEAN"] = false;

    if (!$constants["OVERRIDE"] && $constants["LOG"]) {
        $constants["LOG_CLEAN"] = filter_var(
            $constants["framework"]["log/clean"], FILTER_VALIDATE_BOOLEAN
        ) !== false;
    }

    /**
     * LOG_CLEAN_AGE
     * 
     * This constant defines the maximum log file age (in seconds). Once the LOG_CLEAN constant is active, the
     * application will scan the /logs folder every minute. Any log file whose age is bigger than the value defined in
     * this constant will be cleaned (deleted).
     * 
     * This constant depends on LOG_CLEAN being enabled.
     */
    $constants["LOG_CLEAN_AGE"] = false;

    if (!$constants["OVERRIDE"] && $constants["LOG_CLEAN"]) {
        $constants["LOG_CLEAN_AGE"] = $constants["framework"]["log/clean/age"];
    }