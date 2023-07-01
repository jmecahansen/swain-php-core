<?php
    /**
     * variables
     * @author Julio María Meca Hansen <jmecahansen@gmail.com>
     */

    // retrieve the HTTP (DELETE, PATCH, PUT, etc.) request variable
    if (
        !empty($_SERVER["REQUEST_METHOD"]) &&
        !in_array($_SERVER["REQUEST_METHOD"], [
            "GET",
            "POST"
        ], true)
    ) {
        parse_str(file_get_contents("php://input"), ${"_{$_SERVER["REQUEST_METHOD"]}"});
    }