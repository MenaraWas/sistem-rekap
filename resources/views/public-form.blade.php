<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Postingan - MAN 2 Bantul</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo_Kemendikbud.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo_Kemendikbud.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo_Kemendikbud.png">
    
    <!-- Meta tags untuk SEO dan sharing -->
    <meta name="description" content="Formulir Rekap Postingan Sosial Media & Portal Berita - Madrasah Aliyah Negeri 2 Bantul">
    <meta name="keywords" content="MAN 2 Bantul, rekap postingan, sosial media, portal berita">
    <meta name="author" content="MAN 2 Bantul">
    
    <!-- Theme color untuk mobile browser -->
    <meta name="theme-color" content="#16a34a">
    <meta name="msapplication-TileColor" content="#16a34a">
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center px-3 py-4 sm:px-4 sm:py-6">

    <!-- Header Instansi -->
    <div class="mb-4 sm:mb-6 text-center w-full max-w-2xl">
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo_Kemendikbud.png" alt="Logo Instansi" class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-2">
        <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 px-2 leading-tight">Madrasah Aliyah Negeri 2 Bantul</h1>
        <p class="text-xs sm:text-sm text-gray-600 px-2 mt-1">Formulir Rekap Postingan Sosial Media & Portal Berita</p>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-xl rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 w-full max-w-2xl space-y-4 sm:space-y-6">
        <!-- Laravel Success Message -->
        <div class="bg-green-100 text-green-800 px-3 py-2 rounded border border-green-300 text-sm hidden" id="successMessage">
            Data berhasil disimpan!
        </div>

        <form method="POST" action="{{ route('public.store') }}" class="space-y-3 sm:space-y-4" id="postingForm">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Link Input -->
            <div class="space-y-1">
                <label for="link" class="block text-sm font-medium text-gray-700">Link Artikel / Sosial Media</label>
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:gap-2">
                    <input type="url" name="link" id="link" required
                        class="flex-1 p-2.5 sm:p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent text-sm"
                        placeholder="https://kompasiana.com/..." value="{{ old('link') }}">
                    <button type="button" onclick="extractLink()" id="extractBtn"
                        class="bg-blue-600 text-white px-4 py-2.5 sm:py-2 rounded-md hover:bg-blue-700 transition duration-200 text-sm font-medium whitespace-nowrap">
                        Ekstrak
                    </button>
                </div>
                <div id="extractStatus" class="text-xs text-gray-600 italic mt-1 hidden">🔄 Mengambil data...</div>
            </div>

            <!-- Title Input -->
            <div class="space-y-1">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" required
                    class="w-full p-2.5 sm:p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent text-sm"
                    value="{{ old('title') }}" placeholder="Masukkan judul artikel...">
            </div>

            <!-- Date Input -->
            <div class="space-y-1">
                <label for="date_posted" class="block text-sm font-medium text-gray-700">Tanggal Posting</label>
                <input type="date" name="date_posted" id="date_posted" required
                    class="w-full p-2.5 sm:p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent text-sm"
                    value="{{ old('date_posted') }}">
            </div>

            <!-- Category Select -->
            <div class="space-y-1">
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category" id="category" required
                    class="w-full p-2.5 sm:p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent text-sm bg-white appearance-none">
                    <option value="">Pilih kategori...</option>
                    <option value="social_media" {{ old('category') == 'social_media' ? 'selected' : '' }}>Sosial Media</option>
                    <option value="news_portal" {{ old('category') == 'news_portal' ? 'selected' : '' }}>Portal Berita</option>
                </select>
            </div>

            <!-- Platform Select -->
            <div class="space-y-1">
                <label for="platform" class="block text-sm font-medium text-gray-700">Platform</label>
                <select name="platform" id="platform" required
                    class="w-full p-2.5 sm:p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent text-sm bg-white appearance-none">
                    <option value="">Pilih platform...</option>
                    <option value="instagram" {{ old('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="facebook" {{ old('platform') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="threads" {{ old('platform') == 'threads' ? 'selected' : '' }}>Threads</option>
                    <option value="twitter" {{ old('platform') == 'twitter' ? 'selected' : '' }}>Twitter</option>
                    <option value="tiktok" {{ old('platform') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                    <option value="kompasiana" {{ old('platform') == 'kompasiana' ? 'selected' : '' }}>Kompasiana</option>
                    <option value="retizen" {{ old('platform') == 'retizen' ? 'selected' : '' }}>Retizen</option>
                    <option value="telik_sandi" {{ old('platform') == 'telik_sandi' ? 'selected' : '' }}>Telik Sandi</option>
                    <option value="man_2_bantul" {{ old('platform') == 'man_2_bantul' ? 'selected' : '' }}>MAN 2 Bantul</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-green-600 text-white px-4 py-3 sm:py-2 rounded-md hover:bg-green-700 transition duration-200 text-sm font-medium mt-4 sm:mt-6">
                Simpan Postingan
            </button>
        </form>
    </div>

    <!-- Footer untuk mobile -->
    <div class="mt-4 text-center">
        <p class="text-xs text-gray-500">© 2024 MAN 2 Bantul</p>
    </div>

    <script>
        function extractLink() {
            const linkInput = document.getElementById('link');
            const titleInput = document.getElementById('title');
            const dateInput = document.getElementById('date_posted');
            const status = document.getElementById('extractStatus');
            const button = document.getElementById('extractBtn');

            const url = linkInput.value;
            if (!url) return alert('Masukkan link terlebih dahulu.');

            status.classList.remove('hidden');
            status.textContent = '🔄 Mengambil data...';
            button.disabled = true;

            fetch(`/extract?url=${encodeURIComponent(url)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.title) titleInput.value = data.title;
                    if (data.date_posted) dateInput.value = data.date_posted;

                    status.textContent = '✅ Data berhasil diambil';
                })
                .catch(() => {
                    status.textContent = '❌ Gagal mengambil data dari link.';
                })
                .finally(() => {
                    button.disabled = false;
                    setTimeout(() => status.classList.add('hidden'), 3000);
                });
        }
    </script>
</body>
</html>