@extends('AdminComponents.Layouts.layout')

@section('content')
    <h3  id="main"  >Dashboard</h3>

    <div class="container" id="">

        <div class="row gap-5">
            <div
                class="col-3 p-3  bg-info-subtle  rounded-3  fw-bold   d-flex  justify-content-between shadow align-content-center ">
                <p class=" "> Categories </p>
                <p>{{ count($category) }}</p>
            </div>

            <div
                class="col-3 p-3  bg-info-subtle  rounded-3  fw-bold   d-flex  justify-content-between shadow align-content-center ">
                <p class=""> Products </p>
                <p>{{ count($product) }}</p>
            </div>

            <div
                class="col-3 p-3  bg-info-subtle  rounded-3  fw-bold   d-flex  justify-content-between shadow align-content-center ">
                <p class=""> Users </p>
                <p>{{ count($user) }}</p>
            </div>

            <div class="container">
                <h2>My Chart </h2>
                <canvas id="userChart" width="400" height="200"></canvas>
            </div>
            @vite('resources/js/app.js')
        </div>
    </div>
@endsection


    