@extends('UserComponents.Layouts.layout')

@section('content')
<div class="container w-50 bg-light mt-5 p-4 rounded-4 shadow position-relative" style="background-color: #EEF7FF; color: #4D869C;">
    <form action="{{ route('user.index') }}" method="GET">
        <button type="submit" class="btn btn-close position-absolute top-0 mt-3" style="right: -35px;"></button>
    </form>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div data-mdb-input-init class="form-outline mb-3">
                    <label class="form-label" for="loginName">Email or username</label>
                    <input type="text" id="loginName" name="loginName" class="form-control" style="border-color: #7AB2B2;" />
                </div>

                <div data-mdb-input-init class="form-outline mb-3">
                    <label class="form-label" for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="password" class="form-control" style="border-color: #7AB2B2;" />
                </div>

                <!-- Remember me and Forgot password section -->

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary form-control w-50 mb-3" style="background-color: #4D869C; border-color: #4D869C;">Sign in</button>
                </div>

                <div class="text-center">
                    <p>Not a member? <a href="{{ route('user.register') }}" onclick="switchTab('pills-register')" style="color: #007bff;">Register</a></p>
                </div>
            </form>
            <div class="text-center mb-3">
                <p>Sign in with:</p>
                <button type="button" class="btn btn-primary btn-floating mx-1" style="background-color: #3b5998;">
                    <i class="bi bi-facebook"></i>
                </button>
                <button type="button" class="btn btn-danger btn-floating mx-1">
                    <i class="bi bi-google"></i>
                </button>
                <button type="button" class="btn btn-info btn-floating mx-1">
                    <i class="bi bi-twitter"></i>
                </button>
                <button type="button" class="btn btn-dark btn-floating mx-1">
                    <i class="bi bi-github"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tabId) {
        $('.nav-link').removeClass('active');
        $('#' + tabId + '-link').addClass('active');
        $('.tab-pane').removeClass('show active');
        $('#' + tabId).addClass('show active');
    }
</script>
@endsection
