
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Super Admin Login</h2>
    <form method="POST" action="{{ route('superadmin.login') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input type="email" name="email" id="email" class="input" required autofocus value="{{ old('email') }}">
            @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-1">Password</label>
            <input type="password" name="password" id="password" class="input" required>
            @error('password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn-primary w-full">Login</button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('superadmin.register') }}" class="text-blue-600 hover:underline">Don't have an account? Register</a>
    </div>
</div>
@endsection