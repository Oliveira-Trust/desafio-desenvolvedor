<?php
// Serve the requested resource as-is.
if (file_exists(__DIR__ . '/' . $_SERVER['REQUEST_URI'])) {
    return false;
}

// If no specific file is requested, serve the index.html file.
include_once __DIR__ . '/index.html';