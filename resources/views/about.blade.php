<x-layout title="About">

    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-24">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-14">
                <p class="text-rose font-medium text-sm tracking-widest uppercase mb-2">Our Story</p>
                <h1 class="font-serif text-3xl md:text-4xl text-charcoal mb-4">About Grace Urns</h1>
            </div>

            <div class="prose prose-lg max-w-none">
                <div class="bg-white rounded-2xl border border-warmth/30 p-8 md:p-12 mb-10">
                    <h2 class="font-serif text-2xl text-charcoal mb-4">Our Mission</h2>
                    <p class="text-charcoal/60 leading-relaxed mb-4">
                        Grace Urns was born from a simple belief: every mother who experiences the loss of a pregnancy deserves something beautiful to hold. Something crafted with care, given with compassion, at no cost to her.
                    </p>
                    <p class="text-charcoal/60 leading-relaxed mb-4">
                        We connect generous donors with skilled local artisans to create handcrafted memorial urns for mothers in the Milwaukee area. Each urn is unique &mdash; ceramic vessels, woodturned keepsake boxes, glass-blown memorial pieces &mdash; and delivered with a personal note of love.
                    </p>
                    <p class="text-charcoal/60 leading-relaxed">
                        What makes us different is transparency. Every donation is tracked in real time. You can see exactly where your dollar goes &mdash; from materials to artisan compensation to delivery. We believe that trust is earned through openness.
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-warmth/30 p-8 md:p-12 mb-10">
                    <h2 class="font-serif text-2xl text-charcoal mb-4">What We Provide</h2>
                    <div class="space-y-4">
                        @foreach([
                            ['title' => 'Handcrafted Memorial Urn', 'desc' => 'A one-of-a-kind ceramic, wood, or glass urn crafted by a local artisan with decades of experience.'],
                            ['title' => 'Personalization', 'desc' => 'Custom engraving with the baby\'s name, date, or a chosen message. Every life, no matter how brief, deserves to be named.'],
                            ['title' => 'Keepsake Package', 'desc' => 'Silk-lined presentation, a memory card, pressed flowers, and a handwritten letter of comfort.'],
                            ['title' => 'Compassionate Delivery', 'desc' => 'Hand-delivered by a trained volunteer, never shipped. Because these moments deserve presence.'],
                        ] as $item)
                        <div class="flex gap-4">
                            <div class="w-2 h-2 bg-plum rounded-full mt-2.5 shrink-0"></div>
                            <div>
                                <p class="font-medium text-charcoal mb-0.5">{{ $item['title'] }}</p>
                                <p class="text-sm text-charcoal/50">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-warmth/30 p-8 md:p-12 mb-10">
                    <h2 class="font-serif text-2xl text-charcoal mb-4">Our Values</h2>
                    <div class="grid sm:grid-cols-3 gap-6">
                        @foreach([
                            ['value' => 'Empathy', 'desc' => 'We meet grief with compassion, not platitudes. Every interaction is guided by genuine understanding.'],
                            ['value' => 'Respect', 'desc' => 'Every loss matters. We treat each family\'s story with the reverence it deserves, regardless of gestational age.'],
                            ['value' => 'Transparency', 'desc' => 'Complete openness about where every dollar goes. Trust isn\'t claimed &mdash; it\'s demonstrated.'],
                        ] as $value)
                        <div class="text-center">
                            <h3 class="font-serif text-lg text-plum mb-2">{{ $value['value'] }}</h3>
                            <p class="text-sm text-charcoal/50 leading-relaxed">{!! $value['desc'] !!}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gradient-to-br from-plum/5 to-blush/10 rounded-2xl p-8 md:p-12 text-center">
                    <h2 class="font-serif text-2xl text-charcoal mb-3">Get Involved</h2>
                    <p class="text-charcoal/50 max-w-md mx-auto mb-6">Whether you want to donate, volunteer for deliveries, or join as an artisan &mdash; there's a place for you in this mission.</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('donate') }}" class="bg-plum text-white px-8 py-3 rounded-full font-medium hover:bg-plum/90 transition-colors">Make a Donation</a>
                        <a href="{{ route('artisans') }}" class="border-2 border-plum/20 text-plum px-8 py-3 rounded-full font-medium hover:border-plum/40 transition-colors">Meet the Artisans</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout>
