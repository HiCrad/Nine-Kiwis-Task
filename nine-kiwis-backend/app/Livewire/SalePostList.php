<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SalePost;

class SalePostList extends Component
{
    public $salePosts;

    /**
     * Mount the component and load the sale posts from the database.
     *
     * @return void
     */
    public function mount()
    {
        $this->salePosts = SalePost::orderBy('created_at', 'desc')->get();
    }

    /**
     * Update the status of a specific sale post.
     *
     * @param int $postId The ID of the sale post to update.
     * @param string $status The new status to set.
     * 
     * @return void
     */
    public function updateStatus($postId, $status)
    {
        $salePost = SalePost::find($postId);
        $salePost->status = $status;
        $salePost->save();

        $this->salePosts->where('id', $postId)->first()->status = $status;

        session()->flash('message', 'Status updated successfully!');
    }
    
    /**
     * Render the sale post list view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.sale-post-list')->title('Sale Posts | Nine Kiwis | Delowar');
    }
}
