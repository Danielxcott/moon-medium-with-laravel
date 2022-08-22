<div class="post-create-item">
    <label for="{{ $for }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $title }}" class="form-control @error("$title")
    is-invalid
@enderror" id="{{ $for }}" value="">
<x-form.form-error :name="$title" />
  </div>
