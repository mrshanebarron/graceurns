<x-layout title="Donate">

    <section class="max-w-3xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="text-center mb-12">
            <p class="text-rose font-medium text-sm tracking-widest uppercase mb-2">Make a Difference</p>
            <h1 class="font-serif text-3xl md:text-4xl text-charcoal mb-4">Give the Gift of Grace</h1>
            <p class="text-charcoal/50 max-w-md mx-auto">Your donation funds a handcrafted memorial urn for a mother in grief. Every dollar is tracked with full transparency.</p>
        </div>

        <div class="bg-white rounded-2xl border border-warmth/30 p-8 md:p-12">
            <form action="{{ route('donate.store') }}" method="POST" x-data="{ amount: 150, custom: false }">
                @csrf

                {{-- Campaign Selection --}}
                <div class="mb-8">
                    <label class="block text-sm font-medium text-charcoal mb-3">Choose a Campaign</label>
                    <div class="grid gap-3">
                        @foreach($campaigns as $campaign)
                        <label class="flex items-center gap-4 p-4 rounded-xl border border-warmth/30 cursor-pointer hover:border-plum/30 transition-colors has-[:checked]:border-plum has-[:checked]:bg-plum/5">
                            <input type="radio" name="campaign_id" value="{{ $campaign->id }}" class="text-plum focus:ring-plum" {{ $loop->first ? 'checked' : '' }}>
                            <div class="flex-1">
                                <p class="font-medium text-sm text-charcoal">{{ $campaign->title }}</p>
                                <p class="text-xs text-charcoal/40">{{ $campaign->progress_percent }}% funded &middot; ${{ number_format($campaign->goal_amount - $campaign->raised_amount, 0) }} remaining</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('campaign_id') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Amount Selection --}}
                <div class="mb-8">
                    <label class="block text-sm font-medium text-charcoal mb-3">Donation Amount</label>
                    <div class="grid grid-cols-4 gap-3 mb-3">
                        @foreach([50, 100, 150, 250] as $preset)
                        <button type="button" @click="amount = {{ $preset }}; custom = false"
                            :class="amount === {{ $preset }} && !custom ? 'border-plum bg-plum/5 text-plum' : 'border-warmth/30 text-charcoal/60 hover:border-plum/30'"
                            class="border rounded-xl py-3 text-center font-serif text-lg transition-all">
                            ${{ $preset }}
                        </button>
                        @endforeach
                    </div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-charcoal/40 font-serif text-lg">$</span>
                        <input type="number" name="amount" x-model="amount" @focus="custom = true"
                            class="w-full pl-8 pr-4 py-3 rounded-xl border border-warmth/30 focus:border-plum focus:ring-1 focus:ring-plum/20 font-serif text-lg text-charcoal outline-none"
                            min="1" step="1" placeholder="Custom amount">
                    </div>
                    <p class="text-xs text-charcoal/40 mt-2">$150 funds one complete memorial urn — crafting, personalization, and delivery.</p>
                    @error('amount') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Donor Info --}}
                <div class="mb-8 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Your Name</label>
                        <input type="text" name="donor_name" value="{{ old('donor_name') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-warmth/30 focus:border-plum focus:ring-1 focus:ring-plum/20 text-sm outline-none"
                            placeholder="Your full name">
                        @error('donor_name') <p class="text-rose text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Email <span class="text-charcoal/30">(optional)</span></label>
                        <input type="email" name="donor_email" value="{{ old('donor_email') }}"
                            class="w-full px-4 py-3 rounded-xl border border-warmth/30 focus:border-plum focus:ring-1 focus:ring-plum/20 text-sm outline-none"
                            placeholder="For donation receipt">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Message <span class="text-charcoal/30">(optional)</span></label>
                        <textarea name="message" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-warmth/30 focus:border-plum focus:ring-1 focus:ring-plum/20 text-sm outline-none resize-none"
                            placeholder="A note to share with the community...">{{ old('message') }}</textarea>
                    </div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_anonymous" value="1" class="rounded text-plum focus:ring-plum">
                        <span class="text-sm text-charcoal/60">Make my donation anonymous</span>
                    </label>
                </div>

                {{-- Allocation Preview --}}
                <div class="bg-cream rounded-xl p-6 mb-8">
                    <p class="text-xs font-medium text-charcoal/50 uppercase tracking-wider mb-3">How your donation will be allocated</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Urn Materials</span>
                            <span class="text-charcoal font-medium" x-text="'$' + Math.min(amount, 35).toFixed(0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Artisan Labor</span>
                            <span class="text-charcoal font-medium" x-text="'$' + Math.min(Math.max(amount - 35, 0), 65).toFixed(0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Personalization</span>
                            <span class="text-charcoal font-medium" x-text="'$' + Math.min(Math.max(amount - 100, 0), 20).toFixed(0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Keepsake Package</span>
                            <span class="text-charcoal font-medium" x-text="'$' + Math.min(Math.max(amount - 120, 0), 15).toFixed(0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Delivery</span>
                            <span class="text-charcoal font-medium" x-text="'$' + Math.min(Math.max(amount - 135, 0), 15).toFixed(0)"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-plum text-white py-4 rounded-xl font-medium text-lg hover:bg-plum/90 transition-all hover:shadow-lg hover:shadow-plum/20">
                    Complete Donation
                </button>
                <p class="text-xs text-charcoal/30 text-center mt-3">This is a demo. No real payment will be processed.</p>
            </form>
        </div>
    </section>

</x-layout>
