<x-layout title="Transparency Report">

    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="text-center mb-14">
            <p class="text-sage font-medium text-sm tracking-widest uppercase mb-2">Full Transparency</p>
            <h1 class="font-serif text-3xl md:text-4xl text-charcoal mb-4">Where Every Dollar Goes</h1>
            <p class="text-charcoal/50 max-w-lg mx-auto">We believe in complete transparency. Here is a real-time accounting of every donation and how it has been allocated.</p>
        </div>

        {{-- Summary Cards --}}
        <div class="grid sm:grid-cols-3 gap-6 mb-14">
            <div class="bg-white rounded-xl border border-warmth/30 p-6 text-center">
                <p class="font-serif text-3xl text-plum">${{ number_format($totalRaised, 0) }}</p>
                <p class="text-sm text-charcoal/50 mt-1">Total Donated</p>
            </div>
            <div class="bg-white rounded-xl border border-warmth/30 p-6 text-center">
                <p class="font-serif text-3xl text-sage">${{ number_format($totalAllocated, 0) }}</p>
                <p class="text-sm text-charcoal/50 mt-1">Total Allocated</p>
            </div>
            <div class="bg-white rounded-xl border border-warmth/30 p-6 text-center">
                <p class="font-serif text-3xl text-gold">{{ $totalRaised > 0 ? round(($totalAllocated / $totalRaised) * 100) : 0 }}%</p>
                <p class="text-sm text-charcoal/50 mt-1">Allocation Rate</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-10">
            {{-- Category Breakdown --}}
            <div class="bg-white rounded-xl border border-warmth/30 p-8">
                <h2 class="font-serif text-xl text-charcoal mb-6">Allocation by Category</h2>
                <div class="space-y-5">
                    @php $maxCat = $categoryBreakdown->max('total') ?: 1; @endphp
                    @foreach($categoryBreakdown as $cat)
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-medium text-charcoal">{{ $cat->category }}</span>
                            <span class="text-charcoal/60">${{ number_format($cat->total, 0) }}</span>
                        </div>
                        <div class="h-3 bg-warmth/40 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-1000" style="width: {{ round(($cat->total / $maxCat) * 100) }}%; background: linear-gradient(90deg, #C4828A, #6B3A5B);"></div>
                        </div>
                        <p class="text-xs text-charcoal/30 mt-1">{{ $cat->count }} individual allocations</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Fulfillment Status --}}
            <div>
                <div class="bg-white rounded-xl border border-warmth/30 p-8 mb-6">
                    <h2 class="font-serif text-xl text-charcoal mb-6">Fulfillment Status</h2>
                    <div class="space-y-4">
                        @foreach($statusBreakdown as $status)
                        <div class="flex items-center justify-between p-4 bg-cream rounded-lg">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full {{ $status->status === 'fulfilled' ? 'bg-sage' : ($status->status === 'allocated' ? 'bg-gold' : 'bg-charcoal/20') }}"></span>
                                <span class="font-medium text-sm text-charcoal">{{ ucfirst($status->status) }}</span>
                            </div>
                            <div class="text-right">
                                <p class="font-serif text-charcoal">${{ number_format($status->total, 0) }}</p>
                                <p class="text-xs text-charcoal/40">{{ $status->count }} items</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Monthly Summary --}}
                <div class="bg-white rounded-xl border border-warmth/30 p-8">
                    <h2 class="font-serif text-xl text-charcoal mb-6">Monthly Donations</h2>
                    <div class="space-y-3">
                        @foreach($monthlySummary as $month)
                        <div class="flex items-center justify-between py-2 border-b border-warmth/20 last:border-0">
                            <span class="text-sm text-charcoal/60">{{ \Carbon\Carbon::parse($month->month . '-01')->format('F Y') }}</span>
                            <div class="text-right">
                                <span class="font-serif text-plum">${{ number_format($month->total, 0) }}</span>
                                <span class="text-xs text-charcoal/30 ml-2">({{ $month->count }} donations)</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Allocations --}}
        <div class="mt-14">
            <h2 class="font-serif text-xl text-charcoal mb-6">Recent Allocations</h2>
            <div class="bg-white rounded-xl border border-warmth/30 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-warmth/30 bg-cream/50">
                                <th class="text-left px-6 py-3 font-medium text-charcoal/50 text-xs uppercase tracking-wider">Date</th>
                                <th class="text-left px-6 py-3 font-medium text-charcoal/50 text-xs uppercase tracking-wider">Campaign</th>
                                <th class="text-left px-6 py-3 font-medium text-charcoal/50 text-xs uppercase tracking-wider">Category</th>
                                <th class="text-left px-6 py-3 font-medium text-charcoal/50 text-xs uppercase tracking-wider">Description</th>
                                <th class="text-left px-6 py-3 font-medium text-charcoal/50 text-xs uppercase tracking-wider">Status</th>
                                <th class="text-right px-6 py-3 font-medium text-charcoal/50 text-xs uppercase tracking-wider">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAllocations as $allocation)
                            <tr class="border-b border-warmth/10 hover:bg-cream/30 transition-colors">
                                <td class="px-6 py-3 text-charcoal/60">{{ $allocation->created_at->format('M j') }}</td>
                                <td class="px-6 py-3 text-charcoal/60">{{ $allocation->donation->campaign->title ?? '—' }}</td>
                                <td class="px-6 py-3 text-charcoal font-medium">{{ $allocation->category }}</td>
                                <td class="px-6 py-3 text-charcoal/50">{{ Str::limit($allocation->description, 50) }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center gap-1.5 text-xs">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $allocation->status === 'fulfilled' ? 'bg-sage' : 'bg-gold' }}"></span>
                                        {{ ucfirst($allocation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right font-serif text-charcoal">${{ number_format($allocation->amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</x-layout>
