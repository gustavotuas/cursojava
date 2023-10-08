<?php

//$repositoryPath = '/var/www/html/Java-Course';
//$branch = 'master';

// Get the request data
$data = json_decode(file_get_contents("php://input"));

// Verify that the payload is from GitHub (optional, but recommended)
$secret = "GitHubDigitalOceanSecret"; // Replace with your secret
$hubSignature = $_SERVER['HTTP_X-Hub-Signature'] ?? '';
list($algo, $hash) = explode('=', $hubSignature, 2);

// Calculate the hash
$payload = file_get_contents("php://input");
$payloadHash = hash_hmac($algo, $payload, $secret);

// Verify the signature
if ($hash === $payloadHash) {
    // Pull the latest changes from the Git repository
    exec("git pull");
    echo "Git pull successful!!";
} else {
    echo "Invalid signature.";
}
?>

