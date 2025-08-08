@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10" x-data="{ step: 1, maxStep: 6 }">
    <h1 class="text-2xl font-bold mb-8 text-center">Vendor Entry Form</h1>

    <!-- Progress Bar -->
    <div class="flex items-center mb-8">
        <template x-for="i in maxStep" :key="i">
            <div class="flex-1 flex items-center">
                <div :class="step >= i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400'"
                    class="w-8 h-8 rounded-full flex items-center justify-center font-semibold transition-colors duration-200"
                    x-text="i"></div>
                <div x-show="i < maxStep" class="flex-1 h-1"
                    :class="step > i ? 'bg-blue-600' : 'bg-gray-200'"></div>
            </div>
        </template>
    </div>

    <form method="POST" action="{{ route('vendor.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Step 1: District & Vendor Details -->
        <div x-show="step === 1" x-transition>
            <div class="mb-6">
                <label for="district" class="block font-medium mb-1">District</label>
                <input type="text" name="district" id="district" class="input" value="{{ old('district') }}" placeholder="Enter your district" required>
                @error('district')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="vendor_name" class="block font-medium mb-1">Vendor Name</label>
                    <input type="text" name="vendor_name" id="vendor_name" class="input" value="{{ old('vendor_name') }}" required>
                    @error('vendor_name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="enterprise_name" class="block font-medium mb-1">Enterprise Name</label>
                    <input type="text" name="enterprise_name" id="enterprise_name" class="input" value="{{ old('enterprise_name') }}" required>
                    @error('enterprise_name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="button" class="btn-primary" @click="step++">Next</button>
            </div>
        </div>

        <!-- Step 2: Contact & Address -->
        <div x-show="step === 2" x-transition>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="contact_person" class="block font-medium mb-1">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person" class="input" value="{{ old('contact_person') }}" required>
                </div>
                <div>
                    <label for="phone" class="block font-medium mb-1">Phone</label>
                    <input type="text" name="phone" id="phone" class="input" value="{{ old('phone') }}" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="email" class="block font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email" class="input" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="business_address" class="block font-medium mb-1">Business Address</label>
                    <input type="text" name="business_address" id="business_address" class="input" value="{{ old('business_address') }}">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="registered_address" class="block font-medium mb-1">Registered Address</label>
                    <input type="text" name="registered_address" id="registered_address" class="input" value="{{ old('registered_address') }}">
                </div>
                <div>
                    <label for="years_in_business" class="block font-medium mb-1">Years in Business</label>
                    <input type="number" name="years_in_business" id="years_in_business" class="input" value="{{ old('years_in_business') }}">
                </div>
            </div>
            <div class="flex justify-between mt-6">
                <button type="button" class="btn-secondary" @click="step--">Back</button>
                <button type="button" class="btn-primary" @click="step++">Next</button>
            </div>
        </div>

        <!-- Step 3: Product Details -->
        <div x-show="step === 3" x-transition>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="product_name" class="block font-medium mb-1">Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="input" value="{{ old('product_name') }}">
                </div>
                <div x-data="{ category: '{{ old('product_category') ?? 'Food' }}' }">
                    <label for="product_category" class="block font-medium mb-1">Category</label>
                    <select name="product_category" id="product_category" class="input" x-model="category" required>
                        <option value="Food">Food</option>
                        <option value="Handicraft">Handicraft</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Other">Other</option>
                    </select>
                    <input x-show="category === 'Other'" type="text" name="custom_category" id="custom_category" class="input mt-2" placeholder="Enter your category" value="{{ old('custom_category') }}" x-cloak>
                </div>
            </div>
            <div class="mt-4">
                <label for="product_description" class="block font-medium mb-1">Product Description</label>
                <textarea name="product_description" id="product_description" rows="2" class="input">{{ old('product_description') }}</textarea>
            </div>
            <div class="flex justify-between mt-6">
                <button type="button" class="btn-secondary" @click="step--">Back</button>
                <button type="button" class="btn-primary" @click="step++">Next</button>
            </div>
        </div>

        <!-- Step 4: Photos -->
        <div x-show="step === 4" x-transition>
            <div>
                <label for="product_photos" class="block font-medium mb-1">Product Photos (Upload one or more)</label>
                <input type="file" name="product_photos[]" id="product_photos" class="input" multiple accept="image/*">
            </div>
            <div class="mt-4">
                <label for="packaging_photos" class="block font-medium mb-1">Packaging Photos (Upload one or more)</label>
                <input type="file" name="packaging_photos[]" id="packaging_photos" class="input" multiple accept="image/*">
            </div>
            <div class="mt-4">
                <label for="sampling_notes" class="block font-medium mb-1">Sampling Notes</label>
                <input type="text" name="sampling_notes" id="sampling_notes" class="input" value="{{ old('sampling_notes') }}">
            </div>
            <div class="flex justify-between mt-6">
                <button type="button" class="btn-secondary" @click="step--">Back</button>
                <button type="button" class="btn-primary" @click="step++">Next</button>
            </div>
        </div>

        <!-- Step 5: Storytelling & Narrative -->
        <div x-show="step === 5" x-transition>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="origin_story" class="block font-medium mb-1">Origin Story</label>
                    <input type="text" name="origin_story" id="origin_story" class="input" value="{{ old('origin_story') }}">
                </div>
                <div>
                    <label for="product_backstory" class="block font-medium mb-1">Product Backstory</label>
                    <input type="text" name="product_backstory" id="product_backstory" class="input" value="{{ old('product_backstory') }}">
                </div>
            </div>
            <!-- Add more fields as needed -->
            <div class="flex justify-between mt-6">
                <button type="button" class="btn-secondary" @click="step--">Back</button>
                <button type="button" class="btn-primary" @click="step++">Next</button>
            </div>
        </div>

        <!-- Step 6: Review & Submit -->
        <div x-show="step === 6" x-transition>
            <div>
                <label for="comments" class="block font-medium mb-1">Comments</label>
                <textarea name="comments" id="comments" rows="2" class="input">{{ old('comments') }}</textarea>
            </div>
            <div class="flex justify-between mt-6">
                <button type="button" class="btn-secondary" @click="step--">Back</button>
                <button type="submit" class="btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<!-- Tailwind utility classes for minimal look -->
<style>
.input {
    @apply mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition;
}
.btn-primary {
    @apply bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition;
}
.btn-secondary {
    @apply bg-gray-200 text-gray-700 px-5 py-2 rounded hover:bg-gray-300 transition;
}
</style>
@endsection