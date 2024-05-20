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
