<x-layout :title="$campaign->title">

    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-charcoal/40 mb-8">
            <a href="{{ route('campaigns') }}" class="hover:text-plum transition-colors">Campaigns</a>
            <span>/</span>
            <span class="text-charcoal/60">{{ $campaign->title }}</span>
        </div>

        <div class="grid lg:grid-cols-3 gap-10">
            {{-- Main content --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    @if($campaign->is_active)
                        <span class="text-xs bg-sage/10 text-sage px-3 py-1 rounded-full font-medium">Active</span>
                    @else
                        <span class="text-xs bg-charcoal/5 text-charcoal/50 px-3 py-1 rounded-full font-medium">Completed</span>
                    @endif
                    @if($campaign->is_featured)
                        <span class="text-xs bg-gold/10 text-gold px-3 py-1 rounded-full font-medium">Featured</span>
                    @endif
                </div>

                <h1 class="font-serif text-3xl md:text-4xl text-charcoal mb-4">{{ $campaign->title }}</h1>
                <p class="text-charcoal/60 leading-relaxed mb-8">{{ $campaign->description }}</p>

                {{-- Progress --}}
                <div class="bg-white rounded-xl border border-warmth/30 p-6 mb-8">
                    <div class="flex justify-between text-sm mb-3">
                        <span class="font-serif text-2xl text-plum">${{ number_format($campaign->raised_amount, 0) }}</span>
                        <span class="text-charcoal/50 self-end">of ${{ number_format($campaign->goal_amount, 0) }} goal</span>
                    </div>
                    <div class="h-4 bg-warmth/50 rounded-full overflow-hidden mb-4">
                        <div class="progress-bar h-full bg-gradient-to-r from-rose to-plum rounded-full" style="width: {{ $campaign->progress_percent }}%"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="font-serif text-xl text-charcoal">{{ $campaign->progress_percent }}%</p>
                            <p class="text-xs text-charcoal/40">Funded</p>
                        </div>
                        <div>
                            <p class="font-serif text-xl text-charcoal">{{ $campaign->urns_funded }}</p>
                            <p class="text-xs text-charcoal/40">Urns Funded</p>
                        </div>
                        <div>
                            <p class="font-serif text-xl text-charcoal">{{ $campaign->donor_count }}</p>
                            <p class="text-xs text-charcoal/40">Donors</p>
                        </div>
                    </div>
                </div>

                {{-- Allocation Breakdown --}}
                @if($allocationBreakdown->count())
                <div class="bg-white rounded-xl border border-warmth/30 p-6 mb-8">
                    <h3 class="font-serif text-lg text-charcoal mb-4">Where the Money Goes</h3>
                    <div class="space-y-4">
                        @php $totalAllocation = $allocationBreakdown->sum('total'); @endphp
                        @foreach($allocationBreakdown as $allocation)
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-charcoal/70">{{ $allocation->category }}</span>
                                <span class="font-medium text-charcoal">${{ number_format($allocation->total, 0) }}</span>
                            </div>
                            <div class="h-2 bg-warmth/40 rounded-full overflow-hidden">
                                <div class="h-full bg-sage/60 rounded-full" style="width: {{ $totalAllocation > 0 ? round(($allocation->total / $totalAllocation) * 100) : 0 }}%"></div>
                            </div>
                            <p class="text-xs text-charcoal/30 mt-0.5">{{ $allocation->count }} allocations</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Donation History --}}
                <div>
                    <h3 class="font-serif text-lg text-charcoal mb-4">Donation History</h3>
                    <div class="space-y-3">
                        @foreach($campaign->donations as $donation)
                        <div class="bg-white rounded-xl border border-warmth/30 p-4" x-data="{ showDetails: false }">
                            <div class="flex items-center justify-between cursor-pointer" @click="showDetails = !showDetails">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-plum/5 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-plum" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-sm text-charcoal">{{ $donation->display_name }}</p>
                                        <p class="text-xs text-charcoal/40">{{ $donation->created_at->format('M j, Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-serif text-plum">${{ number_format($donation->amount, 0) }}</span>
                                    <svg class="w-4 h-4 text-charcoal/30 transition-transform" :class="showDetails ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>

                            <div x-show="showDetails" x-cloak class="mt-4 pt-4 border-t border-warmth/30">
                                @if($donation->message)
                                    <p class="text-sm text-charcoal/50 italic mb-3">"{{ $donation->message }}"</p>
                                @endif
                                @if($donation->allocations->count())
                                <p class="text-xs font-medium text-charcoal/60 mb-2 uppercase tracking-wider">Allocation Breakdown</p>
                                <div class="space-y-2">
                                    @foreach($donation->allocations as $allocation)
                                    <div class="flex items-center justify-between text-xs">
                                        <div class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $allocation->status === 'fulfilled' ? 'bg-sage' : 'bg-gold' }}"></span>
                                            <span class="text-charcoal/60">{{ $allocation->category }}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-charcoal/40">{{ ucfirst($allocation->status) }}</span>
                                            <span class="font-medium text-charcoal">${{ number_format($allocation->amount, 2) }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                <div class="sticky top-20 space-y-6">
                    @if($campaign->is_active)
                    <a href="{{ route('donate') }}" class="block bg-plum text-white text-center py-4 rounded-xl font-medium hover:bg-plum/90 transition-colors">
                        Donate to This Campaign
                    </a>
                    @endif

                    <div class="bg-white rounded-xl border border-warmth/30 p-6">
                        <h4 class="font-serif text-charcoal mb-3">Campaign Details</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-charcoal/40">Started</span>
                                <span class="text-charcoal">{{ $campaign->start_date->format('M j, Y') }}</span>
                            </div>
                            @if($campaign->end_date)
                            <div class="flex justify-between">
                                <span class="text-charcoal/40">Ends</span>
                                <span class="text-charcoal">{{ $campaign->end_date->format('M j, Y') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="text-charcoal/40">Status</span>
                                <span class="text-charcoal">{{ $campaign->is_active ? 'Active' : 'Completed' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-plum/5 rounded-xl p-6 text-center">
                        <p class="font-serif text-lg text-plum mb-2">$150</p>
                        <p class="text-xs text-charcoal/50">Average cost to craft, personalize, and deliver one memorial urn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout>
