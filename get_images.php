<?php
$compressed_path = "img/compressed/";

// Get the requested file from the query string
$file = $_GET['file'] ?? null;

// Get and sort all image files in the folder
$files = scandir($compressed_path);
natsort($files); // Ensure consistent order
$files = array_values(array_filter($files, function($f) use ($compressed_path) {
    return in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), ["jpg", "jpeg", "png", "gif"]);
}));

// Reorder the list to start with the requested file
if ($file) {
    $basename = basename($file); // Extract just the file name
    $current_index = array_search($basename, $files); // Find the index of the requested file
    if ($current_index !== false) {
        $files = array_merge(
            array_slice($files, $current_index), // Start from the requested file
            array_slice($files, 0, $current_index) // Add the rest of the files
        );
    }
}

// Return the reordered list with full paths
header('Content-Type: application/json');
echo json_encode(['files' => array_map(function($f) use ($compressed_path) {
    return $compressed_path . $f;
}, $files)]);
