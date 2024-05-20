@extends('UserComponents.Layouts.layout')

@section('content')
    <style>
        .active-tab {
            background-color: rgba(77, 134, 156, 0.8);
            padding: 7px;
            margin-bottom: 12px;
            border-radius: 4px;
            font-weight: bolder;
        }

        #userProfileImage {
            max-width: 150px;
            max-height: 150px;
            overflow: hidden;
            border-radius: 50%;
        }
    </style>
    <div class="container w-100 mt-5">
        <div class="row justify-content-around">
            <div class="col-12 col-md-3 mb-3 shadow text-center text-light rounded-5"
                style="background-color: rgba(77, 134, 156, 0.5);">
                <div class="object-fit-contain  ">

                    <div class="position-relative">

                        <img id="userProfileImage" src="{{ env('PROFILE_DIR') . $user->profile_picture }}"
                            class=" object-fit-contain       mt-4" alt="">


                        <button style="width: 50px ; height: 50px; " for="filebutton" id="filebutton"
                            class=" position-absolute bottom-0 start-50 ms-4  bg-secondary border-0  image-input rounded-circle ">
                            <i class="bi bi-pen text-light"></i>
                            <input type="file" id="fileInput" name="file" class="d-none" accept=".jpg,.jpeg,.png">
                        </button>


                    </div>


                    <b>{{ $user->firstname }} {{ $user->lastname }}</b>
                    <p>@ {{ $user->username }}</p>
                </div>
                <hr>
                <div class="">
                    <ul class="list-unstyled  text-end ">
                        <li class=" mb-3"><a href="#" class=" tab-link text-decoration-none text-dark   "
                                data-tab="account-information">Account Information</a>
                        </li>
                        <li class=" mb-3"><a href="#" class="tab-link  text-decoration-none text-dark"
                                data-tab="saved">Saved</a></li>
                        <li class=" mb-3"><a href="#" class="tab-link  text-decoration-none text-dark"
                                data-tab="orders">Orders</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-8 shadow text-center text-light rounded-5 tab-content"
                style="background-color: rgba(77, 134, 156, 0.8);">
                <div id="account-information" class="tab-pane p-3">
                    <h2>Account Information</h2>
                    <hr>

                    <div class="text-start">
                        <div class="row">
                            <div class="col-5"><strong>First Name</strong></div>
                            <div class="col-6">
                                <p id="firstnameDisplay">{{ $user->firstname }} </p>
                                <input type="text" id="firstnameInput" style="display: none;"
                                    value="{{ $user->firstname }} ">
                            </div>
                            <div class="col-1">
                                <button class="editButton border-0 rounded-5"> <i class="bi bi-pen"></i> </button>
                                <button class="submitButton border-0 rounded-5" style="display: none;">Submit</button>
                            </div>
                        </div>

                        <hr class="hrline mt-1">
                        <div class="row">
                            <div class="col-5"><strong>Last Name</strong></div>
                            <div class="col-6">
                                <p id="lastnameDisplay">{{ $user->lastname }}</p>
                                <input type="text" id="lastnameInput" style="display: none;"
                                    value="{{ $user->lastname }}">
                            </div>
                            <div class="col-1">
                                <button class="editButton border-0 rounded-5"> <i class="bi bi-pen"></i> </button>
                                <button class="submitButton border-0 rounded-5" style="display: none;">Submit</button>
                            </div>
                        </div>


                        <hr class="hrline mt-1">
                        <div class="row">
                            <div class="col-5"><strong>Username</strong></div>
                            <div class="col-6">
                                <p id="usernameDisplay">{{ $user->username }}</p>
                                <input type="text" id="usernameInput" style="display: none;"
                                    value="{{ $user->username }}">
                            </div>
                            <div class="col-1">
                                <button class="editButton border-0 rounded-5"> <i class="bi bi-pen"></i> </button>
                                <button class="submitButton border-0 rounded-5" style="display: none;">Submit</button>
                            </div>
                        </div>
                        <hr class="hrline mt-1">
                        <div class="row">
                            <div class="col-5"><strong>Email</strong></div>
                            <div class="col-6">
                                <p id="emailDisplay">{{ $user->email }}</p>
                                <input type="text" id="emailInput" style="display: none;" value="{{ $user->email }}">
                            </div>
                            <div class="col-1">

                                <button class="editButton border-0 rounded-5"> <i class="bi bi-pen"></i> </button>
                                <button class="submitButton border-0 rounded-5" style="display: none;">Submit</button>
                            </div>
                        </div>
                        <hr class="hrline mt-1">
                        <div class="row">
                            <div class="col-5"><strong>User Since</strong></div>
                            <div class="col-6">
                                <p id="userSinceDisplay">{{ (($user->created_at))->format('d / m / y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="saved" class="tab-pane p-3">
                    <h2>Saved</h2>
                    <div class="row">
                        @foreach ($savedProducts as $savedProduct)
                            <div class="col-md-4 mb-4">
                                <div class="card product-card h-100 position-relative">
                                    <img style="max-height: 200px" src="{{ '/' . env('PRODUCT_DIR') . '/' . $savedProduct->product->images[0] }}"
                                        class="card-img-top  object-fit-contain" alt="{{ $savedProduct->product->name }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title text-capitalize">{{ $savedProduct->product->name }}</h5>
                                            <p class="card-text price">${{ $savedProduct->product->price }}</p>
                                        </div>
                                        <td>{{ $savedProduct->product->category->name }}</td>
                                        @if ($savedProduct->product->featured)
                                            <p class="card-text featured">Featured Product</p>
                                        @endif
                                    </div>
                                    @php
                                        $userId = auth()->id();
                                        $productId = $savedProduct->product->id;
                                        $isProductInCart = \App\Models\Cart::where('user_id', $userId)
                                            ->where('product_id', $productId)
                                            ->exists();

                                        $isProductBookmarked = \App\Models\Bookmark::where('user_id', $userId)
                                            ->where('product_id', $productId)
                                            ->exists();
                                    @endphp

                                    <!-- Cart and Bookmark forms -->
                                    <div class="">
                                        <form action="{{ $isProductInCart ? route('cart.remove') : route('cart.add') }}"
                                            method="POST">
                                            @csrf
                                            @if ($isProductInCart)
                                                @method('DELETE')
                                            @endif
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                            <input type="hidden" name="product_id"
                                                value="{{ $savedProduct->product->id }}">
                                            <input type="number" name="quantity" class="d-none" value="1"
                                                min="1">
                                            <button type="submit" class="btn border-0 position-absolute top-0 start-0">
                                                <i
                                                    class="bi {{ $isProductInCart ? 'bi-cart-check-fill' : 'bi-cart' }} fs-5"></i>
                                            </button>
                                        </form>

                                        <form
                                            action="{{ $isProductBookmarked ? route('bookmark.remove') : route('bookmark.add') }}"
                                            method="POST">
                                            @csrf
                                            @if ($isProductBookmarked)
                                                @method('DELETE')
                                            @endif
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                            <input type="hidden" name="product_id"
                                                value="{{ $savedProduct->product->id }}">
                                            <button type="submit" class="btn border-0 position-absolute top-0 end-0">
                                                <i
                                                    class="bi {{ $isProductBookmarked ? 'bi-bookmark-check-fill' : 'bi-bookmark' }} fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>




                <div id="orders" class="tab-pane p-3">
                    <h2>Orders</h2>
                    <!-- Add your orders content here -->
                </div>
            </div>
        </div>

        <form id="logout-form" action="{{ route('user.logout') }}" method="POST">
            @csrf
            @method('POST')
            <button type="submit" class="btn mt-4 ms-3 bg-danger-subtle text-danger"
                onclick="return confirmLogout(event)">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>

    </div>


    <script>
   document.addEventListener("DOMContentLoaded", function() {
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content .tab-pane');

    tabLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const tabName = this.getAttribute('data-tab');
            setActiveTab(tabName);
            setActiveLink(this);
            // Update URL hash with the tab name
            history.pushState(null, null, '#' + tabName);
        });
    });

    function setActiveLink(activeLink) {
        tabLinks.forEach(link => {
            link.classList.remove('active-tab');
        });
        activeLink.classList.add('active-tab');
    }

    function setActiveTab(tabName) {
        tabContents.forEach(tabContent => {
            tabContent.style.display = 'none';
        });
        document.getElementById(tabName).style.display = 'block';
    }

    // Set the active tab based on the URL hash
    const initialTab = window.location.hash.substring(1);
    if (initialTab) {
        setActiveTab(initialTab);
        const activeLink = document.querySelector(`.tab-link[data-tab="${initialTab}"]`);
        if (activeLink) {
            setActiveLink(activeLink);
        }
    } else {
        // Set "account-information" tab as active by default
        setActiveTab('account-information');
        setActiveLink(document.querySelector('.tab-link[data-tab="account-information"]'));
    }
});




        const fileInput = document.querySelector('#fileInput');
        const fileUploadButton = document.querySelector('#filebutton');
        const userProfileImage = document.querySelector('#userProfileImage');
        const oldImagePath =
            '{{ $user->profile_picture ?? '' }}'; // Assuming $user->profile_picture holds the old image path

        fileUploadButton.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = (e) => {
                userProfileImage.src = e.target.result;
            };

            reader.readAsDataURL(file);

            const formData = new FormData();
            formData.append('image', file);
            formData.append('old_image_path', oldImagePath); // Append the old image path
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: '/update-image',
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    // Handle success response if needed
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                }
            });
        });







        $(document).ready(function() {
            $('.editButton').click(function() {
                // Hide the corresponding paragraph tag and show the input field
                var displayElement = $(this).closest('.row').find('p');
                var inputElement = $(this).closest('.row').find('input');
                displayElement.hide();
                inputElement.show();

                // Toggle the visibility of edit and submit buttons
                $(this).hide();
                $(this).siblings('.submitButton').show();
            });

            $('.submitButton').click(function() {
                var displayElement = $(this).closest('.row').find('p');
                var inputElement = $(this).closest('.row').find('input');

                // Update the display text with the input value
                displayElement.text(inputElement.val()).show();

                // Toggle the visibility of edit and submit buttons
                $(this).hide();
                $(this).siblings('.editButton').show();

                // Hide the input field
                inputElement.hide();

                // Send AJAX request to update user details
                var userId = {{ $user->id }}; // Assuming you have user ID available
                var fieldName = displayElement.attr('id').replace('Display', '');
                var newValue = inputElement.val();

                $.ajax({
                    url: '/update-user',
                    type: 'POST',
                    data: {
                        userId: userId,
                        fieldName: fieldName,
                        newValue: newValue,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle success response if needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error if needed
                    }
                });

            });
        });

        function confirmLogout(event) {
            if (!confirm('Are you sure you want to log out?')) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
@endsection
