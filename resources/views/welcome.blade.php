@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-lg w-full text-center">
        <h1 class="text-4xl font-bold mb-6">Welcome!</h1>
        <p class="mb-8 text-lg">Choose your portal to continue.</p>
        <div class="flex flex-col gap-4">
            <a href="{{ route('superadmin.login') }}" class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 px-8 rounded shadow transition">
                Super Admin Login
            </a>
            <a href="{{ route('gm.login') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded shadow transition">
                GM Login
            </a>
            <a href="{{ route('vendor.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded shadow transition">
                Fill Vendor Form
            </a>
        </div>
    </div>
</div>
@endsection