@props(["article"])
<div class="reaction-viewers" id="viewers1">
    <div class="reaction-viewers-close" id="viewerClose1" onclick="closeReaction(1)"></div>
    <div class="reaction-viewers-wrapper">
        <div class="reaction-viewer-title">
            <p>You got <span>{{ $article->reactors->count() }}</span> loves for <span>"{{ $article->title }}"</span> </p>
            <button onclick="closeReaction(1)"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="reaction-viewers-lists">
           @foreach ($article->reactors as $reactor )
               <x-reaction-viewer-item :reactor="$reactor" />        
           @endforeach
        </div>
    </div>  
</div>