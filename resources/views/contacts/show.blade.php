@extends('layouts.app')
@section('title', 'Show Contact')

@section('content')
    <div class="container">
        <form action="/customers/{{$customer->id}}/contacts/{{ $contact->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">Delete</button>
        </form>
        <a href="/customers/{{$customer->id}}/contacts/{{ $contact->id}}/edit">
            Edit
        </a>
        {{$contact}}

    </div>
@endsection
