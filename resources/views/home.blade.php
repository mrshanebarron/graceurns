<x-layout title="Home">

    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-plum/5 via-cream to-blush/20"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 py-20 md:py-32">
            <div class="max-w-2xl">
                <p class="text-rose font-medium text-sm tracking-widest uppercase mb-4">Transparent Giving</p>
                <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-charcoal leading-tight mb-6">
                    Every donation.<br>
                    <span class="text-plum">Every urn.</span><br>
                    Fully transparent.
                </h1>
                <p class="text-charcoal/60 text-lg leading-relaxed mb-8 max-w-lg">
                    We craft beautiful memorial urns for mothers who have experienced miscarriage. You can see exactly where every dollar goes &mdash; in real time.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('donate') }}" class="bg-plum text-white px-8 py-3 rounded-full font-medium hover:bg-plum/90 transition-all hover:shadow-lg hover:shadow-plum/20">
                        Make a Donation
                    </a>
                    <a href="{{ route('transparency') }}" class="border-2 border-plum/20 text-plum px-8 py-3 rounded-full font-medium hover:border-plum/40 transition-all">
                        See the Numbers
                    </a>
                </div>
            </div>
        </div>
        {{-- Decorative element --}}
        <div class="absolute top-20 right-10 w-64 h-64 bg-blush/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-40 w-40 h-40 bg-rose/10 rounded-full blur-2xl"></div>
    </section>

    {{-- Impact Stats --}}
    <section class="bg-white border-y border-warmth/30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="font-serif text-3xl md:text-4xl text-plum">${{ number_format($stats['total_raised'], 0) }}</p>
                    <p class="text-sm text-charcoal/50 mt-1">Total Raised</p>
                </div>
                <div>
                    <p class="font-serif text-3xl md:text-4xl text-plum">{{ $stats['total_urns'] }}</p>
                    <p class="text-sm text-charcoal/50 mt-1">Urns Funded</p>
                </div>
                <div>
                    <p class="font-serif text-3xl md:text-4xl text-plum">{{ $stats['total_donors'] }}</p>
                    <p class="text-sm text-charcoal/50 mt-1">Generous Donors</p>
                </div>
                <div>
                    <p class="font-serif text-3xl md:text-4xl text-plum">{{ $stats['total_artisans'] }}</p>
                    <p class="text-sm text-charcoal/50 mt-1">Local Artisans</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Campaign --}}
    @if($featuredCampaign)
    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="text-center mb-12">
            <p class="text-gold font-medium text-sm tracking-widest uppercase mb-2">Featured Campaign</p>
            <h2 class="font-serif text-3xl md:text-4xl text-charcoal">{{ $featuredCampaign->title }}</h2>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-warmth/30 overflow-hidden">
            <div class="p-8 md:p-12">
                <p class="text-charcoal/60 leading-relaxed mb-8 max-w-2xl">{{ $featuredCampaign->description }}</p>

                <div class="mb-6">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="font-medium text-plum">${{ number_format($featuredCampaign->raised_amount, 0) }} raised</span>
                        <span class="text-charcoal/50">${{ number_format($featuredCampaign->goal_amount, 0) }} goal</span>
                    </div>
                    <div class="h-3 bg-warmth/50 rounded-full overflow-hidden">
                        <div class="progress-bar h-full bg-gradient-to-r from-rose to-plum rounded-full" style="width: {{ $featuredCampaign->progress_percent }}%"></div>
                    </div>
                    <p class="text-xs text-charcoal/40 mt-2">{{ $featuredCampaign->urns_funded }} urns funded so far</p>
                </div>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('donate') }}" class="bg-plum text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-plum/90 transition-colors">
                        Donate to This Campaign
                    </a>
                    <a href="{{ route('campaign', $featuredCampaign->slug) }}" class="text-plum text-sm font-medium px-6 py-2.5 border border-plum/20 rounded-full hover:border-plum/40 transition-colors">
                        View Full Details
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- How It Works --}}
    <section class="bg-white border-y border-warmth/30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
            <div class="text-center mb-14">
                <p class="text-sage font-medium text-sm tracking-widest uppercase mb-2">How It Works</p>
                <h2 class="font-serif text-3xl md:text-4xl text-charcoal">Where Your Donation Goes</h2>
            </div>
            <div class="grid md:grid-cols-5 gap-6">
                @foreach([
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>', 'title' => 'You Donate', 'desc' => 'Choose a campaign and give any amount. Every dollar is tracked.'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>', 'title' => 'We Allocate', 'desc' => 'Funds are divided into materials, labor, personalization, and delivery.'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>', 'title' => 'Artisans Craft', 'desc' => 'Local artisans create each urn by hand with love and care.'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>', 'title' => 'We Deliver', 'desc' => 'Each urn is hand-delivered with a personal note of compassion.'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>', 'title' => 'You See It All', 'desc' => 'Track every allocation in real time on our transparency page.'],
                ] as $step)
                <div class="text-center">
                    <div class="w-14 h-14 bg-plum/5 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-plum" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $step['icon'] !!}</svg>
                    </div>
                    <h3 class="font-serif text-lg text-charcoal mb-2">{{ $step['title'] }}</h3>
                    <p class="text-sm text-charcoal/50 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Recent Donations --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="text-center mb-12">
            <p class="text-rose font-medium text-sm tracking-widest uppercase mb-2">Recent Generosity</p>
            <h2 class="font-serif text-3xl md:text-4xl text-charcoal">Every Gift Matters</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            @foreach($recentDonations as $donation)
            <div class="bg-white rounded-xl border border-warmth/30 p-5 flex items-start gap-4 fade-in">
                <div class="w-10 h-10 bg-plum/5 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-plum" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-baseline justify-between gap-2">
                        <p class="font-medium text-sm text-charcoal truncate">{{ $donation->display_name }}</p>
                        <span class="text-plum font-serif text-sm font-medium shrink-0">${{ number_format($donation->amount, 0) }}</span>
                    </div>
                    <p class="text-xs text-charcoal/40 mt-0.5">{{ $donation->campaign->title }} &middot; {{ $donation->created_at->diffForHumans() }}</p>
                    @if($donation->message)
                        <p class="text-sm text-charcoal/50 mt-1 italic">"{{ Str::limit($donation->message, 80) }}"</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('transparency') }}" class="text-plum text-sm font-medium hover:text-plum/70 transition-colors">
                View Full Transparency Report &rarr;
            </a>
        </div>
    </section>

    {{-- Meet Artisans --}}
    <section class="bg-charcoal text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
            <div class="text-center mb-12">
                <p class="text-gold font-medium text-sm tracking-widest uppercase mb-2">The Hands Behind the Heart</p>
                <h2 class="font-serif text-3xl md:text-4xl text-white">Meet Our Artisans</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($artisans as $artisan)
                <div class="bg-white/5 rounded-2xl border border-white/10 p-8 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-rose/30 to-plum/30 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="font-serif text-2xl text-white">{{ substr($artisan->name, 0, 1) }}</span>
                    </div>
                    <h3 class="font-serif text-xl text-white mb-1">{{ $artisan->name }}</h3>
                    <p class="text-gold text-sm mb-3">{{ $artisan->specialty }}</p>
                    <p class="text-white/50 text-sm leading-relaxed mb-4">{{ Str::limit($artisan->bio, 120) }}</p>
                    <div class="flex items-center justify-center gap-4 text-xs text-white/40">
                        <span>{{ $artisan->location }}</span>
                        <span>&middot;</span>
                        <span>{{ $artisan->urns_crafted }} urns crafted</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('artisans') }}" class="text-gold text-sm font-medium hover:text-gold/70 transition-colors">Learn More About Our Artisans &rarr;</a>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="bg-gradient-to-br from-plum to-plum/80 rounded-3xl p-10 md:p-16 text-center text-white">
            <h2 class="font-serif text-3xl md:text-4xl mb-4">Every Mother Deserves Grace</h2>
            <p class="text-white/70 max-w-lg mx-auto mb-8 leading-relaxed">
                Your donation provides a beautifully crafted memorial urn to a mother in grief. You'll see exactly where your gift goes, every step of the way.
            </p>
            <a href="{{ route('donate') }}" class="inline-block bg-white text-plum px-10 py-3.5 rounded-full font-medium hover:bg-white/90 transition-all hover:shadow-lg">
                Donate Now
            </a>
        </div>
    </section>

</x-layout>
