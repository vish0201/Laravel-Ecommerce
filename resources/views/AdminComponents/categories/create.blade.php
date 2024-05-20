@extends('AdminComponents.Layouts.layout')

@section('content')

<div class="container">
    <h1>{{ isset($category) ? 'Edit' : 'Add' }} Your Category</h1>

    <form method="POST" 
          action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="{{ isset($category) ? $category->name : '' }}">
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ isset($category) ? $category->description : '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            @if(isset($category) && $category->image)
                <div class="mb-2">
                
                    <img class="rounded-circle" id="img-preview" width="40" src="{{ '/'.env('CATEGORY_DIR')  . $category->image }}" alt="Category Image">
                </div>
                <button type="button" id="remove-image-btn" class="btn btn-danger btn-sm">Remove Image</button>
            @endif
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Submit' }}</button>
    </form>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const removeImageButton = document.getElementById('remove-image-btn');
        const imageInput = document.getElementById('image');
        const imagepreview = document.getElementById('img-preview');



        if (removeImageButton) {
            removeImageButton.addEventListener('click', function () {
                removeImageButton.style.display = 'none';
                imagepreview.style.display = "none"
                imageInput.style.display = 'block';
                imageInput.value = '';
            });
        }
    });
</script>
