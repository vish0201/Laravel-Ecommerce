<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control" name="username" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                            </div>



                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
