@extends('home')
@section('title')
Informasi
@endsection

@section('content')

<div class="container">

    <div class="row mb-5">
        <div class="col-12 col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Informasi</h1>
        </div>
        <div class="col-12 col-md-6 m-0">
            <form action="{{route('information.index')}}">
                <div class="row m-0">
                    <div class="col-10">
                        <input type="text" class="form-control" value="{{ Request::get('kerword') }}" id="keyword"
                            name="keyword">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (Request::get('keyword'))
    <a href="{{ route('information.index') }}" class="btn btn-primary mb-4 ">Kembali</a>
    @endif


    <div class="row mb-4">
        @foreach ($information_models as $information)
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">

            <a href="{{ route('show-add-info',$information->id) }}" style="
                text-decoration:none;
                ">
                <div class=" card mb-0" style="width: 250px">
                    <img src="{{ Storage::url($information->cover) }}" style="
                        object-fit: cover;
                        width:250px;
                        height:230px;
                        " class="card-img-top">
                    <div class="card-body" style="">
                        <div style="
                             width: 220px;
                            overflow: hidden;
                            ">
                            <h5 class="card-text " style="
                                display: -webkit-box;
                                -webkit-line-clamp: 1;
                                -webkit-box-orient: vertical;  
                                font-weight: normal;
                                font-size: 18px;
                                color: #030d36;
                                color-text: black;
                                ">{{ $information->title }}</h5>
                        </div>
                        <p style="
                        margin-top: 0;
                        margin-bottom: 0;
                        font-weight: normal;
                        font-size: 14px;
                        color: #030d36;" class="card-text">Penulis {{ $information->user->name }} </p>
                        <p style="font-weight: normal;color: #030d36;
                        font-size: 14px;">{{$information->created_at->diffForHumans() }}</p>
                        @if (Auth::user()->roles == 'ADMIN')
                        <a href="{{ route('information.edit', $information->id) }}" class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                </div>
            </a>



        </div>
        @endforeach
    </div>

</div>

@endsection