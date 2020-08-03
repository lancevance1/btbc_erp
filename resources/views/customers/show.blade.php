@extends('layouts.app')
@section('title', 'Show Customer')

@section('content')
    <div class="container">
        <form action="/customers/{{ $customer->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">Delete</button>
        </form>
        <a href="/customers/{{ $customer->id}}/edit">
            Edit
        </a>
        {{$customer}}

    </div>
@endsection
