<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HerVoice Rwanda - Anonymous Reporting</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans leading-relaxed bg-slate-50">

    <header class="bg-gradient-to-r from-violet-900 to-violet-950 text-white py-8 shadow-lg">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-2 drop-shadow-lg">HerVoice Rwanda</h1>
            <p class="text-xl opacity-95">Empowering Women & Girls to Speak Out Against Violence</p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-8">

        <section class="flex flex-col lg:flex-row items-center gap-12 my-12">
            <div class="flex-1 min-w-[300px]">
                <h2 class="text-violet-900 text-4xl md:text-5xl font-bold mb-4">A Safe Space to Be Heard</h2>
                <p class="text-lg text-gray-600 mb-6">HerVoice is a digital platform designed to support women and girls
                    who experience violence or harassment.</p>
                <p class="text-lg text-gray-600 mb-6">We provide a safe, confidential, and accessible way for victims to
                    report cases of violence without the need to appear in person.</p>
                <a href="report.php"
                    class="inline-block bg-gradient-to-r from-violet-600 to-violet-800 text-white px-10 py-4 rounded-full text-lg font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">Report
                    Your Case</a>
            </div>
            <div
                class="w-full max-w-[500px] bg-violet-100 h-64 rounded-2xl flex items-center justify-center text-violet-900 text-6xl">
                <img src="./Illustration.png" alt="" class="w-[370px] h-[370px]">
            </div>
        </section>

        <section class="my-16">
            <h2 class="text-center text-violet-900 text-4xl md:text-5xl font-bold mb-12">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-2xl shadow-md border-2 border-violet-600 hover:shadow-xl transition-shadow">
                    <h3 class="text-violet-700 text-2xl font-bold mb-2">Anonymous Reporting</h3>
                    <p class="text-gray-600">Submit complaints without revealing your identity if you choose.</p>
                </div>
                <div
                    class="bg-white p-8 rounded-2xl shadow-md border-2 border-violet-600 hover:shadow-xl transition-shadow">
                    <h3 class="text-violet-700 text-2xl font-bold mb-2">Track Your Case</h3>
                    <p class="text-gray-600">Receive a unique tracking ID to monitor the progress of your case.</p>
                </div>
                <div
                    class="bg-white p-8 rounded-2xl shadow-md border-2 border-violet-600 hover:shadow-xl transition-shadow">
                    <h3 class="text-violet-700 text-2xl font-bold mb-2">Secure Communication</h3>
                    <p class="text-gray-600">All information is stored securely to protect your privacy.</p>
                </div>
            </div>
        </section>

        <section class="my-16 text-center">
            <h2 class="text-violet-900 text-3xl font-bold mb-8">What Would You Like to Do?</h2>
            <div class="flex flex-col md:flex-row gap-6 justify-center max-w-2xl mx-auto">
                <a href="report.php"
                    class="flex-1 bg-gradient-to-r from-violet-600 to-violet-800 text-white py-6 px-8 rounded-2xl text-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                     Submit a Report
                </a>
                <a href="track.php"
                    class="flex-1 bg-white text-violet-800 py-6 px-8 rounded-2xl text-xl font-semibold shadow-lg border-2 border-violet-600 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                     Track Case Status
                </a>
            </div>
            <div class="mt-8">
                <a href="admin_login.php"
                    class="text-violet-600 hover:text-violet-800 font-medium hover:underline">Admin Login →</a>
            </div>
        </section>

    </div>

    <footer class="bg-gradient-to-r from-violet-600 to-violet-800 text-white text-center py-8 mt-16">
        <p class="text-lg">&copy; 2025 HerVoice Rwanda. All rights reserved.</p>
        <p class="mt-2 opacity-90">Empowering voices, ending violence.</p>
    </footer>

</body>

</html>