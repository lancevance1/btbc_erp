@extends('layouts.app')
@section('title', 'Contacts')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Welcome {{$user->name ?? ''}} <br/>
                        <a href="/contacts/create">create contact</a>

                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif



                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Fax</th>
                                <th>Created at</th>
                                <th>Updated at</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contacts ?? '' as $tmp)

                                <tr>
                                    <td>{{$tmp->id}}</td>
                                    <td>{{$tmp->name}}</td>
                                    <td>{{$tmp->email}}</td>
                                    <td>{{$tmp->phone}}</td>
                                    <td>{{$tmp->fax}}</td>
                                    <td>{{$tmp->created_at}}</td>
                                    <td>{{$tmp->updated_at}}</td>
                                    <td><form action="/contacts/{{$tmp->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary">Delete {{$tmp->id}}</button>
                                        </form>

                                        </td>
                                    <td>
                                        <button onclick="location.href='/contacts/{{ $tmp->id}}/edit'"
                                                type="button" class="btn btn-secondary">Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>

                </div>
            </div>
        </div>
        {{--    {{$name ?? ''}}--}}
        <div class="row">
            <div class="col-3"></div>
        </div>
    </div>
@endsection
