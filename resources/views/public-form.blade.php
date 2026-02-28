<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Postingan - MAN 2 Bantul</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo_Kemendikbud.png">

    <!-- Meta tags -->
    <meta name="description"
        content="Formulir Rekap Postingan Sosial Media & Portal Berita - Madrasah Aliyah Negeri 2 Bantul">
    <meta name="theme-color" content="#0f172a">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Animated gradient background */
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #0f766e 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .gradient-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(16, 185, 129, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(59, 130, 246, 0.06) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(2%, -2%) rotate(1deg);
            }

            66% {
                transform: translate(-1%, 1%) rotate(-1deg);
            }
        }

        /* White card */
        .glass-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        /* Input styles */
        .form-input {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            background: #ffffff;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
            outline: none;
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .form-input option {
            background: #ffffff;
            color: #1e293b;
        }

        /* Extract button glow */
        .btn-extract {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            transition: all 0.3s ease;
        }

        .btn-extract:hover {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            transform: translateY(-1px);
        }

        /* Submit button */
        .btn-submit {
            background: linear-gradient(135deg, #10b981, #059669);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #34d399, #10b981);
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.3);
            transform: translateY(-1px);
        }

        /* Label style */
        .form-label {
            color: #475569;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Success alert */
        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        /* Status badge animation */
        .status-badge {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Subtle divider */
        .form-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
        }
    </style>
</head>

<body class="gradient-bg">
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-6 sm:px-6 sm:py-10">

        <!-- Header -->
        <div class="mb-6 sm:mb-8 text-center w-full max-w-lg">
            <div
                class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/10 border border-emerald-500/20 mb-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo_Kemendikbud.png" alt="Logo"
                    class="w-9 h-9 sm:w-10 sm:h-10">
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-white tracking-tight">
                MAN 2 Bantul
            </h1>
            <p class="text-sm text-slate-400 mt-1">Rekap Postingan Media & Portal Berita</p>
        </div>

        <!-- Form Card -->
        <div class="glass-card rounded-2xl sm:rounded-3xl p-5 sm:p-8 w-full max-w-lg">

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert-success px-4 py-3 rounded-xl text-sm mb-5 status-badge">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('public.store') }}" class="space-y-5" id="postingForm">
                @csrf

                <!-- Link Input -->
                <div>
                    <label for="link" class="form-label block mb-1.5">Link Artikel / Sosial Media</label>
                    <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:gap-2">
                        <input type="url" name="link" id="link" required
                            class="form-input flex-1 px-4 py-2.5 rounded-xl text-sm" placeholder="https://..."
                            value="{{ old('link') }}">
                        <button type="button" onclick="extractLink()" id="extractBtn"
                            class="btn-extract text-white px-5 py-2.5 rounded-xl text-sm font-semibold whitespace-nowrap">
                            Ekstrak
                        </button>
                    </div>
                    <div id="extractStatus" class="text-xs text-slate-400 italic mt-2 hidden status-badge"></div>
                </div>

                <div class="form-divider"></div>

                <!-- Title Input -->
                <div>
                    <label for="title" class="form-label block mb-1.5">Judul</label>
                    <input type="text" name="title" id="title" required
                        class="form-input w-full px-4 py-2.5 rounded-xl text-sm" value="{{ old('title') }}"
                        placeholder="Judul artikel akan terisi otomatis...">
                </div>

                <!-- Date & Category Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="date_posted" class="form-label block mb-1.5">Tanggal</label>
                        <input type="date" name="date_posted" id="date_posted" required
                            class="form-input w-full px-4 py-2.5 rounded-xl text-sm" value="{{ old('date_posted') }}">
                    </div>
                    <div>
                        <label for="category" class="form-label block mb-1.5">Kategori</label>
                        <select name="category" id="category" required
                            class="form-input w-full px-4 py-2.5 rounded-xl text-sm">
                            <option value="">Pilih...</option>
                            <option value="social_media" {{ old('category') == 'social_media' ? 'selected' : '' }}>Sosial
                                Media</option>
                            <option value="news_portal" {{ old('category') == 'news_portal' ? 'selected' : '' }}>Portal
                                Berita</option>
                        </select>
                    </div>
                </div>

                <!-- Platform Select -->
                <div>
                    <label for="platform" class="form-label block mb-1.5">Platform</label>
                    <select name="platform" id="platform" required
                        class="form-input w-full px-4 py-2.5 rounded-xl text-sm">
                        <option value="">Pilih platform...</option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->code }}" {{ old('platform') == $platform->code ? 'selected' : '' }}>
                                {{ $platform->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-divider"></div>

                <!-- Submit Button -->
                <button type="submit"
                    class="btn-submit w-full text-white px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">
                    Simpan Postingan
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <p class="text-xs text-slate-500">&copy; {{ date('Y') }} MAN 2 Bantul</p>
        </div>
    </div>

    <script>
        const platformData = @json($platformJson);

        function extractLink() {
            const linkInput = document.getElementById('link');
            const titleInput = document.getElementById('title');
            const dateInput = document.getElementById('date_posted');
            const platformSelect = document.getElementById('platform');
            const categorySelect = document.getElementById('category');
            const status = document.getElementById('extractStatus');
            const button = document.getElementById('extractBtn');

            const url = linkInput.value;
            if (!url) return alert('Masukkan link terlebih dahulu.');

            // Auto-detect platform & category from database
            const matched = platformData.find(p => url.includes(p.domain));
            if (matched) {
                platformSelect.value = matched.code;
                categorySelect.value = matched.category;
            }

            // Show loading
            status.classList.remove('hidden');
            status.innerHTML = '<span class="inline-block animate-spin mr-1">⏳</span> Mengambil data...';
            button.disabled = true;
            button.style.opacity = '0.6';

            fetch(`/extract?url=${encodeURIComponent(url)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.title) titleInput.value = data.title;
                    if (data.date_posted) dateInput.value = data.date_posted;
                    status.innerHTML = '✅ Data berhasil diambil';
                    status.className = 'text-xs text-emerald-400 mt-2 status-badge';
                })
                .catch(() => {
                    status.innerHTML = '❌ Gagal mengambil data dari link.';
                    status.className = 'text-xs text-red-400 mt-2 status-badge';
                })
                .finally(() => {
                    button.disabled = false;
                    button.style.opacity = '1';
                    setTimeout(() => {
                        status.classList.add('hidden');
                        status.className = 'text-xs text-slate-400 italic mt-2 hidden status-badge';
                    }, 3000);
                });
        }
    </script>
</body>

</html>