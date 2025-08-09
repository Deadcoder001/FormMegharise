@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10" x-data="{ tab: 'gm' }">
    <h1 class="text-3xl font-bold mb-8 text-center">Super Admin Dashboard</h1>

    <!-- Toggle Buttons -->
    <div class="flex justify-center gap-4 mb-8">
        <button
            class="btn-primary"
            :class="{ 'bg-blue-700': tab === 'gm' }"
            @click="tab = 'gm'"
        >
            GM Registration
        </button>
        <button
            class="btn-primary"
            :class="{ 'bg-blue-700': tab === 'vendor' }"
            @click="tab = 'vendor'"
        >
            Add Vendor
        </button>
    </div>

    <!-- GM Registration Form -->
    <div x-data="{
        district: '',
        count: {{ $gmCount ?? 1 }},
        get gmId() {
            let dist = this.district.replace(/\s+/g, '').toUpperCase().substring(0, 4);
            return dist ? `${dist}_GM_${String(this.count).padStart(3, '0')}` : '';
        }
    }"
    class="bg-white p-6 rounded shadow mb-10"
    x-show="tab === 'gm'"
    >
        <h2 class="text-xl font-semibold mb-4">Register a General Manager (GM)</h2>
        <form method="POST" action="{{ route('gm.register') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="gm_name" class="block font-medium mb-1">GM Name</label>
                    <input type="text" name="gm_name" id="gm_name" class="input" required value="{{ old('gm_name') }}">
                    @error('gm_name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label for="gm_email" class="block font-medium mb-1">GM Email</label>
                    <input type="email" name="gm_email" id="gm_email" class="input" required value="{{ old('gm_email') }}">
                    @error('gm_email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label for="gm_district" class="block font-medium mb-1">District</label>
                    <input type="text" name="gm_district" id="gm_district" class="input"
                        x-model="district" required value="{{ old('gm_district') }}">
                    @error('gm_district') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    <div class="mt-2 text-sm text-gray-500" x-show="gmId">
                        <span class="font-semibold">GM ID Preview:</span> <span x-text="gmId"></span>
                    </div>
                </div>
                <div>
                    <label for="gm_password" class="block font-medium mb-1">Password</label>
                    <input type="password" name="gm_password" id="gm_password" class="input" required>
                    @error('gm_password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="btn-primary">Register GM</button>
            </div>
        </form>
    </div>

    <!-- Vendor Entry Form (reuse) -->
    <div x-show="tab === 'vendor'" class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Vendor Entry Form</h2>

    </div>
</div>
@endsection