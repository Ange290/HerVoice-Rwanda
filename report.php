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
    <title>Submit Report - HerVoice Rwanda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans leading-relaxed bg-slate-50">

    <header class="bg-gradient-to-r from-violet-900 to-violet-950 text-white py-8 shadow-lg">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-2 drop-shadow-lg">HerVoice Rwanda</h1>
            <p class="text-lg opacity-95">Submit a Secure Report</p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-8">

        <section class="my-16 bg-white rounded-3xl shadow-xl overflow-hidden border border-violet-200">
            <div class="bg-violet-900 py-6 px-8">
                <h2 class="text-white text-3xl font-bold text-center">Anonymous Report Form</h2>
            </div>

            <div class="p-8 md:p-12">
                <form action="submit_report.php" method="POST" enctype="multipart/form-data"
                    class="space-y-6 max-w-3xl mx-auto">

                    <div>
                        <label class="block text-violet-900 font-semibold mb-2">Select Organization/NGO</label>
                        <select name="org_id" required
                            class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none bg-gray-50">
                            <option value="" disabled selected>Choose an organization...</option>
                            <?php
                            $result = $conn->query("SELECT * FROM organizations");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-violet-900 font-semibold mb-2">Describe the Incident</label>
                        <textarea name="description" rows="5" required
                            placeholder="Please describe what happened, where, and when..."
                            class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none bg-gray-50"></textarea>
                    </div>

                    <div>
                        <label class="block text-violet-900 font-semibold mb-2">Upload Evidence (Optional)</label>
                        <p class="text-sm text-gray-500 mb-2">Photos, Audio, Video, or Documents.</p>
                        <input type="file" name="evidence"
                            class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-100 file:text-violet-700 hover:file:bg-violet-200">
                    </div>

                    <div class="text-center pt-4">
                        <button type="submit"
                            class="w-full md:w-auto bg-violet-500 hover:bg-violet-600 text-white font-bold py-4 px-12 rounded-full shadow-lg transform hover:-translate-y-1 transition duration-300">
                            Submit Report Securely
                        </button>
                    </div>

                </form>

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