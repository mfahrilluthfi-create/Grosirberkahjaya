<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Grosirberkahjaya')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Top Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="flex justify-between items-center px-6 py-4">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div
                        class="bg-white text-blue-600 w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl">
                        <i class="fas fa-shopping-cart"></i>
                    </div>

                    <span class="text-2xl font-bold">Grosir Berkah Jaya</span>
                </a>
            </div>
            <div class="relative group">
                <button class="flex items-center gap-2 hover:text-blue-200">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span>{{ Auth::user()->name }}</span>
                </button>
            </div>
        </div>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:static inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40 overflow-y-auto">
            <nav class="p-4 h-full">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-tachometer-alt w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 {{ request()->routeIs('admin.products.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-box w-5"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-tags w-5"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 {{ request()->routeIs('admin.orders.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-shopping-bag w-5"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.customers.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 {{ request()->routeIs('admin.customers.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                            <i class="fas fa-users w-5"></i>
                            <span>Pelanggan</span>
                        </a>
                    </li>

                    <li class="pt-4 mt-4 border-t">
                        <a href="{{ route('home') }}" target="_blank"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 text-gray-700">
                            <i class="fas fa-external-link-alt w-5"></i>
                            <span>Lihat Website</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 text-red-600">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 lg:ml-0 overflow-x-hidden">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Close sidebar on outside click (mobile)
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = event.target.closest('button[onclick="toggleSidebar()"]');

            if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
