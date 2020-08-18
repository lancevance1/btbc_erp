@extends('layouts.app')
@section('title', 'Show Customer')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Customer Information</h1>
                </div>

                <div class="row">

                <div class="col-sm-3">
                    <form action="/customers/create" >
                        @csrf

                        <button type="submit" class="btn btn-secondary w-100">Create</button>
                    </form>

                </div>
                <div class="col-sm-3">
                    <button onclick="location.href='/customers/{{ $customer->id}}/edit'"
                            type="button" class="btn btn-secondary w-100">Edit
                    </button>
                </div>

                    <div class="col-sm-3">
                        <form action="/customers/{{ $customer->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary w-100">Delete</button>
                        </form>
                    </div>






                </div>



                <div class="form-group row">



                    <label for="name" class="col-md-4 col-form-label ">Name</label>
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name')?? $customer->name }}"
                           autocomplete="name" autofocus readonly>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    <label for="address" class="col-md-4 col-form-label ">Address</label>
                    <input id="address" type="text"
                           class="form-control @error('address') is-invalid @enderror"
                           name="address" value="{{ old('address') ?? $customer->address}}"
                           autocomplete="address" autofocus readonly>

                    @error('address')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror







                </div>
                <div class="row">

                    <button onclick="location.href='/customers/{{ $customer->id}}/contacts/create'"
                            type="button" class="btn btn-secondary">Create Contact
                    </button>
                </div>

                <div class="row">

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


                            @foreach($customer->contacts as $contact)

                                <tr>
                                    <td><a href="/customers/{{ $customer->id}}/contacts/{{$contact->id}}">{{$contact->name}}</a>

                                    </td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->fax}}</td>

                                    <td>

                                        <button
                                            onclick="location.href='/customers/{{ $customer->id}}/contacts/{{$contact->id}}/edit'"
                                            type="button" class="btn btn-secondary">Edit
                                        </button>

                                        <form
                                            action="/customers/{{$customer->id}}/contacts/{{$contact->id}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary">Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>



            </div>




    </div>
@endsection
