<?php
// Redirect đến dash.php, tránh vòng lặp redirect
$request_uri = $_SERVER["REQUEST_URI"] ?? "/";

if ($request_uri === "/" || $request_uri === "" || strtolower($request_uri) === "/index.php") {
    header("Location: /dash.php");
    exit;
}
