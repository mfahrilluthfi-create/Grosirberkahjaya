@extends('layouts.master')

@section('title', 'Daftar - ElektroMart')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <div class="bg-green-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-plus text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Daftar</h2>
                <p class="text-gray-600 mt-2">Buat akun baru</p>
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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Nama lengkap Anda">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="nama@email.com">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">No. Telepon</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                           class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="081234567890">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Kata Sandi *</label>
                    <div class="relative">
                        <input type="password" name="password" id="registerPassword" required
                               class="w-full border rounded px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Minimal 8 karakter">
                        <button type="button" onclick="togglePassword('registerPassword', 'registerEyeIcon')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye" id="registerEyeIcon"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle"></i> Gunakan kombinasi huruf, angka, dan simbol untuk keamanan maksimal
                    </p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Konfirmasi Kata Sandi *</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="confirmPassword" required
                               class="w-full border rounded px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Ulangi kata sandi">
                        <button type="button" onclick="togglePassword('confirmPassword', 'confirmEyeIcon')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye" id="confirmEyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold mb-4">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </button>

                <div class="text-center">
                    <p class="text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
                    </p>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t text-center">
                <p class="text-xs text-gray-500">
                    Dengan mendaftar, Anda menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
                    dan <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> kami
                </p>
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
