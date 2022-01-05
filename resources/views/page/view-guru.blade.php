@extends('home')
@section('title')
Informasi
@endsection

@section('content')

<div class="container">

    @if(Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil,</strong> {{ Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row mb-5">
        <div class="col-12 col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
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
    <a href="{{ route('guru-sd') }}" class="btn btn-primary mb-4 ">SD</a>
    <a href="{{ route('guru-smp') }}" class="btn btn-primary mb-4 ">SMP</a>
    <a href="{{ route('guru-sma') }}" class="btn btn-primary mb-4 ">SMA</a>
    <a href="{{ route('info-guru') }}" class="btn btn-primary mb-4 ">SEMUA</a>


    <div class="row">
        @foreach ($users as $information)
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="{{ route('show-teacher',$information->id) }}" style="
                text-decoration:none;
                ">
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
                                <h5 class="card-text" style="
                                 display: -webkit-box;
                                -webkit-line-clamp: 1;
                                -webkit-box-orient: vertical;  
                                font-weight: normal;
                                font-size: 18px;
                                color: #030d36;
                                color-text: black;
                               
                                ">{{ $information->name }}</h5>
                            </div>
                            <p style="
                            font-weight: normal;
                            font-size: 14px;
                            color: #030d36;
                            ">Sebagai <span class="text-uppercase font-weight-bold">{{ $information->status }}</span>
                            </p>

                            @if (Auth::user()->roles == 'ADMIN')
                            <a href="{{ route('status',$information->id) }}" class="btn btn-danger">Ubah
                                Status</a>


                            @endif
                        </div>
                    </div>
                </a>

            </div>

        </div>
        @endforeach
    </div>
    <div class="row">
        @if (Request::get('keyword'))
    <a href="{{ route('info-guru') }}" class="btn btn-dark mb-5 ">Kembali</a>
    @endif
    </div>


</div>

@endsection