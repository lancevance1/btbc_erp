@extends('layouts.app')
@section('title', 'Show Dry Good')

@section('content')
    <div class="container">
        <form action="/products/{{ $product->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">Delete</button>
        </form>
        <a href="/products/{{$product->id}}/edit">
            Edit
        </a>
        {{$product}}

    </div>
@endsection
