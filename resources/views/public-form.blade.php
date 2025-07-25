<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Postingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center px-4 py-6">

    <!-- Header Instansi -->
    <div class="mb-6 text-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo_Kemendikbud.png" alt="Logo Instansi" class="w-16 h-16 mx-auto mb-2">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Madrasah Aliyah Negeri 2 Bantul</h1>
        <p class="text-sm text-gray-600">Formulir Rekap Postingan Sosial Media & Portal Berita</p>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-8 w-full max-w-2xl space-y-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded border border-green-300 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('public.store') }}" class="space-y-4" id="postingForm">
            @csrf

            <div class="space-y-1">
                <label for="link" class="text-sm font-medium text-gray-700">Link Artikel / Sosial Media</label>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="url" name="link" id="link" required
                        class="flex-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="https://kompasiana.com/..." value="{{ old('link') }}">
                    <button type="button" onclick="extractLink()" id="extractBtn"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Ekstrak
                    </button>
                </div>
                <div id="extractStatus" class="text-xs text-gray-600 italic mt-1 hidden">🔄 Mengambil data...</div>
            </div>

            <div class="space-y-1">
                <label for="title" class="text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    value="{{ old('title') }}">
            </div>

            <div class="space-y-1">
                <label for="date_posted" class="text-sm font-medium text-gray-700">Tanggal Posting</label>
                <input type="date" name="date_posted" id="date_posted" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    value="{{ old('date_posted') }}">
            </div>

            <div class="space-y-1">
                <label for="category" class="text-sm font-medium text-gray-700">Kategori</label>
                <select name="category" id="category" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    <option value="">Pilih kategori...</option>
                    <option value="social_media">Sosial Media</option>
                    <option value="news_portal">Portal Berita</option>
                </select>
            </div>

            <div class="space-y-1">
                <label for="platform" class="text-sm font-medium text-gray-700">Platform</label>
                <select name="platform" id="platform" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    <option value="">Pilih platform...</option>
                    <option value="instagram">Instagram</option>
                    <option value="facebook">Facebook</option>
                    <option value="threads">Threads</option>
                    <option value="twitter">Twitter</option>
                    <option value="tiktok">TikTok</option>
                    <option value="kompasiana">Kompasiana</option>
                    <option value="retizen">Retizen</option>
                    <option value="telik_sandi">Telik Sandi</option>
                    <option value="man_2_bantul">MAN 2 Bantul</option>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                Simpan Postingan
            </button>
        </form>
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
