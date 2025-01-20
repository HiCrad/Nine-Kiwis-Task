<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SalePost;

class SalePostList extends Component
{
    public $salePosts;

    public function mount()
    {
        // Get all sale posts
        $this->salePosts = SalePost::all();
    }

    public function updateStatus($postId, $status)
    {
        // Find the sale post and update its status
        $salePost = SalePost::find($postId);
        $salePost->status = $status;
        $salePost->save();

        $this->salePosts->where('id', $postId)->first()->status = $status;

        // Optionally, you can flash a success message here
        session()->flash('message', 'Status updated successfully!');
    }
    public function render()
    {
        return view('livewire.sale-post-list');
    }
}
