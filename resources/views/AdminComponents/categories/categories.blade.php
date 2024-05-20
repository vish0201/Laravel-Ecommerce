@extends('AdminComponents.Layouts.layout')

@section('content')

    <div class="container">
        @if ($categories->isEmpty())
            <h1>No Category found</h1>
            <button class="btn btn-primary mt-3"><a href="{{ route('category.create') }}" style="color: white;">Add
                    Category</a></button>
        @else
            <div class="d-flex justify-content-between align-content-center ">
                <h3>All Categories</h3>
                <button class="btn btn-outline-dark rounded-5 mt-3"><a class="text-decoration-none"
                        href="{{ route('category.create') }}" style="color: white;"> ➕ </a></button>
            </div>

            
            <table class="table mt-3 shadow bg-black table-hover table-striped border-none"
                style="border-radius: 10px; overflow: hidden;">
                <thead class="thead-light">
                    <tr>
                        <th>Sr.</th>
                        <th style="width: 10px" class=""></th>
                        <th>Image</th>

                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = ($categories->currentPage() - 1) * $categories->perPage() + 1;
                    @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $counter++ }}</td>

                            <td>
                                <form method="POST"
                                    action="{{ route('category.toggle-featured', ['category' => $category->id]) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn ">
                                        <h3>{{ $category->featured ? '★' : '☆' }}</h3>
                                    </button>
                                </form>
                            </td>



                            <td>
                                <img class="rounded-circle" width="40" height="40"
                                    src="{{ env('CATEGORY_DIR') . $category->image }}" alt="Category Image">
                            </td>

                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <div class="d-flex justify-content-center ">
                                    
                                    <div>
                                        <form method="GET" action="{{ route('category.edit', $category->id) }}">
                                            @csrf
                                            <button type="submit" class="btn ">✏️</button>
                                        </form>
                                    </div>

                                    <div>
                                        <form method="POST" action="{{ route('category.delete', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn "
                                                onclick="return confirm('Are you sure you want to delete this category?')">🗑</button>
                                        </form>
                                    </div>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="    ">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

@endsection
