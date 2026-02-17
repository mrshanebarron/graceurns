<x-layout title="Our Artisans">

    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="text-center mb-14">
            <p class="text-gold font-medium text-sm tracking-widest uppercase mb-2">The Hands Behind the Heart</p>
            <h1 class="font-serif text-3xl md:text-4xl text-charcoal mb-4">Our Artisans</h1>
            <p class="text-charcoal/50 max-w-lg mx-auto">Every urn is handcrafted by a local artisan who brings skill, compassion, and reverence to their work.</p>
        </div>

        <div class="space-y-10">
            @foreach($artisans as $artisan)
            <div class="bg-white rounded-2xl border border-warmth/30 p-8 md:p-12 flex flex-col md:flex-row gap-8 items-start">
                <div class="w-28 h-28 bg-gradient-to-br from-blush/40 to-plum/20 rounded-2xl flex items-center justify-center shrink-0">
                    <span class="font-serif text-4xl text-plum/60">{{ substr($artisan->name, 0, 1) }}</span>
                </div>
                <div class="flex-1">
                    <h2 class="font-serif text-2xl text-charcoal mb-1">{{ $artisan->name }}</h2>
                    <p class="text-rose font-medium text-sm mb-4">{{ $artisan->specialty }}</p>
                    <p class="text-charcoal/60 leading-relaxed mb-6">{{ $artisan->bio }}</p>
                    <div class="flex flex-wrap gap-6 text-sm text-charcoal/40">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $artisan->location }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            {{ $artisan->urns_crafted }} urns crafted
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Become an Artisan CTA --}}
        <div class="mt-16 bg-gradient-to-br from-warmth/50 to-blush/20 rounded-2xl p-10 md:p-14 text-center">
            <h2 class="font-serif text-2xl text-charcoal mb-3">Are You an Artisan?</h2>
            <p class="text-charcoal/50 max-w-md mx-auto mb-6">We're always looking for compassionate makers to join our community. If you craft ceramics, woodwork, glass, or other memorial keepsakes, we'd love to hear from you.</p>
            <a href="{{ route('about') }}" class="inline-block bg-plum text-white px-8 py-3 rounded-full font-medium hover:bg-plum/90 transition-colors">Get in Touch</a>
        </div>
    </section>

</x-layout>
