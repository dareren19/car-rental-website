
<nav class="bg-white/95 backdrop-blur-sm fixed w-full z-50 shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <!-- Logo -->
            <a href="/"
                class="inline-flex text-xl sm:text-3xl font-extrabold bg-gradient-to-r from-slate-600 to-slate-700 bg-clip-text text-transparent truncate max-w-[200px] sm:max-w-none">
                 Car Rental-Website
            </a>

            <!-- Desktop Menu (hidden on mobile) -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-gray-700 hover:text-slate-600 font-medium transition">Home</a>
                <a href="<?php echo e(route('car.listing')); ?>" class="text-gray-700 hover:text-slate-600 font-medium transition">Cars</a>
                
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>"
                        class="bg-gradient-to-r from-slate-600 to-slate-700 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-lg transition text-sm lg:text-base">
                        Sign In
                    </a>
                    
                <?php endif; ?>
                
                <?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center space-x-4">
                        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-700 hover:text-slate-600 font-medium transition">
                            <?php echo e(Str::limit(Auth::user()->name, 8)); ?>

                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" 
                                class="bg-gradient-to-r from-slate-600 to-slate-700 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-lg transition text-sm lg:text-base">
                                Logout
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="md:hidden text-gray-700 focus:outline-none">
                <svg id="menuOpenIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="menuCloseIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown (hidden by default) -->
        <div id="mobileMenu" class="hidden md:hidden py-4 border-t border-gray-100">
            <div class="flex flex-col space-y-3">
                <a href="/" class="text-gray-700 hover:text-slate-600 font-medium transition py-2 px-4 rounded-lg hover:bg-gray-50">Home</a>
                <a href="<?php echo e(route('car.listing')); ?>" class="text-gray-700 hover:text-slate-600 font-medium transition py-2 px-4 rounded-lg hover:bg-gray-50">Cars</a>
                
                <?php if(auth()->guard()->guest()): ?>
                    <div class="flex flex-col space-y-2 pt-2">
                        <a href="<?php echo e(route('login')); ?>"
                            class="bg-gradient-to-r from-slate-600 to-slate-700 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition text-center">
                            Sign In
                        </a>
                        
                    </div>
                <?php endif; ?>
                
                <?php if(auth()->guard()->check()): ?>
                    <div class="pt-2 border-t border-gray-100">
                        <div class="px-4 py-2">
                            <span class="text-gray-700 font-medium block mb-2">
                                Logged in as: <?php echo e(Auth::user()->name); ?>

                            </span>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" 
                                    class="w-full bg-red-600 text-white px-4 py-3 rounded-full font-semibold hover:bg-red-700 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    // Vanilla JavaScript for mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOpenIcon = document.getElementById('menuOpenIcon');
        const menuCloseIcon = document.getElementById('menuCloseIcon');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                // Toggle menu visibility
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                    menuOpenIcon.classList.add('hidden');
                    menuCloseIcon.classList.remove('hidden');
                    
                    // Optional: Add animation class
                    mobileMenu.classList.add('animate-slideDown');
                } else {
                    mobileMenu.classList.add('hidden');
                    menuOpenIcon.classList.remove('hidden');
                    menuCloseIcon.classList.add('hidden');
                    
                    // Optional: Remove animation class
                    mobileMenu.classList.remove('animate-slideDown');
                }
            });
            
            // Close menu when clicking on a link (optional)
            const menuLinks = mobileMenu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    menuOpenIcon.classList.remove('hidden');
                    menuCloseIcon.classList.add('hidden');
                });
            });
            
            // Close menu when clicking outside (optional)
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuOpenIcon.classList.remove('hidden');
                        menuCloseIcon.classList.add('hidden');
                    }
                }
            });
            
            // Close menu on escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuOpenIcon.classList.remove('hidden');
                        menuCloseIcon.classList.add('hidden');
                    }
                }
            });
        }
    });
</script>

<style>
    /* Optional animation for mobile menu */
    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slideDown {
        animation: slideDown 0.3s ease-out;
    }
</style><?php /**PATH C:\Users\Admin\OneDrive\Desktop\Laravel12-ReactJS-car-rental\resources\views/mainlayouts/nav.blade.php ENDPATH**/ ?>