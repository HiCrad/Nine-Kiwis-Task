<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SalePost;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

class CreateSalePost extends Component
{
    use WithFileUploads;
    
    public $title;
    public $price;
    public $category;
    public $condition;
    public $photos;
    public $brand;
    public $description;
    public $tags;
    public $status = 'Pending';

    /**
     * Validation rules for the input fields.
     *
     * @var array
     */

    protected $rules = [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category' => 'required|string|max:100',
        'condition' => 'nullable|string|max:100',
        'photos' => 'nullable|array',
        'brand' => 'nullable|string|max:100',
        'description' => 'nullable|string',
        'tags' => 'nullable|string',
        'status' => 'in:Pending,Sold',
    ];

    /**
     * Store the sale post data to the database and handle file uploads.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate();

        $photoPaths = [];
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $photoPaths[] = $photo->store('sale_posts', 'public');
            }
        }

        SalePost::create([
            'title' => $this->title,
            'price' => $this->price,
            'category' => $this->category,
            'condition' => $this->condition,
            'photos' => $photoPaths,
            'brand' => $this->brand,
            'description' => $this->description,
            'tags' => $this->tags,
            'status' => $this->status,
            'user_id' => 1,
        ]);

        $this->reset();

        session()->flash('message', 'Sale post created successfully!');

        return  redirect()->route('sale-posts.index');
    }

    /**
     * Render the create sale post view.
     *
     * @return \Illuminate\View\View
     */
    #[Title('Create Sale Post | Nine Kiwis - Delowar')] 
    public function render()
    {
        return view('livewire.create-sale-post');
    }
}
