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
    public $open_state = false;
    public $cant = '10';
    public $sendNewsletter;
    /* public $readyToLoad = false; */

    protected $listeners = ['render' => 'render', 'delete' => 'delete'];

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

    protected $rules = [
        'article.name' => 'required',
        'article.description' => 'required',
        'article.status' => 'nullable',
        'article.laboratory_id' => 'required'
    ];
    
    public function render()
    {
        /* if ($this->readyToLoad){ */
            $laboratories = Laboratory::all();
            $articles = Article::where('name', 'like', '%' . $this->search . '%')
                                    ->orWhere('description', 'like', '%' . $this->search . '%')
                                    ->orderBy($this->sort, $this->direction)
                                    ->paginate($this->cant);
       /*  }else{
            $articles = [];
            $laboratories = [];
        } */

        return view('livewire.list-articles', compact('articles', 'laboratories'));
    }

    /* public function loadArticles()
    {
        $this->readyToLoad = true;
    } */

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
        $this->reset('open_state');
        $this->identificador = rand();
        $this->emit('alert', 'El artículo se actualizó satisfactoriamente');
    }

    public function show(Article $article)
    {
        $this->article = $article;
        $this->open_image = true;
    }

    public function state(Article $article)
    {
        $this->article = $article;
        $this->open_state = true;
    }

    public function delete(Article $article)
    {
        $article->delete();
    }
}
