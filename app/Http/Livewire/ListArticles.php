<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Laboratory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListArticles extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $article, $image, $identificador;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $open_edit = false;
    public $open_image = false;
    public $cant = '10';

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->identificador = rand();
        $this->article = new Article();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'article.name' => 'required',
        'article.description' => 'required',
        'article.laboratory_id' => 'required'
    ];
    
    public function render()
    {
        $laboratories = Laboratory::all();
        
        $articles = Article::where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('description', 'like', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->cant);

        return view('livewire.list-articles', compact('articles', 'laboratories'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Article $article)
    {
        $this->article = $article;
        $this->open_edit = true;
    }
    
    public function update()
    {
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->article->image]);
            $this->article->image = $this->image->store('public/articles');
        }

        $this->article->save();

        $this->reset(['open_edit', 'image']);
        $this->identificador = rand();
        $this->emit('alert', 'El artículo se actualizó satisfactoriamente');
    }

    public function show(Article $article)
    {
        $this->article = $article;
        $this->open_image = true;
    }
}
/* video 15 */