<x-layout title="Campaigns">

    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="text-center mb-14">
            <p class="text-rose font-medium text-sm tracking-widest uppercase mb-2">Our Campaigns</p>
            <h1 class="font-serif text-3xl md:text-4xl text-charcoal mb-4">Where Your Support Goes</h1>
            <p class="text-charcoal/50 max-w-lg mx-auto">Each campaign has a specific mission. Choose where your donation makes the most impact.</p>
        </div>

        @if($activeCampaigns->count())
        <div class="mb-16">
            <h2 class="font-serif text-xl text-charcoal mb-6 flex items-center gap-2">
                <span class="w-2 h-2 bg-sage rounded-full"></span> Active Campaigns
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($activeCampaigns as $campaign)
                <a href="{{ route('campaign', $campaign->slug) }}" class="bg-white rounded-2xl border border-warmth/30 p-8 hover:shadow-md hover:border-plum/20 transition-all group">
                    @if($campaign->is_featured)
                        <span class="inline-block bg-gold/10 text-gold text-xs font-medium px-3 py-1 rounded-full mb-4">Featured</span>
                    @endif
                    <h3 class="font-serif text-xl text-charcoal mb-2 group-hover:text-plum transition-colors">{{ $campaign->title }}</h3>
                    <p class="text-sm text-charcoal/50 leading-relaxed mb-6">{{ Str::limit($campaign->description, 150) }}</p>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-medium text-plum">${{ number_format($campaign->raised_amount, 0) }}</span>
                            <span class="text-charcoal/40">of ${{ number_format($campaign->goal_amount, 0) }}</span>
                        </div>
                        <div class="h-2.5 bg-warmth/50 rounded-full overflow-hidden">
                            <div class="progress-bar h-full bg-gradient-to-r from-rose to-plum rounded-full" style="width: {{ $campaign->progress_percent }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs text-charcoal/40">
                        <span>{{ $campaign->urns_funded }} urns funded</span>
                        <span>{{ $campaign->donor_count }} donors</span>
                        @if($campaign->end_date)
                            <span>Ends {{ $campaign->end_date->format('M j, Y') }}</span>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        @if($completedCampaigns->count())
        <div>
            <h2 class="font-serif text-xl text-charcoal mb-6 flex items-center gap-2">
                <span class="w-2 h-2 bg-gold rounded-full"></span> Completed Campaigns
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($completedCampaigns as $campaign)
                <a href="{{ route('campaign', $campaign->slug) }}" class="bg-white/50 rounded-2xl border border-warmth/20 p-8 hover:bg-white transition-all group">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-serif text-xl text-charcoal/70 group-hover:text-charcoal transition-colors">{{ $campaign->title }}</h3>
                        <span class="text-xs bg-sage/10 text-sage px-2 py-1 rounded-full">Complete</span>
                    </div>
                    <p class="text-sm text-charcoal/40 leading-relaxed mb-4">{{ Str::limit($campaign->description, 120) }}</p>
                    <div class="h-2 bg-sage/20 rounded-full overflow-hidden">
                        <div class="h-full bg-sage rounded-full w-full"></div>
                    </div>
                    <p class="text-xs text-charcoal/40 mt-2">${{ number_format($campaign->raised_amount, 0) }} raised &middot; {{ $campaign->donor_count }} donors</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </section>

</x-layout>
