@extends('AdminComponents.Layouts.layout')

@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <div class="container mb-4 w-50">
        <div class=" shadow">
            <div class="card-header">
                <h5 class="card-title">Upload a New Banner</h5>
            </div>
            <div class="card-body">
                <form id="bannerForm">
                    <div class="form-group">
                        <label for="bannerImage">Banner Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bannerImage" accept="image/*" required>
                            <label class="custom-file-label" for="bannerImage">Choose file</label>
                        </div>
                        <div class="mt-3" id="preview">
                            <img id="previewImage" src="#" alt="Image Preview" style="max-width: 50%; display: none;">
                        </div>
                        <div class="mt-3" id="errorMessage" style="color: red; display: none;">
                            The image must have a 16:9 aspect ratio.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Upload Banner</button>
                </form>
            </div>
        </div>
    </div>
    




            <div class="row" id="bannersList">

                @if (count($banners) > 0)
                    @foreach ($banners as $banner)
                        <div class="col-md-4 mb-4">
                            <div class="bg-light p-2 shadow rounded-4 position-relative">
                                <div class=" d-flex justify-content-between      ">
                                    <form method="POST"
                                        action="{{ route('banner.toggle-featured', ['banner' => $banner->id]) }}">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn ">
                                            <i
                                                class='{{ $banner->featured ? 'bi bi-star-fill text-warning  fs-4' : 'bi bi-star text-warning  fs-4' }}'>
                                            </i>
                                        </button>
                                    </form>


                                    <div>
                                        <form method="POST" action="{{ route('banner.delete', $banner->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn "
                                                onclick="return confirm('Are you sure you want to delete this Banner?')"> <i
                                                    class="bi bi-trash fs-3  "></i></button>
                                        </form>
                                    </div>

                                </div>
                                <img src="{{ env('BANNER_DIR') . $banner->image }}" class="w-100 rounded"
                                    alt="Banner Image">
                            </div>
                        </div>
                    @endforeach
                @else
                    <h1>No Banners Uploaded</h1>
                @endif
            </div>
        </div>

        <script>
      $(document).ready(function() {
    const bannerImageInput = $('#bannerImage');
    const previewImage = $('#previewImage');
    const preview = $('#preview');
    const errorMessage = $('#errorMessage');
    const bannerForm = $('#bannerForm');

    // Show file preview
    bannerImageInput.on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    const aspectRatio = this.width / this.height;
                    const tolerance = 0.01; // Define a tolerance
                    if (Math.abs(aspectRatio - 16 / 9) < tolerance) {
                        previewImage.attr('src', e.target.result);
                        previewImage.show();
                        errorMessage.hide();
                    } else {
                        previewImage.hide();
                        errorMessage.show();
                    }
                };
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.hide();
        }
    });

    // Handle form submission with AJAX
    bannerForm.on('submit', function(event) {
        event.preventDefault();
        const formData = new FormData();
        const file = bannerImageInput[0].files[0];

        if (file) {
            formData.append('bannerImage', file);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: '/banners/create',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Reload the image
                    previewImage.attr('src', response.imageUrl);
                }
            });
        }
    });
});

        </script>
    @endsection
