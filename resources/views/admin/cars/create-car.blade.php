@extends('admin.layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
            Add New Car
        </h1>
        <p class="mt-2 text-sm text-gray-600">Fill in the details to add a new car to your fleet</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" id="carForm" class="bg-white rounded-xl shadow-lg p-8">
        @csrf

        <!-- Basic Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Brand <span class="text-red-500">*</span></label>
                <input type="text" name="brand" id="brand" value="{{ old('brand') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                @error('brand')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="model" class="block text-sm font-medium text-gray-700 mb-2">Model <span class="text-red-500">*</span></label>
                <input type="text" name="model" id="model" value="{{ old('model') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                @error('model')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Specifications -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year <span class="text-red-500">*</span></label>
                <select name="year" id="year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Year</option>
                    @for($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('year')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="transmission" class="block text-sm font-medium text-gray-700 mb-2">Transmission <span class="text-red-500">*</span></label>
                <select name="transmission" id="transmission" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Transmission</option>
                    <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                </select>
                @error('transmission')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-2">Fuel Type <span class="text-red-500">*</span></label>
                <select name="fuel_type" id="fuel_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Fuel Type</option>
                    <option value="Gasoline" {{ old('fuel_type') == 'Gasoline' ? 'selected' : '' }}>Gasoline</option>
                    <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    
                </select>
                @error('fuel_type')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Additional Details -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div>
                <label for="seats" class="block text-sm font-medium text-gray-700 mb-2">Seats <span class="text-red-500">*</span></label>
                <input type="number" name="seats" id="seats" value="{{ old('seats') }}" min="2" max="9" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                @error('seats')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="price_per_day" class="block text-sm font-medium text-gray-700 mb-2">Price Per Day (PHP) <span class="text-red-500">*</span></label>
                <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day') }}" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                @error('price_per_day')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="rfid_type" class="block text-sm font-medium text-gray-700 mb-2">RFID Type <span class="text-red-500">*</span></label>
                <select name="rfid_type" id="rfid_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select RFID</option>
                    <option value="None" {{ old('rfid_type') == 'None' ? 'selected' : '' }}>None</option>
                    <option value="Autosweep" {{ old('rfid_type') == 'Autosweep' ? 'selected' : '' }}>Autosweep</option>
                    <option value="Easytrip" {{ old('rfid_type') == 'Easytrip' ? 'selected' : '' }}>Easytrip</option>
                    <option value="Both" {{ old('rfid_type') == 'Both' ? 'selected' : '' }}>Both</option>
                </select>
                @error('rfid_type')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            
        </div>

        <!-- Status Toggles -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_available" class="sr-only peer" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
                <span class="text-sm font-medium text-gray-700">Available for Rent</span>
            </div>
            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_featured" class="sr-only peer" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                </label>
                <span class="text-sm font-medium text-gray-700">Featured Car</span>
            </div>
        </div>

        <!-- Enhanced Image Upload Section with Preview -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Car Images <span class="text-red-500">*</span>
            </label>
            <p class="text-xs text-gray-500 mb-3">Upload at least 1 image. First image will be set as primary.</p>
            
            <!-- Image Upload Area -->
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 hover:border-blue-500 transition-colors cursor-pointer text-center" id="dropzone">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="mt-2 text-sm text-gray-600">
                    <span class="font-semibold text-blue-600 hover:text-blue-500">Click to upload</span> or drag and drop
                </p>
                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB each</p>
            </div>
            
            <input type="file" name="images[]" id="images" multiple accept="image/*" class="hidden">

            <!-- Image Preview Grid -->
            <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4"></div>
            
            <!-- Hidden input to store image order -->
            <input type="hidden" name="image_order" id="image_order" value="">
            
            @error('images')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            @error('images.*')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>

        <!-- Description -->
        <div class="mb-8">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('description') }}</textarea>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t">
            <a href="{{ route('admin.cars.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" id="submitBtn" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Add Car
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
(function() {
    'use strict';
    
    // Get all necessary elements
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('images');
    const previewContainer = document.getElementById('imagePreview');
    const form = document.getElementById('carForm');
    
    // Store files array for manipulation
    let selectedFiles = [];
    
    // Check if elements exist
    if (!dropzone || !fileInput || !previewContainer) {
        console.error('Required elements not found!');
        return;
    }
    
    // Click on dropzone to trigger file input
    dropzone.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.click();
    });
    
    // Handle file selection via input
    fileInput.addEventListener('change', function(e) {
        handleFiles(this.files);
    });
    
    // Handle drag and drop
    dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-blue-500', 'bg-blue-50');
    });
    
    dropzone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-500', 'bg-blue-50');
    });
    
    dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-500', 'bg-blue-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files; // Update the input's files
            handleFiles(files);
        }
    });
    
    // Function to handle files and show previews
    function handleFiles(files) {
        // Clear previous previews
        previewContainer.innerHTML = '';
        selectedFiles = Array.from(files);
        
        if (selectedFiles.length === 0) {
            return;
        }
        
        // Show preview for each file
        selectedFiles.forEach((file, index) => {
            if (!file.type.startsWith('image/')) {
                return; // Skip non-image files
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Create preview container
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative group';
                previewDiv.dataset.index = index;
                
                // Create image element
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-32 object-cover rounded-lg border-2 ' + 
                    (index === 0 ? 'border-blue-500' : 'border-gray-200');
                img.alt = file.name;
                
                // Add primary badge for first image
                if (index === 0) {
                    const badge = document.createElement('div');
                    badge.className = 'absolute top-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full z-10';
                    badge.textContent = 'Primary';
                    previewDiv.appendChild(badge);
                }
                
                // Add filename overlay
                const overlay = document.createElement('div');
                overlay.className = 'absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 truncate rounded-b-lg';
                overlay.textContent = file.name.length > 20 ? file.name.substr(0, 17) + '...' : file.name;
                
                // Add remove button
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity z-10';
                removeBtn.innerHTML = '×';
                removeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Remove from DOM
                    previewDiv.remove();
                    
                    // Remove from selectedFiles array
                    selectedFiles.splice(index, 1);
                    
                    // Update file input with remaining files
                    updateFileInput();
                    
                    // Update primary badge on remaining images
                    updatePrimaryBadge();
                });
                
                // Assemble preview
                previewDiv.appendChild(img);
                previewDiv.appendChild(overlay);
                previewDiv.appendChild(removeBtn);
                previewContainer.appendChild(previewDiv);
            };
            
            reader.readAsDataURL(file);
        });
    }
    
    // Function to update file input with current files
    function updateFileInput() {
        // Create new DataTransfer object
        const dataTransfer = new DataTransfer();
        
        // Add all remaining files
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        
        // Update file input
        fileInput.files = dataTransfer.files;
    }
    
    // Function to update primary badge (first image gets blue border and badge)
    function updatePrimaryBadge() {
        const previews = previewContainer.children;
        
        // Reset all previews
        Array.from(previews).forEach((preview, index) => {
            // Remove existing primary badges
            const existingBadge = preview.querySelector('.absolute.top-2.left-2');
            if (existingBadge && existingBadge.textContent === 'Primary') {
                existingBadge.remove();
            }
            
            // Reset border
            const img = preview.querySelector('img');
            if (img) {
                img.classList.remove('border-blue-500');
                img.classList.add('border-gray-200');
            }
            
            // Add primary badge to first image
            if (index === 0) {
                const badge = document.createElement('div');
                badge.className = 'absolute top-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full z-10';
                badge.textContent = 'Primary';
                preview.appendChild(badge);
                
                if (img) {
                    img.classList.remove('border-gray-200');
                    img.classList.add('border-blue-500');
                }
            }
        });
    }
    
    // Form validation
    form.addEventListener('submit', function(e) {
        if (fileInput.files.length === 0) {
            e.preventDefault();
            alert('Please upload at least one image');
        }
    });
    
})();
</script>

<style>
/* Smooth hover effects for previews */
#imagePreview > div {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

#imagePreview > div:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

/* Ensure images are visible */
#imagePreview img {
    display: block;
    width: 100%;
    height: 8rem;
    object-fit: cover;
}
</style>
@endsection