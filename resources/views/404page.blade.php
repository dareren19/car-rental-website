{{-- resources/views/errors/404-animated.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @keyframes drive {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        .drive-animation {
            animation: drive 8s linear infinite;
        }
        @keyframes flat-tire {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(10px); }
        }
        .flat-tire {
            animation: flat-tire 0.5s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4 overflow-hidden">
    <!-- Road Background -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gray-800">
        <div class="absolute top-0 left-0 right-0 h-1 bg-yellow-400"></div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gray-700"></div>
        <!-- Road Lines -->
        <div class="absolute top-1/2 left-0 right-0 h-1 bg-yellow-400 drive-animation"></div>
    </div>

    <div class="relative z-10 text-center">
        <!-- Broken Car Animation -->
        <div class="mb-8 relative">
            <div class="relative inline-block flat-tire">
                <i class="fas fa-car text-9xl text-red-500"></i>
                <div class="absolute -bottom-4 left-4 w-6 h-6 bg-gray-900 rounded-full border-4 border-gray-700"></div>
                <div class="absolute -bottom-4 right-4 w-6 h-6 bg-gray-900 rounded-full border-4 border-gray-700"></div>
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <i class="fas fa-exclamation-triangle text-4xl text-yellow-500 animate-pulse"></i>
                </div>
            </div>
            <!-- Smoke -->
            <div class="absolute -top-8 right-0 flex gap-1">
                <div class="w-3 h-3 bg-gray-400 rounded-full animate-ping"></div>
                <div class="w-4 h-4 bg-gray-500 rounded-full animate-ping delay-100"></div>
                <div class="w-5 h-5 bg-gray-600 rounded-full animate-ping delay-200"></div>
            </div>
        </div>

        <!-- Error Message -->
        <h1 class="text-8xl font-black text-white mb-4 drop-shadow-2xl">
            4<span class="text-red-500">0</span>4
        </h1>
        
        <h2 class="text-3xl font-bold text-white mb-4">
            Looks like our car broke down!
        </h2>
        
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            The page you're trying to reach is on a road trip. 
            While it's away, check out our available cars!
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            
            <a href="{{ url('/') }}" 
               class="px-8 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-full font-semibold transition transform hover:scale-105 shadow-xl flex items-center justify-center gap-2">
                <i class="fas fa-home"></i>
                Return Home
            </a>
        </div>

        <!-- Roadside Assistance -->
        <div class="inline-block bg-gray-800 px-6 py-3 rounded-full border-2 border-yellow-500">
            <p class="text-yellow-500">
                <i class="fas fa-tools mr-2"></i>
                Roadside Assistance: 
                <a href="/" class="text-white hover:text-yellow-500 ml-1">
                    support@darenmarcdavidcuesta.com
                </a>
            </p>
        </div>

        <!-- Map Pin -->
        <div class="mt-8 text-gray-500">
            <i class="fas fa-map-pin mr-1"></i>
            You are here: Nowhere 404
        </div>
    </div>
</body>
</html>