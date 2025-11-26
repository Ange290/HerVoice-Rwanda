<?php session_start(); ?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>HerVoice Rwanda</title>
</head>
<body class="font-outfit leading-relaxed bg-slate-50">

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
                <p class="text-lg text-gray-600 mb-6">HerVoice is a digital platform designed to support women and girls who experience violence or harassment.</p>
                <p class="text-lg text-gray-600 mb-6">We provide a safe, confidential, and accessible way for victims to report cases of violence without the need to appear in person.</p>
                <a href="#report" class="inline-block bg-gradient-to-r from-violet-600 to-violet-800 text-white px-10 py-4 rounded-full text-lg font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">Report Your Case</a>
            </div>
            <div class="w-full max-w-[500px] bg-violet-100 h-64 rounded-2xl flex items-center justify-center text-violet-400">
               <img src="src/assests/Illustration.png" alt="Illustration" class="w-[28vw] h-auto max-w-[500px] mx-auto">
            </div>
        </section>

        <section class="my-16">
            <h2 class="text-center text-violet-900 text-4xl md:text-5xl font-bold mb-12">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-md border-2 border-violet-600">
                    <h3 class="text-violet-700 text-2xl font-bold mb-2">Anonymous Reporting</h3>
                    <p class="text-gray-600">Submit complaints without revealing your identity if you choose.</p>
                </div>
                 <div class="bg-white p-8 rounded-2xl shadow-md border-2 border-violet-600">
                    <h3 class="text-violet-700 text-2xl font-bold mb-2">Organization Selection</h3>
                    <p class="text-gray-600">Choose the NGO or organization you trust to report to. Work with local and international partners.</p>
                </div>
                 <div class="bg-white p-8 rounded-2xl shadow-md border-2 border-violet-600">
                    <h3 class="text-violet-700 text-2xl font-bold mb-2">Secure Communication</h3>
                    <p class="text-gray-600">All information is stored securely using encryption to protect your privacy.</p>
                </div>
                </div>
        </section>


        <section id="report" class="my-16 bg-white rounded-3xl shadow-xl overflow-hidden border border-violet-200">
            <div class="bg-violet-900 py-6 px-8">
                 <h2 class="text-white text-3xl font-bold text-center">Submit a Secure Report</h2>
            </div>
            
            <div class="p-8 md:p-12">
                
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="<?php echo $_SESSION['msg_type'] == 'success' ? 'bg-green-100 text-green-700 border-green-400' : 'bg-red-100 text-red-700 border-red-400'; ?> border px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold"><?php echo $_SESSION['msg_type'] == 'success' ? 'Success!' : 'Error!'; ?></strong>
                        <span class="block sm:inline"><?php echo $_SESSION['message']; ?></span>
                    </div>
                    <?php 
                        // Clear message after displaying
                        unset($_SESSION['message']);
                        unset($_SESSION['msg_type']);
                    ?>
                <?php endif; ?>

                <form action="process_report.php" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl mx-auto">
                    
                    <div>
                        <label class="block text-violet-900 font-semibold mb-2">Select Organization/NGO</label>
                        <select name="organization" required class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none bg-gray-50">
                            <option value="" disabled selected>Choose an organization...</option>
                            <option value="Rwanda Investigation Bureau (RIB)">Rwanda Investigation Bureau (RIB)</option>
                            <option value="Isange One Stop Center">Isange One Stop Center</option>
                            <option value="Haguruka NGO">Haguruka NGO</option>
                            <option value="Profemmes Twese Hamwe">Profemmes Twese Hamwe</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-violet-900 font-semibold mb-2">Describe the Incident</label>
                        <textarea name="description" rows="5" required placeholder="Please describe what happened, where, and when..." class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none bg-gray-50"></textarea>
                    </div>

                    <div>
                        <label class="block text-violet-900 font-semibold mb-2">Upload Evidence (Optional)</label>
                        <p class="text-sm text-gray-500 mb-2">Photos, Audio, Video, or Documents.</p>
                        <input type="file" name="evidence" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-100 file:text-violet-700 hover:file:bg-violet-200">
                    </div>

                    <div>
                        <label class="block text-violet-900 font-semibold mb-2">Contact Information (Optional)</label>
                        <p class="text-sm text-gray-500 mb-2">Leave blank if you wish to remain 100% anonymous.</p>
                        <input type="text" name="contact" placeholder="Phone number or Email" class="w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none bg-gray-50">
                    </div>

                    <div class="text-center pt-4">
                        <button type="submit" class="w-full md:w-auto bg-violet-500 hover:bg-violet-600 text-white font-bold py-4 px-12 rounded-full shadow-lg transform hover:-translate-y-1 transition duration-300">
                            Submit Report securely
                        </button>
                    </div>

                </form>
            </div>
        </section>

    </div>

    <footer class="bg-gradient-to-r from-violet-600 to-violet-800 text-white text-center py-8 mt-16">
        <p class="text-lg">&copy; 2025 HerVoice Rwanda. All rights reserved.</p>
        <p class="mt-2 opacity-90">Empowering voices, ending violence.</p>
    </footer>
</body>
</html>