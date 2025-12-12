<?php
// error_check.php - Upload this to find the exact error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Checking for errors...</h2>";

// Test 1: Basic PHP
echo "<p>✅ PHP is working</p>";

// Test 2: Check db_connect.php
echo "<h3>Testing db_connect.php:</h3>";
if (file_exists('db_connect.php')) {
    echo "<p>✅ db_connect.php file exists</p>";
    
    // Try to include it
    try {
        include 'db_connect.php';
        echo "<p>✅ db_connect.php included successfully</p>";
        
        // Test connection
        if (isset($conn) && $conn instanceof mysqli) {
            echo "<p>✅ Database connection object created</p>";
            
            if ($conn->ping()) {
                echo "<p style='color:green;'><strong>✅ Database connection is ACTIVE!</strong></p>";
            } else {
                echo "<p style='color:red;'>❌ Connection exists but ping failed</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Connection variable not set</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red;'>❌ Error including db_connect.php: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:red;'>❌ db_connect.php file NOT found</p>";
}

// Test 3: Check other files
echo "<h3>Checking other PHP files:</h3>";
$files = ['index.php', 'admin_dashboard.php', 'admin_login.php', 'report.php', 'track.php', 'submit_report.php'];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p>✅ $file exists</p>";
        
        // Check for syntax errors
        $output = shell_exec("php -l $file 2>&1");
        if ($output === null) {
            echo "<p style='color:orange;'>⚠️ Cannot check syntax (shell_exec disabled)</p>";
        } elseif (strpos($output, 'No syntax errors') !== false) {
            echo "<p style='color:green;'>✅ $file - No syntax errors</p>";
        } else {
            echo "<p style='color:red;'>❌ $file - Syntax error: " . htmlspecialchars($output) . "</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ $file NOT found</p>";
    }
}

// Test 4: PHP Configuration
echo "<h3>PHP Configuration:</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>display_errors: " . ini_get('display_errors') . "</p>";
echo "<p>error_reporting: " . error_reporting() . "</p>";
echo "<p>mysqli extension: " . (extension_loaded('mysqli') ? '✅ Loaded' : '❌ Not loaded') . "</p>";

// Test 5: File permissions
echo "<h3>File Permissions:</h3>";
foreach ($files as $file) {
    if (file_exists($file)) {
        $perms = substr(sprintf('%o', fileperms($file)), -4);
        echo "<p>$file: $perms</p>";
    }
}

echo "<hr>";
echo "<p><strong>Now try visiting your pages again. If you still get errors, check the output above.</strong></p>";
?>