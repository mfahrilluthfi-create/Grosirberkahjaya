{{-- File: resources/views/auth/login.blade.php --}}

@extends('layouts.master')

@section('title', 'Masuk - Grosir Berkah Jaya')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-8">
                    <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shopping-cart text-3xl"></i>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-800">Masuk</h2>
                    <p class="text-gray-600 mt-2">Masuk ke akun Grosir Berkah Jaya Anda</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="nama@email.com">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password" id="loginPassword" required
                                class="w-full border rounded px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan kata sandi">
                            <button type="button" onclick="togglePassword('loginPassword', 'loginEyeIcon')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye" id="loginEyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2">
                            <span class="text-gray-700">Ingat Saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold mb-4">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </button>

                    <div class="text-center">
                        <p class="text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
                        </p>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t">
                    <p class="text-center text-sm text-gray-600 mb-4">Login untuk demo:</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-3 rounded text-xs">
                            <p class="font-semibold mb-1">Admin</p>
                            <p class="text-gray-600">admin@elektromart.com</p>
                            <p class="text-gray-600">password</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded text-xs">
                            <p class="font-semibold mb-1">Pelanggan</p>
                            <p class="text-gray-600">customer@test.com</p>
                            <p class="text-gray-600">password</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
