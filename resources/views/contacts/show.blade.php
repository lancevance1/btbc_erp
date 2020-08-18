@extends('layouts.app')
@section('title', 'Show Contact')

@section('content')
    <div class="container">


        <div class="col-8 offset-2">
            <div class="row">
                <h1>Edit Contact</h1>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <form action="/customers/{{$customer->id}}/contacts/create">
                        @csrf

                        <button type="submit" class="btn btn-secondary w-100">Create</button>
                    </form>

                </div>
                <div class="col-sm-3">
                    <form action="/customers/{{$customer->id}}/contacts/{{ $contact->id}}/edit">
                        @csrf

                        <button type="submit" class="btn btn-secondary w-100">Edit</button>
                    </form>

                </div>
                <div class="col-sm-3">
                    <form action="/customers/{{$customer->id}}/contacts/{{ $contact->id}}" method="POST">
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
                       name="name" value="{{ old('name') ?? $contact->name}}"
                       autocomplete="name" autofocus readonly>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <label for="email" class="col-md-4 col-form-label ">Email</label>
                <input id="email" type="text"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email')?? $contact->email }}"
                       autocomplete="email" autofocus readonly>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <label for="phone" class="col-md-4 col-form-label ">Phone Number</label>
                <input id="phone" type="text"
                       class="form-control @error('phone') is-invalid @enderror"
                       name="phone" value="{{ old('phone') ?? $contact->phone}}"
                       autocomplete="phone" autofocus readonly>

                @error('phone')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <label for="fax" class="col-md-4 col-form-label ">Fax</label>
                <input id="fax" type="text"
                       class="form-control @error('fax') is-invalid @enderror"
                       name="fax" value="{{ old('fax') ?? $contact->fax}}"
                       autocomplete="fax" autofocus readonly>

                @error('fax')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror


            </div>


        </div>


    </div>
@endsection
