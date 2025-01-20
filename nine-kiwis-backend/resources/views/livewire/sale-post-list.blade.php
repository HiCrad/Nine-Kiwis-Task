<div>
    <h2 class="text-xl font-semibold mb-4">Sale Posts</h2>

    <!-- Display success message -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-white bg-green-500 rounded">
            {{ session('message') }}
        </div>
    @endif

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
                            <button wire:click="updateStatus({{ $post->id }}, '1')" title="Mark as Completed"
                                class="px-2 py-1 text-green-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                  </svg>
                                  
                            </button>
                        @elseif ($post->status == 'Sold')
                            <button wire:click="updateStatus({{ $post->id }}, '0')" title="Mark as Pending"
                                class="px-2 py-1 text-yellow-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                  </svg>
                                  
                            </button>
                        @endif
                        <button  
                            class="px-2 py-1 text-blue-500 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>
                              
                        </button>
                        <button 
                            class="px-2 py-1 text-indigo-500 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                              </svg>
                              
                        </button>
                        <button 
                            class="px-2 py-1 text-red-500 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>
                              
                        </button>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
