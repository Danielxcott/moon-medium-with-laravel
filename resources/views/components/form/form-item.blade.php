@props(["for","label","type"=>"text","title","value"=>""])
<div class="post-create-item">
    <label for="{{ $for }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $title }}" class="form-control @error("$title")
    is-invalid @enderror" id="{{ $for }}" value="{{old($title,$value)}}">
<x-form.form-error :name="$title" />
  </div>
