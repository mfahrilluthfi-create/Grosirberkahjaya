<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ElektroMart - Toko Alat Elektronik Terpercaya')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* animasi muncul halus */
        .fade-enter {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }

        .fade-enter-active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <!-- Top Bar -->
            <div class="flex justify-between items-center py-2 border-b border-blue-500 text-sm">
                <div class="flex gap-4">
                    <span><i class="fas fa-phone"></i> +62 813-7849-0913 </span>
                    <span><i class="fas fa-envelope"></i> info@grosirberkahjaya.com</span>
                </div>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/share/1A2g2Qxc2F/" class="hover:text-blue-200"><i
                            class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/damdmw_?igsh=M2tuOGprbXF5YXpu" class="hover:text-blue-200"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://x.com/farelluth_?t=jxgvV8OqjYwz15GK_isvIQ&s=09" class="hover:text-blue-200"><i
                            class="fab fa-twitter"></i></a>
                    <a href="https://wa.me/qr/5A4KBJ6FKL7YN1" class="hover:text-blue-200"><i
                            class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Main Header -->
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div
                        class="bg-white text-blue-600 w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl">
                        <i class="fas fa-shopping-cart"></i>
                    </div>

                    <span class="text-2xl font-bold">Grosir Berkah Jaya</span>
                </a>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-8">
                    <form action="{{ route('products') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari produk elektronik..."
                            class="w-full px-4 py-2 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <button type="submit" class="absolute right-2 top-2 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('cart') }}" class="relative hover:text-blue-200">
                            <i class="fas fa-shopping-cart text-2xl"></i>
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"
                                id="cart-count">0</span>
                        </a>

                        <!-- ✅ Dropdown diklik -->
                        <div class="relative" id="user-menu">
                            <button id="user-menu-button"
                                class="flex items-center gap-2 hover:text-blue-200 focus:outline-none">
                                <i class="fas fa-user-circle text-2xl"></i>
                                <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            </button>
                            <div id="user-dropdown"
                                class="hidden absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg py-2 z-50 fade-enter">
                                @if (Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
                                    </a>
                                @endif
                                <a href="{{ route('customer.orders') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fas fa-shopping-bag mr-2"></i>Pesanan Saya
                                </a>
                                <a href="{{ route('customer.profile') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Profil
                                </a>
                                <hr class="my-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-200">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-gray-100">
                            Register
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Navigation -->
            <nav class="py-3 border-t border-blue-500">
                <ul class="flex gap-6 justify-center">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-200">Beranda</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-blue-200">Produk</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-blue-200">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-200">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">Grosir Berkah Jaya</h3>
                    <p class="text-gray-400 text-sm">Toko Grosir terpercaya dengan produk berkualitas dan harga
                        terjangkau.</p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Kontak</h3>
                    <ul class="text-gray-400 text-sm space-y-2">
                        <li><i class="fas fa-map-marker-alt"></i> Jl. Simpang Jengkol, Kulim </li>
                        <li><i class="fas fa-phone"></i> +62 813-7849-0913</li>
                        <li><i class="fas fa-envelope"></i> info@grosirberkahjaya.com</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Layanan</h3>
                    <ul class="text-gray-400 text-sm space-y-2">
                        <li><a href="#" class="hover:text-white">Garansi Produk</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Pengembalian</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Media Sosial</h3>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/share/1A2g2Qxc2F/" class="text-2xl hover:text-blue-400"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/damdmw_?igsh=M2tuOGprbXF5YXpu"
                            class="text-2xl hover:text-pink-400"><i class="fab fa-instagram"></i></a>
                        <a href="https://x.com/farelluth_?t=jxgvV8OqjYwz15GK_isvIQ&s=09"
                            class="text-2xl hover:text-blue-300"><i class="fab fa-twitter"></i></a>
                        <a href="https://wa.me/qr/5A4KBJ6FKL7YN1" class="text-2xl hover:text-green-400"><i
                                class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; 2024 ElektroMart. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Update cart count
        function updateCartCount() {
            @auth
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    const countEl = document.getElementById('cart-count');
                    if (countEl) countEl.textContent = data.count;
                });
        @else
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const countEl = document.getElementById('cart-count');
            if (countEl) countEl.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
        @endauth
        }
        updateCartCount();

        // ✅ Dropdown toggle dengan klik
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('user-menu-button');
            const dropdown = document.getElementById('user-dropdown');

            if (menuButton && dropdown) {
                menuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('hidden');
                    if (!dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('fade-enter-active');
                    } else {
                        dropdown.classList.remove('fade-enter-active');
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target) && !menuButton.contains(e.target)) {
                        dropdown.classList.add('hidden');
                        dropdown.classList.remove('fade-enter-active');
                    }
                });
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
