@extends('UserComponents.Layouts.layout')

@section('content')
<div class="container w-50 bg-light mt-5 p-4 rounded-4 shadow position-relative" style="background-color: #EEF7FF; color: #4D869C;">
    <form action="{{ route('user.index') }}" method="GET">
        <button type="submit" class="btn btn-close position-absolute top-0 mt-3" style="right: -35px;">
        </button>
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

                <div class="row mb-3">
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <a href="#!" style="color: #007bff;">Forgot password?</a>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary form-control w-50 mb-3" style="background-color: #4D869C; border-color: #4D869C;">Sign in</button>
                </div>

                <div class="text-center">
                    <p>Not a member? <a href="#!" onclick="switchTab('pills-register')" style="color: #007bff;">Register</a></p>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="text" id="registerFirstName" name="registerFirstName" class="form-control" style="border-color: #7AB2B2;" />
                            <label class="form-label" for="registerFirstName">First Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="text" id="registerLastName" name="registerLastName" class="form-control" style="border-color: #7AB2B2;" />
                            <label class="form-label" for="registerLastName">Last Name</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="email" id="registerEmail" name="registerEmail" class="form-control" style="border-color: #7AB2B2;" />
                            <label class="form-label" for="registerEmail">Email</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="text" id="registerUsername" name="registerUsername" class="form-control" style="border-color: #7AB2B2;" />
                            <label class="form-label" for="registerUsername">Username</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="registerPassword" name="registerPassword" class="form-control" style="border-color: #7AB2B2;" />
                            <label class="form-label" for="registerPassword">Password</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="registerRepeatPassword" name="registerPassword_confirmation" class="form-control" style="border-color: #7AB2B2;" />
                            <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                        </div>
                    </div>
                </div>

                <div class="form-check d-flex justify-content-center mb-3">
                    <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked aria-describedby="registerCheckHelpText" />
                    <label class="form-check-label" for="registerCheck">I have read and agree to the terms</label>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary form-control w-50 mb-3" style="background-color: #4D869C; border-color: #4D869C;">Register</button>
                </div>

                <div class="text-center">
                    <p>Already have an account? <a href="#!" onclick="switchTab('pills-login')" style="color: #007bff;">Login</a></p>
                </div>
            </form>
        </div>

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

<script>
    function switchTab(tabId) {
        $('.nav-link').removeClass('active');
        $('#' + tabId + '-link').addClass('active');
        $('.tab-pane').removeClass('show active');
        $('#' + tabId).addClass('show active');
    }
</script>
@endsection
