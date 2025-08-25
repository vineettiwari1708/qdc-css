<?php
$authKey = 'key';

// List of allowed domains (no trailing slashes)
$allowed_domains = [
    'http://localhost',
];

// Check the secret key
if (!isset($_GET['key']) || $_GET['key'] !== $authKey) {
    http_response_code(403);
    exit('// Forbidden: Invalid key');
}

// Get the origin and referer headers
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$referer_host = $referer ? parse_url($referer, PHP_URL_SCHEME) . '://' . parse_url($referer, PHP_URL_HOST) : '';

// Normalize both
$origin = rtrim($origin, '/');
$referer_host = rtrim($referer_host, '/');

// Validate against allowed domains
$isAllowed = in_array($origin, $allowed_domains) || in_array($referer_host, $allowed_domains);

if (!$isAllowed) {
    http_response_code(403);
    exit('// Forbidden: Unauthorized origin or referer');
}

// Set CORS headers (only if using AJAX)
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

// Serve the JS file
header('Content-Type: application/javascript');

// Use file from GitHub (or replace with local file)
echo file_get_contents('https://raw.githubusercontent.com/vineettiwari1708/box-puzzle-widget/main/puzzle-widget.js');
?>
