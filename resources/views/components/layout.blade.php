<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Grace Urns' }} — Handcrafted Memorial Urns for Angel Babies</title>
    <meta name="description" content="Transparent donation tracking for beautifully crafted memorial urns, given with love to mothers who have experienced miscarriage.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FDF8F0',
                        warmth: '#F5E6D3',
                        blush: '#E8C4B8',
                        rose: '#C4828A',
                        plum: '#6B3A5B',
                        sage: '#7A8B6F',
                        gold: '#C4A265',
                        charcoal: '#2D2A26',
                    },
                    fontFamily: {
                        serif: ['Georgia', 'Cambria', 'Times New Roman', 'serif'],
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        .progress-bar { transition: width 1.5s ease-in-out; }
        .fade-in { animation: fadeIn 0.6s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-cream text-charcoal font-sans antialiased">

    {{-- Navigation --}}
    <nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-sm border-b border-warmth/50 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-rose to-plum rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="font-serif text-xl text-plum tracking-wide">Grace Urns</span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-charcoal/70 hover:text-plum transition-colors {{ request()->routeIs('home') ? 'text-plum' : '' }}">Home</a>
                    <a href="{{ route('campaigns') }}" class="text-sm font-medium text-charcoal/70 hover:text-plum transition-colors {{ request()->routeIs('campaigns') ? 'text-plum' : '' }}">Campaigns</a>
                    <a href="{{ route('transparency') }}" class="text-sm font-medium text-charcoal/70 hover:text-plum transition-colors {{ request()->routeIs('transparency') ? 'text-plum' : '' }}">Transparency</a>
                    <a href="{{ route('artisans') }}" class="text-sm font-medium text-charcoal/70 hover:text-plum transition-colors {{ request()->routeIs('artisans') ? 'text-plum' : '' }}">Our Artisans</a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-charcoal/70 hover:text-plum transition-colors {{ request()->routeIs('about') ? 'text-plum' : '' }}">About</a>
                    <a href="{{ route('donate') }}" class="bg-plum text-white text-sm font-medium px-5 py-2 rounded-full hover:bg-plum/90 transition-colors">Donate</a>
                </div>

                <button @click="open = !open" class="md:hidden p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div x-show="open" x-cloak class="md:hidden pb-4 space-y-2">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-warmth/50">Home</a>
                <a href="{{ route('campaigns') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-warmth/50">Campaigns</a>
                <a href="{{ route('transparency') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-warmth/50">Transparency</a>
                <a href="{{ route('artisans') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-warmth/50">Our Artisans</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-warmth/50">About</a>
                <a href="{{ route('donate') }}" class="block px-3 py-2 text-sm bg-plum text-white rounded-lg text-center">Donate</a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-sage/10 border-b border-sage/20 py-4">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 text-sage text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-charcoal text-white/70 mt-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16">
            <div class="grid md:grid-cols-4 gap-10">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-rose to-plum rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="font-serif text-xl text-white tracking-wide">Grace Urns</span>
                    </div>
                    <p class="text-white/50 text-sm leading-relaxed max-w-sm">
                        Every donation is tracked transparently. Every urn is crafted with love. Every mother deserves something beautiful to hold.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-medium text-sm mb-4 uppercase tracking-wider">Navigate</h4>
                    <div class="space-y-2">
                        <a href="{{ route('campaigns') }}" class="block text-sm hover:text-white transition-colors">Campaigns</a>
                        <a href="{{ route('transparency') }}" class="block text-sm hover:text-white transition-colors">Transparency Report</a>
                        <a href="{{ route('artisans') }}" class="block text-sm hover:text-white transition-colors">Our Artisans</a>
                        <a href="{{ route('about') }}" class="block text-sm hover:text-white transition-colors">About Us</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-medium text-sm mb-4 uppercase tracking-wider">Take Action</h4>
                    <div class="space-y-2">
                        <a href="{{ route('donate') }}" class="block text-sm hover:text-white transition-colors">Make a Donation</a>
                        <a href="{{ route('transparency') }}" class="block text-sm hover:text-white transition-colors">See Where Funds Go</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs text-white/40">&copy; {{ date('Y') }} Grace Urns. Milwaukee, WI. All donations tracked with full transparency.</p>
                <p class="text-xs text-white/30">Built with love &amp; Laravel</p>
            </div>
        </div>
    </footer>

</body>
</html>
