@props(['label','for','title','categories','value'=>""])
<div class="post-create-item">
    <label for="{{ $for }}">{{ $label }}</label>
    <select name="{{ $title }}" class="form-control form-select" id="{{ $for }}">
        <option value="" selected disabled>Select the category</option>
        @foreach ($categories as $category )
            <option {{ $category->id == old('category',$value) ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <x-form.form-error :name=$title />
  </div>