<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'enumerator_id',
        'vendor_name',
        'enterprise_name',
        'contact_person',
        'phone',
        'email',
        'business_address',
        'registered_address',
        'years_in_business',
        'gst_no',
        'certifications',
        'google_drive_folder_id',
    ];

    // Relationships

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function enumerator()
    {
        return $this->belongsTo(User::class, 'enumerator_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function packagingBranding()
    {
        return $this->hasOne(PackagingBranding::class);
    }

    public function pricingMarketing()
    {
        return $this->hasOne(PricingMarketing::class);
    }

    public function qualityComplianceSupport()
    {
        return $this->hasOne(QualityComplianceSupport::class);
    }

    public function photographSample()
    {
        return $this->hasOne(PhotographSample::class);
    }

    public function storytellingNarrative()
    {
        return $this->hasOne(StorytellingNarrative::class);
    }

    public function observationComment()
    {
        return $this->hasOne(ObservationComment::class);
    }
}