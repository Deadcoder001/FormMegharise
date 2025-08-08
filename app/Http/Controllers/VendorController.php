<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Vendor;
// Add other models if storing related data
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function create()
    {
        $districts = District::all();
        return view('vendor.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Vendor
            'district_id' => 'required|exists:districts,id',
            'vendor_name' => 'required|string|max:255',
            'enterprise_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'business_address' => 'nullable|string|max:255',
            'registered_address' => 'nullable|string|max:255',
            'years_in_business' => 'nullable|integer',
            'gst_no' => 'nullable|string|max:255',
            'certifications' => 'nullable|string|max:255',
            // Product
            'product_name' => 'nullable|string|max:255',
            'product_category' => 'nullable|string|max:255',
            'product_description' => 'nullable|string',
            'shelf_life' => 'nullable|string|max:255',
            'production_capacity' => 'nullable|string|max:255',
            'current_markets' => 'nullable|string|max:255',
            // Packaging
            'package_variations' => 'nullable|string|max:255',
            'packaging_type_materials' => 'nullable|string|max:255',
            'labeling_details' => 'nullable|string|max:255',
            'existing_branding' => 'nullable|string|max:255',
            'eco_friendly_practices' => 'nullable|string|max:255',
            'packaging_challenges' => 'nullable|string|max:255',
            'preferred_changes' => 'nullable|string|max:255',
            // Pricing & Marketing
            'unit_price' => 'nullable|string|max:255',
            'distribution_channels' => 'nullable|string|max:255',
            'online_presence' => 'nullable|string|max:255',
            'seasonality' => 'nullable|string|max:255',
            // Quality, Compliance & Support
            'certifications_licenses' => 'nullable|string|max:255',
            'quality_challenges' => 'nullable|string|max:255',
            'requested_support' => 'nullable|string|max:255',
            // Photograph/Sample
            'product_photos' => 'nullable|string|max:255',
            'packaging_photos' => 'nullable|string|max:255',
            'sampling_notes' => 'nullable|string|max:255',
            // Storytelling & Narrative
            'origin_story' => 'nullable|string|max:255',
            'product_backstory' => 'nullable|string|max:255',
            'brand_values' => 'nullable|string|max:255',
            'principles' => 'nullable|string|max:255',
            'eco_friendly_narrative' => 'nullable|string|max:255',
            'community_impact' => 'nullable|string|max:255',
            'impact_story' => 'nullable|string|max:255',
            // Observation/Comments
            'comments' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $request) {
            // Create Vendor
            $vendor = Vendor::create([
                'district_id' => $validated['district_id'],
                'vendor_name' => $validated['vendor_name'],
                'enterprise_name' => $validated['enterprise_name'],
                'contact_person' => $validated['contact_person'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'business_address' => $validated['business_address'] ?? null,
                'registered_address' => $validated['registered_address'] ?? null,
                'years_in_business' => $validated['years_in_business'] ?? null,
                'gst_no' => $validated['gst_no'] ?? null,
                'certifications' => $validated['certifications'] ?? null,
            ]);

            // Create Product
            $vendor->products()->create([
                'name' => $validated['product_name'] ?? '',
                'category' => $validated['product_category'] ?? 'food',
                'description' => $validated['product_description'] ?? '',
                'shelf_life' => $validated['shelf_life'] ?? '',
                'production_capacity' => $validated['production_capacity'] ?? '',
                'current_markets' => $validated['current_markets'] ?? '',
            ]);

            // Packaging & Branding
            $vendor->packagingBranding()->create([
                'package_variations' => $validated['package_variations'] ?? '',
                'packaging_type_materials' => $validated['packaging_type_materials'] ?? '',
                'labeling_details' => $validated['labeling_details'] ?? '',
                'existing_branding' => $validated['existing_branding'] ?? '',
                'eco_friendly_practices' => $validated['eco_friendly_practices'] ?? '',
                'packaging_challenges' => $validated['packaging_challenges'] ?? '',
                'preferred_changes' => $validated['preferred_changes'] ?? '',
            ]);

            // Pricing & Marketing
            $vendor->pricingMarketing()->create([
                'unit_price' => $validated['unit_price'] ?? '',
                'distribution_channels' => $validated['distribution_channels'] ?? '',
                'online_presence' => $validated['online_presence'] ?? '',
                'seasonality' => $validated['seasonality'] ?? '',
            ]);

            // Quality, Compliance & Support
            $vendor->qualityComplianceSupport()->create([
                'certifications_licenses' => $validated['certifications_licenses'] ?? '',
                'quality_challenges' => $validated['quality_challenges'] ?? '',
                'requested_support' => $validated['requested_support'] ?? '',
            ]);

            // Photograph/Sample
            $vendor->photographSample()->create([
                'product_photos' => $validated['product_photos'] ?? '',
                'packaging_photos' => $validated['packaging_photos'] ?? '',
                'sampling_notes' => $validated['sampling_notes'] ?? '',
            ]);

            // Storytelling & Narrative
            $vendor->storytellingNarrative()->create([
                'origin_story' => $validated['origin_story'] ?? '',
                'product_backstory' => $validated['product_backstory'] ?? '',
                'brand_values' => $validated['brand_values'] ?? '',
                'principles' => $validated['principles'] ?? '',
                'eco_friendly_practices' => $validated['eco_friendly_narrative'] ?? '',
                'community_impact' => $validated['community_impact'] ?? '',
                'impact_story' => $validated['impact_story'] ?? '',
            ]);

            // Observation/Comments
            $vendor->observationComment()->create([
                'comments' => $validated['comments'] ?? '',
            ]);
        });

        return redirect()->route('vendor.create')->with('success', 'Vendor saved!');
    }
}