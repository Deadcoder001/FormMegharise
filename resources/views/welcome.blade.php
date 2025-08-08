@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-lg w-full text-center">
        <h1 class="text-4xl font-bold mb-6">Welcome!</h1>
        <p class="mb-8 text-lg">Click below to fill up the Vendor Entry Form.</p>
        <a href="{{ route('vendor.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded shadow transition">
            Fill Vendor Form
        </a>
    </div>
</div>
@endsection