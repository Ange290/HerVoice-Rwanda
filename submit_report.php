<?php
session_start(); 
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $org_id = intval($_POST['org_id']);
    $desc = $conn->real_escape_string($_POST['description']);
    $tracking_id = strtoupper(bin2hex(random_bytes(4))); 
    
    $file_path = NULL;

    // Handle File Upload
    if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] == 0) {
        // Use absolute path for Windows
        $upload_dir = __DIR__ . '/uploads/';
        
        // Check if folder exists, if not, create it
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die("<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Error</title>
                    <script src='https://cdn.tailwindcss.com'></script>
                </head>
                <body class='bg-gray-100 min-h-screen flex items-center justify-center px-4'>
                    <div class='bg-white p-8 rounded-lg shadow-lg text-center max-w-md'>
                        <div class='text-red-500 text-5xl mb-4'>✗</div>
                        <h2 class='text-2xl font-bold text-red-600 mb-2'>Upload Error</h2>
                        <p class='text-gray-600 mb-4'>Could not create uploads folder. Please create 'uploads' folder manually in HerVoice directory.</p>
                        <a href='report.php' class='block w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition'>Try Again</a>
                    </div>
                </body>
                </html>");
            }
        }

        $file_name = basename($_FILES['evidence']['name']);
        // Add timestamp to prevent overwriting files with same name
        $target_file = $upload_dir . time() . "_" . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $allowed = ['jpg', 'jpeg', 'png', 'mp4', 'mp3', 'pdf', 'doc', 'docx', 'txt'];

        if (in_array($file_type, $allowed)) {
            if (move_uploaded_file($_FILES['evidence']['tmp_name'], $target_file)) {
                // Store relative path in database
                $file_path = $conn->real_escape_string('uploads/' . time() . "_" . $file_name);
            } else {
                die("<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Error</title>
                    <script src='https://cdn.tailwindcss.com'></script>
                </head>
                <body class='bg-gray-100 min-h-screen flex items-center justify-center px-4'>
                    <div class='bg-white p-8 rounded-lg shadow-lg text-center max-w-md'>
                        <div class='text-red-500 text-5xl mb-4'>✗</div>
                        <h2 class='text-2xl font-bold text-red-600 mb-2'>Upload Failed</h2>
                        <p class='text-gray-600 mb-4'>Could not save file. Check folder permissions.</p>
                        <a href='report.php' class='block w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition'>Try Again</a>
                    </div>
                </body>
                </html>");
            }
        } else {
            die("<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <title>Error</title>
                <script src='https://cdn.tailwindcss.com'></script>
            </head>
            <body class='bg-gray-100 min-h-screen flex items-center justify-center px-4'>
                <div class='bg-white p-8 rounded-lg shadow-lg text-center max-w-md'>
                    <div class='text-red-500 text-5xl mb-4'>✗</div>
                    <h2 class='text-2xl font-bold text-red-600 mb-2'>Invalid File Type</h2>
                    <p class='text-gray-600 mb-4'>Only jpg, png, mp4, mp3, pdf, doc, docx, txt files are allowed.</p>
                    <a href='report.php' class='block w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition'>Try Again</a>
                </div>
            </body>
            </html>");
        }
    }

    $sql = "INSERT INTO reports (tracking_id, organization_id, description, evidence_path) VALUES ('$tracking_id', '$org_id', '$desc', '$file_path')";

    if ($conn->query($sql) === TRUE) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Report Submitted Successfully</title>
            <script src='https://cdn.tailwindcss.com'></script>
        </head>
        <body class='bg-gray-100 min-h-screen flex items-center justify-center px-4'>
            <div class='bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full'>
                <div class='text-green-500 text-6xl mb-4'>✓</div>
                <h2 class='text-3xl font-bold text-green-600 mb-2'>Report Sent Successfully!</h2>
                <p class='text-gray-600 mb-4'>Your report has been submitted anonymously.</p>
                
                <div class='bg-purple-50 border-2 border-purple-200 p-4 rounded-lg mb-4'>
                    <p class='text-sm text-gray-700 mb-2 font-semibold'>Your Tracking ID:</p>
                    <div class='bg-white p-3 rounded text-2xl font-mono font-bold text-purple-600 select-all break-all'>$tracking_id</div>
                </div>
                
                <div class='bg-yellow-50 border-l-4 border-yellow-400 p-3 mb-6'>
                    <p class='text-sm text-yellow-800'> <strong>Important:</strong> Save this ID to track your case status.</p>
                </div>
                
                <a href='index.php' class='block w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition shadow-md'>
                    Go Back Home
                </a>
                
                <a href='track.php' class='block w-full mt-3 bg-gray-200 text-gray-800 py-3 rounded-lg font-medium hover:bg-gray-300 transition'>
                    Track Case Status
                </a>
            </div>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Error</title>
            <script src='https://cdn.tailwindcss.com'></script>
        </head>
        <body class='bg-gray-100 min-h-screen flex items-center justify-center px-4'>
            <div class='bg-white p-8 rounded-lg shadow-lg text-center max-w-md'>
                <div class='text-red-500 text-5xl mb-4'>✗</div>
                <h2 class='text-2xl font-bold text-red-600 mb-2'>Database Error</h2>
                <p class='text-gray-600 mb-4'>" . $conn->error . "</p>
                <a href='report.php' class='block w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition'>Try Again</a>
                <a href='index.php' class='block w-full mt-3 bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 transition'>Go Home</a>
            </div>
        </body>
        </html>";
    }
}
?>