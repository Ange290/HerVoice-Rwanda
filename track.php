<?php
session_start(); // If using sessions
include 'db_connect.php';
// Rest of your code...
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Case - HerVoice Rwanda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans leading-relaxed bg-slate-50">

    <header class="bg-gradient-to-r from-violet-900 to-violet-950 text-white py-8 shadow-lg">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-2 drop-shadow-lg">HerVoice Rwanda</h1>
            <p class="text-lg opacity-95">Track Your Case Status</p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-8">

        <section
            class="my-16 bg-white rounded-3xl shadow-xl overflow-hidden border border-violet-200 max-w-3xl mx-auto">
            <div class="bg-violet-900 py-6 px-8">
                <h2 class="text-white text-3xl font-bold text-center">Check Case Status</h2>
            </div>

            <div class="p-8 md:p-12">
                <form method="GET" class="mb-6">
                    <label class="block text-violet-900 font-semibold mb-2">Enter Your Tracking ID</label>
                    <input type="text" name="tid" placeholder="e.g., 8A12C74F" required
                        class="w-full p-4 border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-violet-500 focus:outline-none font-mono bg-gray-50 text-lg">
                    <button type="submit"
                        class="w-full bg-violet-500 hover:bg-violet-600 text-white font-bold py-4 px-12 rounded-full shadow-lg transform hover:-translate-y-1 transition duration-300">Check
                        Status</button>
                </form>

                <?php
                if (isset($_GET['tid'])) {
                    $tid = $conn->real_escape_string($_GET['tid']);

                    // Fixed SQL query - join with organizations table to get org name
                    $sql = "SELECT r.tracking_id, r.status, r.created_at, r.description, r.evidence_path, o.name as organization_name 
                    FROM reports r 
                    LEFT JOIN organizations o ON r.organization_id = o.id 
                    WHERE r.tracking_id='$tid'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $statusColor = match ($row['status']) {
                            'Pending' => 'bg-yellow-100 text-yellow-800',
                            'In Review' => 'bg-blue-100 text-blue-800',
                            'Resolved' => 'bg-green-100 text-green-800',
                            default => 'bg-gray-100 text-gray-800'
                        };

                        echo "<div class='border-t pt-6 bg-violet-50 p-6 rounded-xl'>";
                        echo "<h3 class='text-2xl font-bold text-violet-900 mb-6 text-center'> Case Details</h3>";

                        // Tracking ID
                        echo "<div class='mb-4 bg-white p-4 rounded-lg shadow-sm'>";
                        echo "<p class='text-sm text-violet-700 font-semibold mb-1'>Tracking ID:</p>";
                        echo "<p class='text-xl font-mono font-bold text-violet-600'>" . htmlspecialchars($row['tracking_id']) . "</p>";
                        echo "</div>";

                        // Organization
                        echo "<div class='mb-4 bg-white p-4 rounded-lg shadow-sm'>";
                        echo "<p class='text-sm text-violet-700 font-semibold mb-1'>Organization:</p>";
                        echo "<p class='text-gray-800 text-lg'>" . htmlspecialchars($row['organization_name']) . "</p>";
                        echo "</div>";

                        // Description
                        echo "<div class='mb-4 bg-white p-4 rounded-lg shadow-sm'>";
                        echo "<p class='text-sm text-violet-700 font-semibold mb-1'>Details:</p>";
                        echo "<p class='text-gray-800'>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
                        echo "</div>";

                        // Evidence
                        if ($row['evidence_path']) {
                            echo "<div class='mb-4 bg-white p-4 rounded-lg shadow-sm'>";
                            echo "<p class='text-sm text-violet-700 font-semibold mb-1'>Evidence:</p>";
                            echo "<a href='" . htmlspecialchars($row['evidence_path']) . "' target='_blank' class='text-violet-600 hover:text-violet-800 font-medium hover:underline'>📎 View Uploaded File</a>";
                            echo "</div>";
                        }

                        // Status Badge
                        echo "<div class='mb-4 bg-white p-4 rounded-lg shadow-sm text-center'>";
                        echo "<p class='text-sm text-violet-700 font-semibold mb-2'>Current Status:</p>";
                        echo "<span class='inline-block px-6 py-3 rounded-full text-lg font-bold $statusColor shadow-md'>" . $row['status'] . "</span>";
                        echo "</div>";

                        // Submitted Date
                        echo "<div class='bg-white p-4 rounded-lg shadow-sm text-center'>";
                        echo "<p class='text-sm text-violet-700 font-semibold mb-1'>Submitted On:</p>";
                        echo "<p class='text-gray-800'>" . date('F j, Y, g:i a', strtotime($row['created_at'])) . "</p>";
                        echo "</div>";

                        echo "</div>";
                    } else {
                        echo "<div class='bg-red-50 border-2 border-red-400 p-6 rounded-xl text-center'>";
                        echo "<p class='text-red-700 font-bold text-xl mb-2'> Invalid Tracking ID</p>";
                        echo "<p class='text-red-600'>No case found with this ID. Please check and try again.</p>";
                        echo "</div>";
                    }
                }
                ?>

                <div class="text-center mt-8">
                    <a href="index.php" class="text-violet-600 hover:text-violet-800 font-medium hover:underline">← Back
                        to Home</a>
                </div>
            </div>
        </section>

    </div>

    <footer class="bg-gradient-to-r from-violet-600 to-violet-800 text-white text-center py-8 mt-16">
        <p class="text-lg">&copy; 2025 HerVoice Rwanda. All rights reserved.</p>
        <p class="mt-2 opacity-90">Empowering voices, ending violence.</p>
    </footer>

</body>

</html>