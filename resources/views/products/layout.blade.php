<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management Premium</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        dark: '#0f172a',
                        glass: 'rgba(255, 255, 255, 0.05)',
                        glassBorder: 'rgba(255, 255, 255, 0.1)',
                        primary: '#6366f1',
                        accent: '#ec4899'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1)',
                        'slide-up': 'slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .glass-panel {
                @apply bg-glass backdrop-blur-2xl border border-glassBorder shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] rounded-3xl;
            }
            .text-gradient {
                @apply bg-clip-text text-transparent bg-gradient-to-r from-primary via-purple-500 to-accent;
            }
        }
        @layer components {
            .btn-premium {
                @apply relative inline-flex items-center justify-center px-8 py-3 overflow-hidden font-bold text-white transition-all duration-300 bg-gradient-to-r from-primary to-accent rounded-full hover:scale-105 hover:shadow-[0_0_20px_rgba(236,72,153,0.5)] focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-dark;
            }
            .btn-outline {
                @apply relative inline-flex items-center justify-center px-8 py-3 overflow-hidden font-bold text-gray-300 transition-all duration-300 border border-gray-600 rounded-full hover:text-white hover:border-gray-400 hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-dark;
            }
            .input-premium {
                @apply block w-full rounded-2xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-primary focus:ring focus:ring-primary/50 transition duration-300 px-5 py-4 outline-none;
            }
        }
        body {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%);
            background-attachment: fixed;
        }
    </style>
</head>
<body class="font-sans text-gray-200 antialiased min-h-screen relative overflow-x-hidden selection:bg-primary selection:text-white">
    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 w-full h-full pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-primary rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-accent rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob" style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-purple-500 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob" style="animation-delay: 4s;"></div>
    </div>

    <!-- Premium Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-panel border-t-0 border-x-0 rounded-none bg-dark/50 mb-8 animate-fade-in transition-all duration-300">
        <div class="container mx-auto px-6 max-w-7xl flex justify-between items-center py-4">
            <a href="{{ route('dashboard') }}" class="text-3xl font-extrabold flex items-center tracking-tight group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-accent flex items-center justify-center mr-3 group-hover:scale-110 transition-transform shadow-[0_0_15px_rgba(99,102,241,0.5)]">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-white">Nexus<span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent">Inventory</span></span>
            </a>
            <div class="space-x-2 sm:space-x-4 flex items-center bg-white/5 px-2 py-1.5 rounded-full border border-white/10 shadow-inner">
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white hover:bg-white/10 px-5 py-2 rounded-full font-bold transition-all text-sm tracking-wide">Dashboard</a>
                <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white hover:bg-white/10 px-5 py-2 rounded-full font-bold transition-all text-sm tracking-wide">Products</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 pt-32 pb-12 max-w-7xl animate-fade-in">
        <main class="w-full">
            @yield('content')
        </main>
    </div>
</body>
</html>
