<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $test;
    public $newCommentBody;
    public $comments;

    public function mount(){

        $this->comments=Comment::all();
    }
    public function addCommint(){
        $createdComment=Comment::create([
            'body'=>$this->newCommentBody,
            'user_id'=>1
        ]);
        $this->comments->prepend($createdComment);

        $this->newCommentBody='';

    }
    public function render()
    {
        return view('livewire.comments');
    }
}
