<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management CRUD</title>
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer components {
            .btn-primary {
                @apply bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50;
            }
            .btn-secondary {
                @apply bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50;
            }
            .btn-danger {
                @apply bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50;
            }
            .btn-success {
                @apply bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-opacity-50;
            }
            .input-field {
                @apply block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-300 px-4 py-2 border bg-white text-gray-700;
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-indigo-600 shadow-lg mb-8 animate-fade-in">
        <div class="container mx-auto px-4 max-w-5xl flex justify-between items-center py-4">
            <a href="{{ route('dashboard') }}" class="text-white text-2xl font-extrabold flex items-center">
                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                InventoryPro
            </a>
            <div class="space-x-1 sm:space-x-4 flex">
                <a href="{{ route('dashboard') }}" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md font-medium transition">Dashboard</a>
                <a href="{{ route('products.index') }}" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md font-medium transition">Products</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 pb-8 max-w-5xl animate-fade-in">
        <main class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100 animate-slide-up">
            @yield('content')
        </main>
    </div>
</body>
</html>
