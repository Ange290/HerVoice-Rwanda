<?php

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

include 'db_connect.php';

$success_message = '';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $report_id = intval($_POST['report_id']);
    $new_status = $conn->real_escape_string($_POST['status']);

    $update_sql = "UPDATE reports SET status='$new_status' WHERE id=$report_id";

    if ($conn->query($update_sql) === TRUE) {
        $success_message = "Status updated successfully!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin_login.php');
    exit();
}

// Fetch all reports with organization names
$sql = "SELECT r.id, r.tracking_id, r.status, r.created_at, r.description, r.evidence_path, o.name as organization_name 
        FROM reports r 
        LEFT JOIN organizations o ON r.organization_id = o.id 
        ORDER BY r.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HerVoice Rwanda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans leading-relaxed bg-slate-50 min-h-screen">

    <header class="bg-gradient-to-r from-violet-900 to-violet-950 text-white py-6 shadow-lg">
        <div class="max-w-7xl mx-auto px-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold drop-shadow-lg">Admin Dashboard</h1>
                <p class="text-sm opacity-90">HerVoice Rwanda - Manage Reports</p>
            </div>
            <a href="?logout=true"
                class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-full font-semibold shadow-lg transition transform hover:-translate-y-1">Logout</a>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-8 py-8">

        <?php if ($success_message): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow">
                <p class="font-bold">✅ Success!</p>
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-violet-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-violet-900 text-white">
                            <th class="p-4 font-bold">Tracking ID</th>
                            <th class="p-4 font-bold">Organization</th>
                            <th class="p-4 font-bold">Details</th>
                            <th class="p-4 font-bold">Evidence</th>
                            <th class="p-4 font-bold">Status</th>
                            <th class="p-4 font-bold">Date</th>
                            <th class="p-4 font-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $statusColor = match ($row['status']) {
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'In Review' => 'bg-blue-100 text-blue-800',
                                    'Resolved' => 'bg-green-100 text-green-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };

                                echo "<tr class='hover:bg-violet-50 border-b border-violet-100'>";

                                // Tracking ID
                                echo "<td class='p-4'><span class='font-mono text-sm font-bold text-violet-700'>" . htmlspecialchars($row['tracking_id']) . "</span></td>";

                                // Organization
                                echo "<td class='p-4 font-medium text-gray-700'>" . htmlspecialchars($row['organization_name']) . "</td>";

                                // Details (truncated)
                                $details = htmlspecialchars($row['description']);
                                $truncated = strlen($details) > 50 ? substr($details, 0, 50) . '...' : $details;
                                echo "<td class='p-4 max-w-xs text-gray-600' title='" . $details . "'>" . $truncated . "</td>";

                                // Evidence
                                echo "<td class='p-4'>";
                                if ($row['evidence_path']) {
                                    echo "<a href='" . htmlspecialchars($row['evidence_path']) . "' target='_blank' class='text-violet-600 hover:text-violet-800 font-medium hover:underline text-sm'>📎 View</a>";
                                } else {
                                    echo "<span class='text-gray-400 text-sm'>—</span>";
                                }
                                echo "</td>";

                                // Status Badge
                                echo "<td class='p-4'>";
                                echo "<span class='px-3 py-1 rounded-full text-xs font-bold $statusColor shadow-sm'>" . $row['status'] . "</span>";
                                echo "</td>";

                                // Date
                                echo "<td class='p-4 text-sm text-gray-600'>" . date('M j, Y', strtotime($row['created_at'])) . "</td>";

                                // Actions (Update Status Form)
                                echo "<td class='p-4'>";
                                echo "<form method='POST' action='' class='flex gap-2 items-center'>";
                                echo "<input type='hidden' name='report_id' value='" . $row['id'] . "'>";
                                echo "<select name='status' class='border-2 border-violet-300 rounded-lg p-2 text-sm focus:outline-none focus:border-violet-500 bg-gray-50'>";
                                echo "<option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>";
                                echo "<option value='In Review' " . ($row['status'] == 'In Review' ? 'selected' : '') . ">In Review</option>";
                                echo "<option value='Resolved' " . ($row['status'] == 'Resolved' ? 'selected' : '') . ">Resolved</option>";
                                echo "</select>";
                                echo "<button type='submit' name='update_status' class='bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition transform hover:-translate-y-0.5'>Update</button>";
                                echo "</form>";
                                echo "</td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='p-8 text-center text-gray-500 text-lg'>📭 No reports found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="index.php" class="text-violet-600 hover:text-violet-800 font-medium hover:underline">← Back to
                Home</a>
        </div>
    </div>

    <footer class="bg-gradient-to-r from-violet-600 to-violet-800 text-white text-center py-6 mt-16">
        <p class="opacity-90">HerVoice Rwanda Admin Panel &copy; 2025</p>
    </footer>

</body>

</html>