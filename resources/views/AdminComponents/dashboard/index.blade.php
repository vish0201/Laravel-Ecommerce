@extends('AdminComponents.Layouts.layout')

@section('content')
    <h3>Dashboard</h3>

    <div class="container">

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





        </div>

    </div>
@endsection
