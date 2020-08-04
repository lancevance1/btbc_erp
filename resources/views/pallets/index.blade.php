@extends('layouts.app')
@section('title', 'Pallets')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Welcome {{$user->name ?? ''}} <br/>
                        <a href="pallets/create">create pallets specs</a>

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
                                <th>Cartons per Layer</th>
                                <th>Layers per Poallet</th>
                                <th>Created at</th>
                                <th>Updated at</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pallets ?? '' as $tmp)

                                <tr>
                                    <td>{{$tmp->cartons_per_layer}}</td>
                                    <td>{{$tmp->layers_per_pallet}}</td>
                                    <td>{{$tmp->created_at}}</td>
                                    <td>{{$tmp->updated_at}}</td>
                                    <td><form action="{{$tmp->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary">Delete {{$tmp->id}}</button>
                                        </form>

                                    </td>
                                    <td>
                                        <button onclick="location.href='pallets/{{ $tmp->id}}/edit'"
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
