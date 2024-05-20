@extends('AdminComponents.Layouts.layout')

@section('content')
    <style>
        .file-input-container {
            border: 2px dashed #ccc;
            padding: 20px;
            cursor: pointer;
            width: 200px;
            /* Adjust width as needed */
            height: 200px;
            /* Adjust height as needed */
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .file-input {
            display: none;
            /* Hide the default file input */
        }

        .file-input-text {
            text-align: center;
        }

        .preview-image {
            width: 150px;
            margin-right: 10px;
        }

        .remove-image-btn {
            margin-bottom: 10px;
            position: absolute;
            top: 0;
        }

        .visually-hidden {
            visibility: hidden;
        }

        .hidden {
            display: none;
        }
    </style>

    <div class="container">
        <h1>Add Your Products</h1>

        <form method="POST" action="{{ route('product.store') }}" class="mt-5" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="category">Select Category:</label>
                <select id="category" name="category" class="form-control">
                    <option value="select Category">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control">
            </div>


            <button type="button" id="addImageInput" class="btn btn-secondary my-3">Add Image</button>

            
            <div class="form-group">
                <label for="images" class="mb-2" >Upload Images:</label>
                <div id="imageInputs" class="row mb-3 position-relative gap-4">
                    <div class="file-input-container col-md-3">
                        <label for="fileInput" id="imageBoxText" class="file-input-text">Click to add button to add images.</label>
                        <input id="fileInput" type="file" name="images[]" class="form-control-file mb-2 file-input" onchange="previewImage(event)">
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>


function previewImage(event) {
    const fileInput = event.target;
    const files = fileInput.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(e) {
            const preview = document.createElement('img');
            preview.src = e.target.result;
            preview.classList.add('preview-image');

            const removeButton = document.createElement('button');
            removeButton.textContent = ' x ';
            removeButton.className = 'btn btn-light rounded-3 btn-sm remove-image-btn';
            removeButton.onclick = function() {
                fileInput.parentNode.removeChild(preview);
                fileInput.parentNode.removeChild(removeButton);
                fileInput.value = ''; // Clear the file input
                if (!fileInput.parentNode.querySelector('.preview-image')) {
                    fileInput.parentNode.querySelector('.file-input-text').classList.remove('visually-hidden');
                }
            };

            fileInput.parentNode.insertBefore(preview, fileInput.nextSibling);
            fileInput.parentNode.insertBefore(removeButton, fileInput.nextSibling);

            fileInput.parentNode.querySelector('.file-input-text').classList.add('visually-hidden');
        };

        reader.readAsDataURL(file);
    }
}

const MAX_IMAGE_CONTAINERS = 5;
const imageInputs = document.getElementById('imageInputs');
const addImageInputBtn = document.getElementById('addImageInput');

addImageInputBtn.addEventListener('click', function() {
    if (imageInputs.childElementCount < MAX_IMAGE_CONTAINERS) {
        const fileInputContainer = document.createElement('div');
        fileInputContainer.classList.add('file-input-container');

        const label = document.createElement('label');
        label.htmlFor = 'fileInput_' + (imageInputs.childElementCount + 1); // Unique id for each input
        label.classList.add('file-input-text');
        label.textContent = 'Click or drag and drop to upload';

        const input = document.createElement('input');
        input.id = 'fileInput_' + (imageInputs.childElementCount + 1); // Unique id for each input
        input.type = 'file';
        input.name = 'images[]';
        input.classList.add('form-control-file', 'mb-2', 'file-input');
        input.onchange = previewImage;

        fileInputContainer.appendChild(label);
        fileInputContainer.appendChild(input);

        imageInputs.appendChild(fileInputContainer);

        if (imageInputs.childElementCount === MAX_IMAGE_CONTAINERS) {
            addImageInputBtn.style.display = 'none';
        }
    }
});





    </script>
@endsection
