<div class="mx-3 lg:mx-12 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold text-center mb-6">Create a New Sale Post</h2>

    @if (session()->has('message'))
        <div class="p-4 mb-2 text-white bg-green-500 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" wire:model="title" 
                    placeholder="Enter the title of the sale post" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" wire:model="price" 
                    placeholder="Enter the price" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <input type="text" id="category" wire:model="category" 
                    placeholder="Enter the category of the item" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Condition -->
            <div>
                <label for="condition" class="block text-sm font-medium text-gray-700">Condition</label>
                <input type="text" id="condition" wire:model="condition" 
                    placeholder="Enter the condition (e.g., New, Used)" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('condition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Photos -->
            <div>
                <label for="photos" class="block text-sm font-medium text-gray-700">Photos</label>
                <input type="file" id="photos" wire:model="photos" multiple 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('photos') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Brand -->
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                <input type="text" id="brand" wire:model="brand" 
                    placeholder="Enter the brand name" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('brand') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" wire:model="description" 
                    placeholder="Describe the item in detail" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="4"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Tags -->
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                <input type="text" id="tags" wire:model="tags" 
                    placeholder="Enter tags (separate with commas)" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('tags') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" wire:model="status" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="Pending">Pending</option>
                    <option value="Sold">Sold</option>
                </select>
                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-40 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Create Sale Post</button>
        </div>
    </form>
</div>
