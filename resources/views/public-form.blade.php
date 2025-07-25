<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Rekap Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-lg">
        <h1 class="text-xl font-bold mb-6">Form Rekap Postingan</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('public.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="title" placeholder="Judul" value="{{ old('title') }}" required class="w-full p-2 border rounded">
            <input type="url" name="link" placeholder="Link" value="{{ old('link') }}" required class="w-full p-2 border rounded">
            <input type="date" name="date_posted" value="{{ old('date_posted') }}" required class="w-full p-2 border rounded">

            <select name="category" required class="w-full p-2 border rounded">
                <option value="">Pilih Kategori</option>
                <option value="social_media">Sosial Media</option>
                <option value="news_portal">Portal Berita</option>
            </select>

            <select name="platform" required class="w-full p-2 border rounded">
                <option value="">Pilih Platform</option>
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

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim</button>
        </form>
    </div>
</body>
</html>
