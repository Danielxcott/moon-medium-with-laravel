@props(["for","label","type"=>"text","title","value"=>""])
<div class="post-create-item">
    <label for="{{ $for }}">{{ $label }}</label>
    <textarea type="text" rows="3" class="form-control @error("$title") is-invalid @enderror " name="{{ $title }}" id="{{ $for }}" value="{{ old($title) }}">{{ $value }}</textarea>  
    <x-form.form-error :name="$title" />  
  </div>
