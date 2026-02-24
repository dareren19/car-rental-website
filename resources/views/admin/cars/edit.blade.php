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
        <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" id="carForm"
            class="bg-white rounded-xl shadow-lg p-8">
            @csrf
            @method('PATCH')
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Brand <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $car->brand) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('brand')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700 mb-2">Model <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="model" id="model" value="{{ old('model', $car->model) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('model')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Specifications -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year <span
                            class="text-red-500">*</span></label>
                    <select name="year" id="year" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        required>
                        {{-- Get the current value (either old input or database) --}}
                        @php
                            $currentYear = old('year', $car->year);
                        @endphp

                        @for ($year = date('Y'); $year >= 2000; $year--)
                            <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    @error('year')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="transmission" class="block text-sm font-medium text-gray-700 mb-2">Transmission <span
                            class="text-red-500">*</span></label>
                    <select name="transmission" id="transmission" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        required>

                        <option value="Automatic"
                            {{ old('transmission', $car->transmission) == 'Automatic' ? 'selected' : '' }}>
                            Automatic
                        </option>
                        <option value="Manual" {{ old('transmission', $car->transmission) == 'Manual' ? 'selected' : '' }}>
                            Manual
                        </option>

                    </select>
                    @error('transmission')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-2">Fuel Type <span
                            class="text-red-500">*</span></label>
                    <select name="fuel_type" id="fuel_type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">Select Fuel Type</option>
                        <option value="Gasoline" {{ old('fuel_type', $car->fuel_type) == 'Gasoline' ? 'selected' : '' }}>
                            Gasoline</option>
                        <option value="Diesel" {{ old('fuel_type', $car->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel
                        </option>

                    </select>
                    @error('fuel_type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Additional Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div>
                    <label for="seats" class="block text-sm font-medium text-gray-700 mb-2">Seats <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="seats" id="seats" value="{{ old('seats', $car->seats) }}"
                        min="2" max="9" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    @error('seats')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="price_per_day" class="block text-sm font-medium text-gray-700 mb-2">Price Per Day (PHP)
                        <span class="text-red-500">*</span></label>
                    <input type="number" name="price_per_day" id="price_per_day"
                        value="{{ old('price_per_day', $car->price_per_day) }}" step="0.01" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    @error('price_per_day')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="rfid_type" class="block text-sm font-medium text-gray-700 mb-2">RFID Type <span
                            class="text-red-500">*</span></label>
                    <select name="rfid_type" id="rfid_type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">Select RFID</option>
                        <option value="None" {{ old('rfid_type', $car->rfid_type) == 'None' ? 'selected' : '' }}>None
                        </option>
                        <option value="Autosweep" {{ old('rfid_type', $car->rfid_type) == 'Autosweep' ? 'selected' : '' }}>
                            Autosweep</option>
                        <option value="Easytrip" {{ old('rfid_type', $car->rfid_type) == 'Easytrip' ? 'selected' : '' }}>
                            Easytrip</option>
                        <option value="Both" {{ old('rfid_type', $car->rfid_type) == 'Both' ? 'selected' : '' }}>Both
                        </option>
                    </select>
                    @error('rfid_type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Status Toggles -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_available" class="sr-only peer" value="1"
                            {{ old('is_available', true) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                    <span class="text-sm font-medium text-gray-700">Available for Rent</span>
                </div>
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" class="sr-only peer" value="1"
                            {{ old('is_featured') ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500">
                        </div>
                    </label>
                    <span class="text-sm font-medium text-gray-700">Featured Car</span>
                </div>
            </div>

            <!-- IMAGE MANAGEMENT SECTION -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                <h2 class="text-xl font-bold mb-4">Manage Images</h2>

                <!-- Existing Images -->
                @if ($car->images->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Current Images</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4" id="existingImages">
                            @foreach ($car->images as $image)
                                <div class="relative group border rounded-lg overflow-hidden"
                                    data-image-id="{{ $image->id }}">
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-32 object-cover">

                                    <!-- Primary Badge -->
                                    @if ($image->is_primary)
                                        <div
                                            class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full flex items-center gap-1">
                                            <i class="fas fa-crown text-xs"></i> Primary
                                        </div>
                                    @endif

                                    <!-- Image Controls -->
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                        @if (!$image->is_primary)
                                            <button type="button" onclick="setPrimary({{ $image->id }})"
                                                class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        @endif

                                        <button type="button" onclick="deleteImage({{ $image->id }})"
                                            class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Hidden inputs for image operations -->
                <input type="hidden" name="primary_image_id" id="primary_image_id" value="">
                <input type="hidden" name="delete_images" id="delete_images" value="">

                <!-- Upload New Images -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-3">Add New Images</h3>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-blue-500 transition-colors"
                        id="dropzone" onclick="document.getElementById('new_images').click()">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                    </div>

                    <input type="file" name="new_images[]" id="new_images" multiple accept="image/*" class="hidden">

                    <!-- Preview for new images -->
                    <div id="newImagePreview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-8">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('description', $car->description) }}</textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t">
                <a href="{{ route('admin.cars.index') }}"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" id="submitBtn"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
let imagesToDelete = [];

// Preview new images
document.getElementById('new_images').addEventListener('change', function(e) {
    const preview = document.getElementById('newImagePreview');
    preview.innerHTML = '';
    
    Array.from(this.files).forEach(file => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                    <span class="absolute bottom-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">New</span>
                `;
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    });
});

// Set primary image
function setPrimary(imageId) {
    if (confirm('Set this as the primary image?')) {
        document.getElementById('primary_image_id').value = imageId;
        
        // Visual feedback
        document.querySelectorAll('[data-image-id]').forEach(div => {
            div.classList.remove('ring-4', 'ring-blue-500');
        });
        document.querySelector(`[data-image-id="${imageId}"]`).classList.add('ring-4', 'ring-blue-500');
        
        // Remove primary badges
        document.querySelectorAll('.absolute.top-2.left-2').forEach(badge => badge.remove());
        
        // Show success message
        alert('Primary image updated! Click Update Car to save.');
    }
}

// Delete image
function deleteImage(imageId) {
    if (confirm('Delete this image?')) {
        imagesToDelete.push(imageId);
        document.getElementById('delete_images').value = imagesToDelete.join(',');
        
        // Visual feedback - hide the image
        const imageDiv = document.querySelector(`[data-image-id="${imageId}"]`);
        imageDiv.style.opacity = '0.5';
        imageDiv.style.pointerEvents = 'none';
        
        // Add deleted overlay
        const overlay = document.createElement('div');
        overlay.className = 'absolute inset-0 bg-red-500 bg-opacity-50 flex items-center justify-center';
        overlay.innerHTML = '<span class="text-white font-bold">Deleted</span>';
        imageDiv.appendChild(overlay);
    }
}

// Drag and drop
const dropzone = document.getElementById('dropzone');
dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('border-blue-500', 'bg-blue-50');
});

dropzone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropzone.classList.remove('border-blue-500', 'bg-blue-50');
});

dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('border-blue-500', 'bg-blue-50');
    
    const files = e.dataTransfer.files;
    document.getElementById('new_images').files = files;
    
    // Trigger preview
    const event = new Event('change', { bubbles: true });
    document.getElementById('new_images').dispatchEvent(event);
});
</script>
@endsection
