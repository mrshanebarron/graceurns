<?php

namespace Database\Seeders;

use App\Models\Artisan;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\DonationAllocation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $artisans = [
            Artisan::create([
                'name' => 'Maria Gonzalez',
                'specialty' => 'Hand-thrown ceramic urns',
                'bio' => 'Maria has been a ceramic artist for over 20 years in Milwaukee. After experiencing her own loss, she dedicated her craft to creating vessels of remembrance that honor the tiniest lives.',
                'location' => 'Milwaukee, WI',
                'urns_crafted' => 47,
            ]),
            Artisan::create([
                'name' => 'James Whitfield',
                'specialty' => 'Woodturned memorial boxes',
                'bio' => 'James works with reclaimed hardwoods to create one-of-a-kind memorial keepsakes. Each piece carries the warmth of natural wood grain, unique as the life it honors.',
                'location' => 'Waukesha, WI',
                'urns_crafted' => 31,
            ]),
            Artisan::create([
                'name' => 'Sarah Chen',
                'specialty' => 'Glass-blown memorial vessels',
                'bio' => 'Sarah creates delicate glass vessels that capture light the way memory captures love. Her work transforms grief into something you can hold.',
                'location' => 'Racine, WI',
                'urns_crafted' => 23,
            ]),
        ];

        $springCampaign = Campaign::create([
            'title' => 'Spring of Hope 2026',
            'description' => 'Our flagship spring campaign to provide 50 handcrafted memorial urns to mothers in the Milwaukee area who have experienced miscarriage. Every urn is made with love by local artisans and delivered with a personal note of compassion.',
            'slug' => 'spring-of-hope-2026',
            'goal_amount' => 7500,
            'raised_amount' => 4825,
            'start_date' => '2026-01-15',
            'end_date' => '2026-04-30',
            'is_active' => true,
            'is_featured' => true,
            'urns_funded' => 32,
        ]);

        $hospitalPartnership = Campaign::create([
            'title' => 'Hospital Partnership Program',
            'description' => 'Partnering with three Milwaukee-area hospitals to ensure every mother who experiences a loss has access to a beautifully crafted urn at no cost. This program trains hospital staff in compassionate delivery.',
            'slug' => 'hospital-partnership',
            'goal_amount' => 12000,
            'raised_amount' => 3240,
            'start_date' => '2026-02-01',
            'end_date' => '2026-12-31',
            'is_active' => true,
            'is_featured' => false,
            'urns_funded' => 14,
        ]);

        $artisanGrant = Campaign::create([
            'title' => 'Artisan Support Fund',
            'description' => 'Supporting our artisans with materials, workspace, and fair compensation. When we invest in our makers, the quality of every urn reflects that care.',
            'slug' => 'artisan-support-fund',
            'goal_amount' => 5000,
            'raised_amount' => 5000,
            'start_date' => '2025-10-01',
            'end_date' => '2026-01-31',
            'is_active' => false,
            'is_featured' => false,
            'urns_funded' => 0,
        ]);

        $donations = [
            ['donor_name' => 'Rebecca Thornton', 'amount' => 500, 'message' => 'In memory of my angel, Lily. May these urns bring comfort to other mamas.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-01-16 09:15:00'],
            ['donor_name' => 'Michael & Dawn Harris', 'amount' => 250, 'message' => 'No mother should grieve without something beautiful to hold.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-01-18 14:30:00'],
            ['donor_name' => 'Anonymous', 'amount' => 1000, 'is_anonymous' => true, 'campaign_id' => $springCampaign->id, 'created_at' => '2026-01-22 11:00:00'],
            ['donor_name' => 'St. Luke\'s Women\'s Group', 'amount' => 750, 'message' => 'From our congregation with love and prayer.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-01-28 16:45:00'],
            ['donor_name' => 'Jennifer Okafor', 'amount' => 150, 'message' => 'For Baby James, always in my heart.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-02-02 08:20:00'],
            ['donor_name' => 'The Bergstrom Family', 'amount' => 300, 'message' => 'Grateful to support this mission.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-02-05 13:10:00'],
            ['donor_name' => 'Nurses of Aurora Sinai', 'amount' => 425, 'message' => 'We see these mothers every day. This matters more than words can say.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-02-08 10:00:00'],
            ['donor_name' => 'David Park', 'amount' => 200, 'message' => null, 'campaign_id' => $springCampaign->id, 'created_at' => '2026-02-10 17:30:00'],
            ['donor_name' => 'Emily Svensson', 'amount' => 100, 'message' => 'Small gift, big love.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-02-12 09:45:00'],
            ['donor_name' => 'Milwaukee Makers Collective', 'amount' => 650, 'message' => 'Artists supporting artists, for the families who need us.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-02-14 12:00:00'],
            ['donor_name' => 'Grace Foundation', 'amount' => 500, 'message' => 'Proud to support transparent giving.', 'campaign_id' => $springCampaign->id, 'created_at' => '2026-02-15 14:20:00'],
            ['donor_name' => 'Dr. Amanda Reyes', 'amount' => 1000, 'message' => 'As an OB-GYN, I\'ve seen firsthand how much these urns mean.', 'campaign_id' => $hospitalPartnership->id, 'created_at' => '2026-02-03 09:00:00'],
            ['donor_name' => 'Froedtert Health Foundation', 'amount' => 1500, 'message' => 'Supporting compassionate care for families.', 'campaign_id' => $hospitalPartnership->id, 'created_at' => '2026-02-07 11:15:00'],
            ['donor_name' => 'Anonymous', 'amount' => 240, 'is_anonymous' => true, 'campaign_id' => $hospitalPartnership->id, 'created_at' => '2026-02-09 15:30:00'],
            ['donor_name' => 'Karen & Tom Schultz', 'amount' => 500, 'message' => 'In loving memory of our grandchild.', 'campaign_id' => $hospitalPartnership->id, 'created_at' => '2026-02-11 10:45:00'],
            ['donor_name' => 'Arts Council of Milwaukee', 'amount' => 2000, 'campaign_id' => $artisanGrant->id, 'created_at' => '2025-10-15 10:00:00'],
            ['donor_name' => 'Maker Space Milwaukee', 'amount' => 1500, 'campaign_id' => $artisanGrant->id, 'created_at' => '2025-11-01 14:00:00'],
            ['donor_name' => 'Anonymous', 'amount' => 1500, 'is_anonymous' => true, 'campaign_id' => $artisanGrant->id, 'created_at' => '2025-12-20 09:30:00'],
        ];

        foreach ($donations as $data) {
            Donation::create(array_merge(['is_anonymous' => false, 'status' => 'completed'], $data));
        }

        $allocationCategories = [
            ['category' => 'Urn Materials', 'description' => 'Clay, glaze, kiln firing for ceramic memorial urn', 'amount' => 35],
            ['category' => 'Artisan Labor', 'description' => 'Fair compensation for skilled artisan craftsmanship', 'amount' => 65],
            ['category' => 'Personalization', 'description' => 'Custom engraving, name inscription, date memorialization', 'amount' => 20],
            ['category' => 'Keepsake Package', 'description' => 'Silk lining, memory card, pressed flower, comfort letter', 'amount' => 15],
            ['category' => 'Delivery', 'description' => 'Careful hand-delivery to family with compassion training', 'amount' => 15],
        ];

        $completedDonations = Donation::where('campaign_id', $springCampaign->id)->get();
        foreach ($completedDonations as $donation) {
            $remaining = $donation->amount;
            foreach ($allocationCategories as $cat) {
                $allocationAmount = min($remaining, $cat['amount']);
                if ($allocationAmount <= 0) break;

                DonationAllocation::create([
                    'donation_id' => $donation->id,
                    'category' => $cat['category'],
                    'amount' => $allocationAmount,
                    'description' => $cat['description'],
                    'status' => $donation->created_at < now()->subDays(7) ? 'fulfilled' : 'allocated',
                    'fulfilled_at' => $donation->created_at < now()->subDays(7) ? now()->subDays(rand(1, 5)) : null,
                    'recipient_name' => $donation->created_at < now()->subDays(7) ? $artisans[array_rand($artisans)]->name : null,
                ]);

                $remaining -= $allocationAmount;
            }
        }
    }
}
