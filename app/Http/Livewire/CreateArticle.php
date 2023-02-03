<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Laboratory;
use Livewire\WithFileUploads;

class CreateArticle extends Component
{
    use WithFileUploads;
    
    public $open = false;
    public $name, $description, $image, $user_id, $laboratory_id, $identificador;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'image' => 'required',
        'laboratory_id' => 'required'
    ];

    public function mount()
    {
        $this->identificador = rand();
    }

    public function save()
    {
        $this->validate();

        $image = $this->image->store('public/articles');

        Article::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $image,
            'user_id' => auth()->id(),
            'laboratory_id' => $this->laboratory_id
        ]);

        $this->reset(['open', 'name', 'description', 'image', 'laboratory_id']);
        $this->identificador = rand();
        $this->emitTo('list-articles', 'render');
        $this->emit('alert', 'El registro se guardó satisfactoriamente!');
    }
    
    public function render()
    {
        $laboratories = Laboratory::all();
        return view('livewire.create-article', compact('laboratories'));
    }
}
