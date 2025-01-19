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
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salePosts as $post)
                <tr>
                    <td class="px-4 py-2 border">{{ $post->title }}</td>
                    <td class="px-4 py-2 border">${{ number_format($post->price, 2) }}</td>
                    <td class="px-4 py-2 border">{{ $post->category }}</td>
                    <td class="px-4 py-2 border text-center">
                        <span class="inline-block px-2 py-1 text-xs font-semibold uppercase rounded-full 
                        {{ $post->status === 'Sold' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                            {{ $post->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border">
                        <!-- Conditionally display buttons based on the current status of the post -->
                        @if ($post->status == 'Pending')
                            <!-- Show the "Sold" button only if the post is in 'Pending' status -->
                            <button wire:click="updateStatus({{ $post->id }}, '0')" 
                                class="px-2 py-1 bg-yellow-500 text-white rounded" disabled>Pending</button>
                            <button wire:click="updateStatus({{ $post->id }}, '1')" 
                                class="px-2 py-1 bg-green-500 text-white rounded">Mark as Sold</button>
                        @elseif ($post->status == 'Sold')
                            <!-- Show the "Pending" button only if the post is in 'Sold' status -->
                            <button wire:click="updateStatus({{ $post->id }}, '0')" 
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Mark as Pending</button>
                            <button wire:click="updateStatus({{ $post->id }}, '1')" 
                                class="px-2 py-1 bg-green-500 text-white rounded" disabled>Sold</button>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
