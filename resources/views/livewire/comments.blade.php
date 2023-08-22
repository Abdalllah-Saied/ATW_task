<div>

    <input type="text" wire:model="newCommentBody">
    <div>
        <button wire:click="addCommint">add</button>
    </div>
</div>
<div>
@foreach($comments as $comment)
        <div>
            <h1>{{$comment->body}}</h1>
            <h3>{{$comment->created_at->diffForHumans()}}</h3>
            <p>{{$comment->creator}}</p>
        </div>
    @endforeach
</div>

