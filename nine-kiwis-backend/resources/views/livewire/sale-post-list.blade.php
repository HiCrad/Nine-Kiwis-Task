<div class="mx-3 lg:mx-12 p-6 bg-white shadow-md rounded-lg">
    {{-- <h2 class="text-xl font-semibold mb-4">Sale Posts</h2> --}}

    <!-- Display success message -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-white bg-green-500 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Sale Posts</h1>
        <a href="{{ route('sale-posts.create') }}" class="p-2 rounded-md bg-indigo-500 text-white hover:bg-indigo-700 duration-200 ease-linear mt-2 inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>                  
        </a>
    </div>

    <hr class="my-4 border border-gray-300">

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Title</th>
                <th class="px-4 py-2 border">Price</th>
                <th class="px-4 py-2 border">Category</th>
                <th class="px-4 py-2 border">Condition</th>
                <th class="px-4 py-2 border w-40">Status</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salePosts as $post)
                <tr wire:key="sale-post-{{ $post->id }}">
                    <td class="px-4 py-2 border">{{ $post->title }}</td>
                    <td class="px-4 py-2 border text-center">${{ number_format($post->price, 2) }}</td>
                    <td class="px-4 py-2 border text-center">{{ $post->category }}</td>
                    <td class="px-4 py-2 border text-center">{{ $post->condition }}</td>
                    <td class="px-4 py-2 border text-center">
                        <span class="inline-block px-2 py-1 text-xs font-semibold uppercase rounded-full 
                        {{ $post->status === 'Sold' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                            {{ $post->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border flex items-center justify-center">
                        @if ($post->status == 'Pending')
                            <button wire:click="updateStatus({{ $post->id }}, 'Sold')" title="Mark as Completed"
                                class="px-2 py-1 text-green-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                  </svg>
                                  
                            </button>
                        @elseif ($post->status == 'Sold')
                            <button wire:click="updateStatus({{ $post->id }}, 'Pending')" title="Mark as Pending"
                                class="px-2 py-1 text-yellow-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                  </svg>
                                  
                            </button>
                        @endif
                        
                        <a href="{{ $post->status == 'Pending' ? 'https://www.facebook.com/marketplace/create/item' : '#' }}" target="_blank" class="px-2 py-1 {{ $post->status == 'Pending' ? 'bg-blue-500 text-white hover:bg-blue-700' : 'bg-gray-500 text-white cursor-not-allowed' }} duration-200 ease-linear rounded" {{ $post->status == 'Sold' ? 'disabled' : '' }}>Post to Facebook</a>
                        
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
