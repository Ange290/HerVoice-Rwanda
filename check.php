<?php
/**
 * HerVoice Configuration Check
 * This file helps diagnose configuration issues on your hosting
 * 
 * USAGE: Upload this file and visit it in your browser
 * DELETE this file after checking (for security)
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>
<html>
<head>
    <title>HerVoice Configuration Check</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .warning { color: orange; font-weight: bold; }
        .section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        h2 { color: #6B21A8; }
    </style>
</head>
<body>
    <h1>🔍 HerVoice Configuration Check</h1>
    <p>This tool checks if your hosting environment is properly configured.</p>
";

// Check 1: PHP Version
echo "<div class='section'>";
echo "<h2>1. PHP Version</h2>";
$phpVersion = phpversion();
if (version_compare($phpVersion, '7.4.0', '>=')) {
    echo "<p class='success'>✓ PHP Version: $phpVersion (OK)</p>";
} else {
    echo "<p class='error'>✗ PHP Version: $phpVersion (Upgrade to 7.4+ recommended)</p>";
}
echo "</div>";

// Check 2: Required Extensions
echo "<div class='section'>";
echo "<h2>2. Required PHP Extensions</h2>";
$extensions = ['mysqli', 'session', 'fileinfo', 'json'];
foreach ($extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "<p class='success'>✓ $ext extension: Loaded</p>";
    } else {
        echo "<p class='error'>✗ $ext extension: Missing</p>";
    }
}
echo "</div>";

// Check 3: File Permissions
echo "<div class='section'>";
echo "<h2>3. File/Folder Permissions</h2>";

$uploadsDir = 'uploads';
if (is_dir($uploadsDir)) {
    if (is_writable($uploadsDir)) {
        echo "<p class='success'>✓ uploads/ folder exists and is writable</p>";
    } else {
        echo "<p class='error'>✗ uploads/ folder exists but is NOT writable</p>";
        echo "<p>Fix: Set folder permissions to 755 or 777</p>";
    }
} else {
    echo "<p class='error'>✗ uploads/ folder does NOT exist</p>";
    echo "<p>Fix: Create the folder and set permissions to 755</p>";
}
echo "</div>";

// Check 4: Database Connection
echo "<div class='section'>";
echo "<h2>4. Database Connection</h2>";

if (file_exists('db_connect.php')) {
    echo "<p class='success'>✓ db_connect.php file exists</p>";

    // Try to include and test connection
    ob_start();
    try {
        include 'db_connect.php';
        if (isset($conn) && $conn instanceof mysqli) {
            if ($conn->connect_error) {
                echo "<p class='error'>✗ Database connection failed: " . $conn->connect_error . "</p>";
                echo "<p>Check your credentials in db_connect.php</p>";
            } else {
                echo "<p class='success'>✓ Database connection successful!</p>";
                echo "<p>Database: " . $conn->get_server_info() . "</p>";
            }
        } else {
            echo "<p class='error'>✗ Database connection object not created</p>";
        }
    } catch (Exception $e) {
        echo "<p class='error'>✗ Error: " . $e->getMessage() . "</p>";
    }
    ob_end_flush();
} else {
    echo "<p class='error'>✗ db_connect.php file NOT found</p>";
}
echo "</div>";

// Check 5: Required Files
echo "<div class='section'>";
echo "<h2>5. Required Files</h2>";
$requiredFiles = [
    'index.php',
    'report.php',
    'submit_report.php',
    'track.php',
    'admin_login.php',
    'admin_dashboard.php',
    'db_connect.php'
];

foreach ($requiredFiles as $file) {
    if (file_exists($file)) {
        echo "<p class='success'>✓ $file exists</p>";
    } else {
        echo "<p class='error'>✗ $file is MISSING</p>";
    }
}
echo "</div>";

// Check 6: PHP Settings
echo "<div class='section'>";
echo "<h2>6. PHP Configuration</h2>";
$settings = [
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
    'max_execution_time' => ini_get('max_execution_time'),
    'memory_limit' => ini_get('memory_limit')
];

foreach ($settings as $setting => $value) {
    echo "<p>$setting: <strong>$value</strong></p>";
}
echo "</div>";

// Check 7: Session Support
echo "<div class='section'>";
echo "<h2>7. Session Support</h2>";
if (session_start()) {
    echo "<p class='success'>✓ Sessions are working</p>";
    $_SESSION['test'] = 'ok';
    session_write_close();
} else {
    echo "<p class='error'>✗ Session start failed</p>";
}
echo "</div>";

// Check 8: Database Tables
echo "<div class='section'>";
echo "<h2>8. Database Tables</h2>";
if (isset($conn) && !$conn->connect_error) {
    $tables = ['organizations', 'reports', 'admins'];
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        if ($result && $result->num_rows > 0) {
            echo "<p class='success'>✓ Table '$table' exists</p>";
        } else {
            echo "<p class='error'>✗ Table '$table' does NOT exist</p>";
            echo "<p>Import database.sql file in phpMyAdmin</p>";
        }
    }
} else {
    echo "<p class='warning'>⚠ Cannot check tables - database not connected</p>";
}
echo "</div>";

echo "<hr>";
echo "<h2>Summary</h2>";
echo "<p><strong>⚠️ IMPORTANT:</strong> Delete this check.php file after reviewing for security reasons!</p>";
echo "<p>If you see any errors above, fix them before using the application.</p>";
echo "<p><a href='index.php'>← Back to Home</a></p>";

echo "</body>
</html>";
?>