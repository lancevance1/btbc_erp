@extends('layouts.app')
@section('title', 'Customers')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <a href="/customers/create">Create customer</a>

                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif




                        {{--                                                    <div class="container">--}}
                        {{--                                                        <div class="row justify-content-md-center">--}}
                        {{--                                                            <div class="col-sm">--}}
                        {{--                                                                Id--}}
                        {{--                                                            </div>--}}
                        {{--                                                            <div class="col-sm">--}}
                        {{--                                                                Name--}}
                        {{--                                                            </div>--}}
                        {{--                                                            <div class="col-sm">--}}
                        {{--                                                                Address--}}
                        {{--                                                            </div>--}}

                        {{--                                                        </div>--}}
                        {{--                                                        @foreach ($customers ?? '' as $tmp)--}}
                        {{--                                                        <div class="row">--}}

                        {{--                                                            <div class="col-sm">--}}
                        {{--                                                                {{$tmp->id}}--}}
                        {{--                                                            </div>--}}
                        {{--                                                            <div class="col-sm">--}}
                        {{--                                                                {{$tmp->name}}--}}
                        {{--                                                            </div>--}}
                        {{--                                                            <div class="col-sm">--}}
                        {{--                                                                {{$tmp->address}}--}}
                        {{--                                                            </div>--}}
                        {{--                                                            --}}

                        {{--                                                        </div>--}}
                        {{--                                                        @endforeach--}}
                        {{--                                                    </div>--}}


                        <table class="table">
                            @foreach ($customers ?? '' as $tmp)
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
                                    <td><a href="/customers/{{$tmp->id}}">{{$tmp->name}}</a>
                                    </td>
                                    <td>{{$tmp->address}}</td>


                                    <td>{{$tmp->created_at}}</td>
                                    <td>{{$tmp->updated_at}}</td>
                                    <td>
                                        {{--                                        <form action="{{action('ContactController@create',['id'=>$tmp->id])}}" >--}}
                                        {{--                                            <button type="submit" class="btn btn-secondary">Create contact</button>--}}
                                        {{--                                        </form>--}}


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


                                {{--do not render if there is no contact--}}

                                <tr>

                                    <td colspan="6">
                                        @if(sizeof($tmp->contacts) != 0)
                                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                                    data-target="#collapse-{{$tmp->id}}" aria-expanded="false"
                                                    aria-controls="collapseExample">
                                                Contacts
                                            </button>
                                        @endif
                                        <button onclick="location.href='/customers/{{ $tmp->id}}/contacts/create'"
                                                type="button" class="btn btn-secondary">Create Contact
                                        </button>
                                    </td>


                                </tr>
                                @if(sizeof($tmp->contacts) != 0)
                                    <tr>


                                        <td colspan="6">
                                            {{--                                            class="collapse show" cpllapse closed--}}
                                            <div class="collapse" id="collapse-{{$tmp->id}}">
                                                <div class="card card-body">


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
                                                                <td>
                                                                    <a href="/customers/{{ $tmp->id}}/contacts/{{$contact->id}}">{{$contact->name}}</a>

                                                                </td>
                                                                <td>{{$contact->email}}</td>
                                                                <td>{{$contact->phone}}</td>
                                                                <td>{{$contact->fax}}</td>

                                                                <td>

                                                                    <button
                                                                        onclick="location.href='/customers/{{ $tmp->id}}/contacts/{{$contact->id}}/edit'"
                                                                        type="button" class="btn btn-secondary">Edit
                                                                    </button>

                                                                    <form
                                                                        action="/customers/{{$tmp->id}}/contacts/{{$contact->id}}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-secondary">
                                                                            Delete
                                                                        </button>
                                                                    </form>

                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>


                                    </tr>
                                @endif


                                </tbody>
                            @endforeach
                        </table>


                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            {{ $customers->links() }}
                        </div>
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
