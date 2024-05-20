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
            @include('UserComponents.Partials.sidebar')

            <div class="col-12 col-md-8 shadow text-center text-light rounded-5 tab-content"
                style="background-color: rgba(77, 134, 156, 0.8);">
                @include('UserComponents.Partials.account-information')
                @include('UserComponents.Partials.saved')
                @include('UserComponents.Partials.orders')
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
