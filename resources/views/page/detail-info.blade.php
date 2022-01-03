@extends('home')
@section('title')
Detail Informasi
@endsection

@section('content')

<div class="container">

    <div class="text-center">
        <h5>{{ $data->title }}</h5>
        <img src="{{ Storage::url($data->cover) }}" alt="" style="
    max-width: 100%;
    ">
    </div>
    <div class="row text-center">
        <div class="col-12 col-md-4 ">
            <p>Penulis {{ $data->user->name }}</p>
        </div>
        <div class="col-12 col-md-4">
            <p>{{ $data->created_at->diffForHumans() }} </p>
        </div>
        <div class="col-12 col-md-4 ">
            <p>Dilihat {{ $data->view }} <i class="fa fa-eye" aria-hidden="true"></i></p>
        </div>
    </div>
    <div class=" text-center">
        <p class="mt-0">{!! $data->information !!}</p>
    </div>

    <div>
    </div>


</div>

@endsection