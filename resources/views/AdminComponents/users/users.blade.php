@extends('AdminComponents.Layouts.layout')

@section('content')

<style>
    .user-profile {
        background-color: #EEF7FF;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        padding: 20px;
        margin-bottom: 20px;
    }

    .user-profile:hover {
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    .user-profile img {
        width: 80px; /* Adjusted size */
        height: 80px; /* Adjusted size */
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .user-profile:hover img {
    transform: rotate3d(1, 1, 1, 360deg) scale(1.1);
}


    .user-profile h5 {
        margin-top: 10px;
        margin-bottom: 5px;
        font-size: 16px; /* Smaller font size */
        font-weight: bold;
        color: #4D869C;
    }

    .user-profile p {
        margin-bottom: 5px;
        font-size: 16px; /* Smaller font size */
        color: #7AB2B2;
    }

    .user-details {
        text-align: center;
    }
</style>

<div class="row">
    <h1>Total users {{ count($users) }}</h1>
    @foreach($users as $user)
    <div class="col-md-4 mb-4">
        <div class="user-profile">
            <div class="user-details">
                <h5>{{ $user->firstname }} {{ $user->lastname }}</h5>
                <img src="{{ "/" . env('PROFILE_DIR') . $user->profile_picture }}" alt="Profile Picture">
                <p class="mt-4">Username: @ {{ $user->username }}</p>
                <p class="mt-2" >Email: {{ $user->email }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
