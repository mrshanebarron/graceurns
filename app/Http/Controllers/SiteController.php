<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\DonationAllocation;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $featuredCampaign = Campaign::where('is_featured', true)->where('is_active', true)->first();
        $campaigns = Campaign::where('is_active', true)->get();
        $recentDonations = Donation::with('campaign')->latest()->take(10)->get();
        $artisans = Artisan::where('is_active', true)->get();

        $stats = [
            'total_raised' => Campaign::sum('raised_amount'),
            'total_urns' => Campaign::sum('urns_funded'),
            'total_donors' => Donation::count(),
            'total_artisans' => Artisan::where('is_active', true)->count(),
        ];

        return view('home', compact('featuredCampaign', 'campaigns', 'recentDonations', 'artisans', 'stats'));
    }

    public function campaigns()
    {
        $activeCampaigns = Campaign::where('is_active', true)->get();
        $completedCampaigns = Campaign::where('is_active', false)->get();
        return view('campaigns', compact('activeCampaigns', 'completedCampaigns'));
    }

    public function campaign(Campaign $campaign)
    {
        $campaign->load(['donations' => fn($q) => $q->latest(), 'donations.allocations']);

        $allocationBreakdown = DonationAllocation::whereHas('donation', fn($q) => $q->where('campaign_id', $campaign->id))
            ->selectRaw('category, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        return view('campaign', compact('campaign', 'allocationBreakdown'));
    }

    public function transparency()
    {
        $totalRaised = Donation::sum('amount');
        $totalAllocated = DonationAllocation::sum('amount');

        $categoryBreakdown = DonationAllocation::selectRaw('category, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $statusBreakdown = DonationAllocation::selectRaw('status, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $recentAllocations = DonationAllocation::with('donation.campaign')
            ->latest()
            ->take(20)
            ->get();

        $monthlySummary = Donation::selectRaw("strftime('%Y-%m', created_at) as month, SUM(amount) as total, COUNT(*) as count")
            ->groupBy('month')
            ->orderByDesc('month')
            ->get();

        return view('transparency', compact('totalRaised', 'totalAllocated', 'categoryBreakdown', 'statusBreakdown', 'recentAllocations', 'monthlySummary'));
    }

    public function artisans()
    {
        $artisans = Artisan::where('is_active', true)->get();
        return view('artisans', compact('artisans'));
    }

    public function donate()
    {
        $campaigns = Campaign::where('is_active', true)->get();
        return view('donate', compact('campaigns'));
    }

    public function storeDonation(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'nullable|email|max:255',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string|max:500',
            'is_anonymous' => 'boolean',
        ]);

        $validated['is_anonymous'] = $request->boolean('is_anonymous');
        $validated['status'] = 'completed';

        $donation = Donation::create($validated);

        $campaign = Campaign::find($validated['campaign_id']);
        $campaign->increment('raised_amount', $validated['amount']);

        $allocationCategories = [
            ['category' => 'Urn Materials', 'description' => 'Clay, glaze, kiln firing for ceramic memorial urn', 'amount' => 35],
            ['category' => 'Artisan Labor', 'description' => 'Fair compensation for skilled artisan craftsmanship', 'amount' => 65],
            ['category' => 'Personalization', 'description' => 'Custom engraving, name inscription, date memorialization', 'amount' => 20],
            ['category' => 'Keepsake Package', 'description' => 'Silk lining, memory card, pressed flower, comfort letter', 'amount' => 15],
            ['category' => 'Delivery', 'description' => 'Careful hand-delivery to family with compassion training', 'amount' => 15],
        ];

        $remaining = $donation->amount;
        foreach ($allocationCategories as $cat) {
            $allocationAmount = min($remaining, $cat['amount']);
            if ($allocationAmount <= 0) break;

            DonationAllocation::create([
                'donation_id' => $donation->id,
                'category' => $cat['category'],
                'amount' => $allocationAmount,
                'description' => $cat['description'],
                'status' => 'allocated',
            ]);

            $remaining -= $allocationAmount;
        }

        return redirect()->route('campaign', $campaign->slug)
            ->with('success', 'Thank you for your generous donation. Your gift will help bring comfort to a grieving mother.');
    }

    public function about()
    {
        return view('about');
    }
}
