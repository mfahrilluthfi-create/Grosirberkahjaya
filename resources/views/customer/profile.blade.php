@extends('layouts.master')

@section('title', 'Profil Saya - ElektroMart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Profil Saya</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Menu -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('customer.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-50 text-blue-600">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                    <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pesanan Saya</span>
                    </a>
                    <a href="{{ route('cart') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Keranjang</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-6">Informasi Profil</h2>

                <form action="{{ route('customer.profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">No. Telepon</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="081234567890">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Provinsi</label>
                            <input type="text" name="province" value="{{ old('province', Auth::user()->province) }}"
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Contoh: DKI Jakarta">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Kota/Kabupaten</label>
                            <input type="text" name="city" value="{{ old('city', Auth::user()->city) }}"
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Contoh: Jakarta Selatan">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}"
                                   class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="12345">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="address" rows="3"
                                      class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Masukkan alamat lengkap">{{ old('address', Auth::user()->address) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <h3 class="font-bold mb-4">Ubah Kata Sandi</h3>
                        <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah kata sandi</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Kata Sandi Baru</label>
                                <div class="relative">
                                    <input type="password" name="password" id="newPassword"
                                           class="w-full border rounded px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Minimal 8 karakter">
                                    <button type="button" onclick="togglePassword('newPassword', 'newEyeIcon')"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                        <i class="fas fa-eye" id="newEyeIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="confirmPassword"
                                           class="w-full border rounded px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Ulangi kata sandi baru">
                                    <button type="button" onclick="togglePassword('confirmPassword', 'confirmEyeIcon')"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                        <i class="fas fa-eye" id="confirmEyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg font-semibold">
                            Batal
                        </a>
                    </div>
                </form>
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
