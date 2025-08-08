@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Super Admin Registration</h2>
    <form method="POST" action="{{ route('superadmin.register') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block mb-1">Name</label>
            <input type="text" name="name" id="name" class="input" required value="{{ old('name') }}">
            @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input type="email" name="email" id="email" class="input" required value="{{ old('email') }}">
            @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-1">Password</label>
            <input type="password" name="password" id="password" class="input" required>
            @error('password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="mb-6">
            <label for="password_confirmation" class="block mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="input" required>
        </div>
        <button type="submit" class="btn-primary w-full">Register</button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('superadmin.login') }}" class="text-blue-600 hover:underline">Already have an account? Login</a>
    </div>
</div>
@endsection