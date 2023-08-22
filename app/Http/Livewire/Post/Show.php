<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;

class Show extends Component
{
    public $title;
    public $content;

    public function mount($post)
    {
        $this->title = $post->title;
        $this->content = $post->content;
    }
    public function render()
    {
        return view('livewire.post.show');
    }
}
