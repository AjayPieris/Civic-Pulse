<!DOCTYPE html>
<html lang="en" x-data="{ scrolled: false }" x-init="
    const onScroll = () => { scrolled = window.scrollY > 8 }
    window.addEventListener('scroll', onScroll);
    onScroll();
">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CivicPulse - @yield('title', 'Community App')</title>

    <!-- Import your font (Google Fonts example: Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Replace family=Inter:wght@... with any font you prefer, e.g., 'Outfit' -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configure Tailwind to use your font globally -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              // set primary app font
              sans: ['Outfit', 'ui-sans-serif', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
            },
          },
        },
      }
    </script>

    <!-- Alpine -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <style>
        html { scroll-behavior: smooth; }
        [x-cloak] { display: none !important; }

        /* Keyframes */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes softPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.015); }
            100% { transform: scale(1); }
        }
        .animate-fade-in-up { animation: fadeInUp 400ms ease-out forwards; }
        .animate-soft-pulse { animation: softPulse 3000ms ease-in-out infinite; }

        @media (prefers-reduced-motion: reduce) {
            .animate-fade-in-up,
            .animate-soft-pulse { animation: none !important; }
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased font-sans">

    <!-- Background gradient decoration -->
    <div aria-hidden="true" class="fixed inset-0 -z-10">
        <div class="pointer-events-none absolute inset-0 opacity-30">
            <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 blur-3xl"></div>
            <div class="absolute top-1/3 -right-24 h-96 w-96 rounded-full bg-gradient-to-tr from-cyan-500 via-sky-600 to-blue-700 blur-3xl"></div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/80"></div>
    </div>

    <nav class="sticky top-0 z-50 backdrop-blur-md transition-all"
         :class="scrolled ? 'bg-slate-900/70 shadow-lg shadow-black/20' : 'bg-slate-900/40 shadow-none'">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex h-16 items-center justify-between">
                <a href="/"
                   class="group inline-flex items-center gap-2 font-bold text-xl tracking-tight">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-md shadow-blue-900/30 ring-1 ring-white/10">
                        📢
                    </span>
                    <span class="bg-gradient-to-r from-blue-200 to-cyan-200 bg-clip-text text-transparent">
                        CivicPulse
                    </span>
                    <span class="ml-2 hidden text-xs text-slate-400 sm:inline group-hover:text-slate-300 transition-colors">
                        Community App
                    </span>
                </a>

                <div class="flex items-center gap-2 sm:gap-3">
                    @auth
                        <span class="hidden sm:inline text-sm text-slate-300">
                            Hi,
                            @if (auth()->user()->is_admin)
                            <span class="font-semibold text-slate-100">Admin</span>
                            @else
                            <span class="font-semibold text-slate-100">{{ auth()->user()->name }}</span>
                            @endif
                        </span>

                        @unless(auth()->user()->is_admin)
                            <a href="/issues/create"
                               class="inline-flex items-center gap-2 rounded-full bg-white/95 px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-white hover:shadow-md hover:shadow-blue-900/20 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Report
                            </a>
                        @endunless

                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center rounded-full border border-white/15 bg-transparent px-3 py-1.5 text-sm font-medium text-slate-200 hover:border-white/30 hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/30 focus:ring-offset-slate-900">
                                Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="/login"
                           class="inline-flex items-center rounded-full px-3 py-1.5 text-sm font-medium text-slate-200 hover:text-white hover:bg-white/5 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/30 focus:ring-offset-slate-900">
                            Login
                        </a>
                        <a href="/register"
                           class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:from-blue-500 hover:to-indigo-500 hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900">
                            <span class="hidden sm:inline">Get Started</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-4 sm:w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M12.293 5.293a1 1 0 011.414 0L17 8.586a2 2 0 010 2.828l-3.293 3.293a1 1 0 01-1.414-1.414L14.586 11H7a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"/>
                            </svg>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto mt-8 px-4 sm:px-6">
        @if (session('success'))
            <div x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 3200)"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                 class="relative z-40 mb-6">
                <div class="flex items-center justify-between rounded-xl border border-emerald-400/30 bg-emerald-600/15 px-4 py-3 shadow-sm backdrop-blur">
                    <div class="flex items-center gap-3">
                        <div class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/20 text-emerald-400 ring-1 ring-emerald-400/20">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="text-sm">
                            <strong class="font-semibold text-emerald-300">Success</strong>
                            <span class="ml-2 text-emerald-100/90">{{ session('success') }}</span>
                        </div>
                    </div>
                    <button @click="show = false"
                            class="rounded-md p-1 text-emerald-300 hover:text-emerald-200 hover:bg-emerald-500/10 transition">
                        &times;
                    </button>
                </div>
            </div>
        @endif

        <section class="animate-fade-in-up">
                <div class="px-5 py-6">
                    @yield('content')
                </div>
        </section>
    </main>

    <footer class="mt-12 border-t border-white/10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 text-sm text-slate-400">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} CivicPulse Project. Built with Laravel.</p>
                <div class="flex items-center gap-3">
                    <a href="/issues" class="rounded-md px-3 py-1.5 text-slate-300 hover:text-white hover:bg-white/5 transition">Issues</a>
                    <a href="/about" class="rounded-md px-3 py-1.5 text-slate-300 hover:text-white hover:bg-white/5 transition">About</a>
                    <a href="/contact" class="rounded-md px-3 py-1.5 text-slate-300 hover:text-white hover:bg-white/5 transition">Contact</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>