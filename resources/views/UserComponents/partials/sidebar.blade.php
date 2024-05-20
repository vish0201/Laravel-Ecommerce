<div class="col-12 col-md-3  ">
    <div class="shadow text-center  mb-3 text-light rounded-5" style="background-color: rgba(77, 134, 156, 0.5);">
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
            <ul class="list-unstyled  text-end  p-4 ">
                <li class=" mb-3"><a href="" class=" tab-link text-decoration-none text-dark   "
                        data-tab="account-information">Account Information</a>
                </li>
                <li class=" mb-3"><a href="" class="tab-link  text-decoration-none text-dark"
                        data-tab="saved">Saved</a></li>
                <li class=" mb-3"><a href="#" class="tab-link  text-decoration-none text-dark"
                        data-tab="orders">Orders</a></li>
            </ul>
        </div>
    </div>
</div>
