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
    public $status = 'Pending'; // Default status to 'Pending'

    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category' => 'required|string|max:100',
        'condition' => 'nullable|string|max:100',
        'photos' => 'nullable|array',
        'brand' => 'nullable|string|max:100',
        'description' => 'nullable|string',
        'tags' => 'nullable|string',
        'status' => 'in:Pending,Sold',  // Ensure status is either Pending or Sold
    ];

    public function store()
    {
        $this->validate();  // Validate input data

        $photoPaths = [];
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $photoPaths[] = $photo->store('sale_posts', 'public'); // Store in 'storage/app/public/sale_posts'
            }
        }

        // Create a new SalePost record
        SalePost::create([
            'title' => $this->title,
            'price' => $this->price,
            'category' => $this->category,
            'condition' => $this->condition,
            'photos' => json_encode($photoPaths), // Store the photo paths as a JSON array
            'brand' => $this->brand,
            'description' => $this->description,
            'tags' => $this->tags,
            'status' => $this->status,
            'user_id' => 1,  // Assume user is logged in and save their ID
        ]);

        // Reset fields after submission
        $this->reset();

        // Optionally, you can send a success message
        session()->flash('message', 'Sale post created successfully!');
    }

    #[Title('Create Sale Post | Nine Kiwis - Delowar')] 
    public function render()
    {
        return view('livewire.create-sale-post');
    }
}
