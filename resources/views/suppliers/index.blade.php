@extends('layouts.app')
@section('title', 'Suppliers')


@section('content')

    <script src="{{ asset('js/test.js')}}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/suppliers/create">Create new supplier</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($suppliers ?? '' as $sup)
                                <tr>
                                    <td>{{$sup->id}}
                                    </td>
                                    <td><a href="/suppliers/{{$sup->id}}">{{$sup->name}}</a>
                                    </td>

                                    <td>
{{--                                        <button onclick="location.href='/suppliers/{{ $sup->id}}/edit'"--}}
{{--                                                type="button" class="btn btn-secondary">Add Price--}}
{{--                                        </button>--}}
                                        <button onclick="location.href='/suppliers/{{ $sup->id}}/edit'"
                                                 type="button" class="btn btn-secondary">Edit
                                        </button>
                                        <form action="/suppliers/{{$sup->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary">Delete</button>
                                        </form></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
