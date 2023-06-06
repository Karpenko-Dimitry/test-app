<?php

if (!function_exists('log_debug')) {
    /**
     * @param $message
     * @param array $context
     * @throws JsonException
     */
    function log_debug($message, array $context = []): void
    {
        logger()->debug(
            is_string($message) ? $message: json_pretty($message), $context
        );
    }
}
