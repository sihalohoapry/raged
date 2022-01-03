@extends('home')
@section('title')
Informasi
@endsection

@section('content')

<div class="container">

    <div class="row mb-5">
        <div class="col-12 col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
        </div>
        <div class="col-12 col-md-6 m-0">
            <form action="{{route('info-guru')}}">
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
    <a href="{{ route('info-guru') }}" class="btn btn-primary mb-4 ">Kembali</a>
    @endif


    <div class="row mb-4">
        @foreach ($users as $information)
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class=" card mb-5" style="width: 250px">
                <img src="{{ Storage::url($information->avatar) }}" style="
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
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;  
                        ">{{ $information->name }}</h5>
                    </div>
                    <p class="card-text">Sebagai {{ $information->roles }}</p>
                    {{-- @if (Auth::user()->roles == 'ADMIN')
                    <a href="" class="btn btn-primary">Edit</a>
                    @endif --}}
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>

@endsection