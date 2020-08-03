@extends('layouts.app')
@section('title', 'Customers')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Welcome {{$user->name ?? ''}} <br/>
                        <a href="/customers/create">create customer</a>

                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


{{--                            <div class="container">--}}
{{--                                <div class="row justify-content-md-center">--}}
{{--                                    <div class="col-sm">--}}
{{--                                        Id--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm">--}}
{{--                                        Name--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm">--}}
{{--                                        Address--}}
{{--                                    </div>--}}
{{--                                    @foreach ($customers ?? '' as $tmp)--}}
{{--                                        @foreach($tmp->contacts as $contact)--}}
{{--                                            <div class="col-sm">--}}
{{--                                                Contact Name--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm">--}}
{{--                                                Email--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm">--}}
{{--                                                Phone Number--}}
{{--                                            </div>--}}

{{--                                        @endforeach--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                                @foreach ($customers ?? '' as $tmp)--}}
{{--                                <div class="row">--}}

{{--                                    <div class="col-sm">--}}
{{--                                        {{$tmp->id}}--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm">--}}
{{--                                        {{$tmp->name}}--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm">--}}
{{--                                        {{$tmp->address}}--}}
{{--                                    </div>--}}
{{--                                    @foreach ($customers ?? '' as $tmp)--}}
{{--                                        @foreach($tmp->contacts as $contact)--}}
{{--                                            <div class="col-sm">--}}
{{--                                                {{$contact->name}}--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm">--}}
{{--                                                {{$contact->email}}--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm">--}}
{{--                                                {{$contact->phone}}--}}
{{--                                            </div>--}}

{{--                                        @endforeach--}}
{{--                                    @endforeach--}}

{{--                                </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}





                            @foreach ($customers ?? '' as $tmp)
                        <table class="table">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>

                                <th>Created at</th>
                                <th>Updated at</th>

                            </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td>{{$tmp->id}}</td>
                                    <td>{{$tmp->name}}</td>
                                    <td>{{$tmp->address}}</td>



                                    <td>{{$tmp->created_at}}</td>
                                    <td>{{$tmp->updated_at}}</td>
                                    <td>
{{--                                        <form action="{{action('ContactController@create',['id'=>$tmp->id])}}" >--}}
{{--                                            <button type="submit" class="btn btn-secondary">Create contact</button>--}}
{{--                                        </form>--}}
                                        <button onclick="location.href='/customers/{{ $tmp->id}}/contacts/create'"
                                                type="button" class="btn btn-secondary">Create Contact
                                        </button>

                                        <button onclick="location.href='/customers/{{ $tmp->id}}'"
                                                type="button" class="btn btn-secondary">Show
                                        </button>
                                        <button onclick="location.href='/customers/{{ $tmp->id}}/edit'"
                                                type="button" class="btn btn-secondary">Edit
                                        </button>

                                        <form action="/customers/{{$tmp->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary">Delete</button>
                                        </form>

                                    </td>




                                </tr>
                                <tr>

                                        <table class="table">

                                            <thead>
                                            <tr>

                                                <th>Contact Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Fax</th>

                                            </tr>

                                            </thead>

                                                <tbody>
                                                @foreach($tmp->contacts as $contact)
                                                <tr>
                                                    <td>{{$contact->name}}</td>
                                                    <td>{{$contact->email}}</td>
                                                    <td>{{$contact->phone}}</td>
                                                    <td>{{$contact->fax}}</td>
                                                    <td>
                                                    <td>


                                                        <button onclick="location.href='/customers/{{ $tmp->id}}/contacts/{{$contact->id}}'"
                                                                type="button" class="btn btn-secondary">Show
                                                        </button>
                                                        <button onclick="location.href='/customers/{{ $tmp->id}}/contacts/{{$contact->id}}/edit'"
                                                                type="button" class="btn btn-secondary">Edit
                                                        </button>

                                                        <form action="/customers/{{$tmp->id}}/contacts/{{$contact->id}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-secondary">Delete</button>
                                                        </form>

                                                    </td>
                                                    </td>
                                                </tr>

                                                @endforeach
                                                </tbody>


                                        </table>


                                </tr>


                            </tbody>

                        </table>
                            @endforeach

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
