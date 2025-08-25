<?php
$authKey = '49568'; // Replace 'key' with your actual key

// List of allowed domains (no trailing slashes)
$allowed_domains = [
    'https://quintedriving.ca/',
];

// Check the secret key
if (!isset($_GET['key']) || $_GET['key'] !== $authKey) {
    http_response_code(403);
    exit('/* Forbidden: Invalid key */');
}

// Get origin and referer
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$referer_host = $referer ? parse_url($referer, PHP_URL_SCHEME) . '://' . parse_url($referer, PHP_URL_HOST) : '';

// Normalize
$origin = rtrim($origin, '/');
$referer_host = rtrim($referer_host, '/');

// Check if origin/referer is allowed
$isAllowed = in_array($origin, $allowed_domains) || in_array($referer_host, $allowed_domains);

if (!$isAllowed) {
    http_response_code(403);
    exit('/* Forbidden: Unauthorized origin or referer */');
}

// Set CORS headers (for AJAX or browser security)
if ($origin && in_array($origin, $allowed_domains)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
}

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Serve the CSS file
header('Content-Type: text/css');

// GitHub raw CSS file URL
$css_url = 'https://raw.githubusercontent.com/vineettiwari1708/qdc-css/main/qdc.css';

// Output the file content
echo file_get_contents($css_url);
?>
