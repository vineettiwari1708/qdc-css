<?php
$authKey = 'key'; // Replace 'key' with your actual key

// Check the secret key
if (!isset($_GET['key']) || $_GET['key'] !== $authKey) {
    http_response_code(403);
    exit('/* Forbidden: Invalid key */');
}

// Set CORS headers (for AJAX or browser security) if needed
header("Access-Control-Allow-Origin: *");  // Allow all origins
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Serve the CSS file
header('Content-Type: text/css');

// GitHub raw CSS file URL
$css_url = 'https://raw.githubusercontent.com/vineettiwari1708/qdc-css/main/style.css';

// Output the file content
echo file_get_contents($css_url);
?>
