@extends('home')
@section('title')
Detail Guru
@endsection

@section('content')

<div class="container">
    <div class="row mb-5 ">
        <div class="col-12 col-md-5 ">
            <img class="mb-4" src="{{ Storage::url($data->avatar) }}" style="max-width: 100%; max-height: 450px">
        </div>
        <div class="col-12 col-md-7 m-0 ">
            <div class="row">
                <div class="col-6 col-md-3 mb-0">
                    <p>Nama</p>
                </div>
                <div class="col-6 col-md-9">
                    <p>{{ $data->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-3 mb-0">
                    <p>Rating</p>
                </div>
                <div class="col-6 col-md-9">
                    <p>{{ $rating }} /5.0 <i class="fas fa-star"></i></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-3 mb-0">
                    <p>Jumlah pelajaran dibuat</p>
                </div>
                <div class="col-6 col-md-9">
                    <p>{{ $subject }} <i class="fas fa-video"></i></p>
                </div>
            </div>
            <p>Daftar materi pemblajaran yang telah dibuat</p>
            <div class="row ">
                @foreach ($listSubject as $information)
                <div class="col-lg-3 col-md-5 col-sm-12 mr-5 align-content-sm-around">
                    <a href="{{ route('show',$information->id) }}" style="
                    text-decoration:none;
                    ">
                        <div class="card" style="width: 150px">
                            <img src="{{ Storage::url($information->cover_materi) }}" style="
                            object-fit: cover;
                            width:150px;
                            height:150px;
                            " class="card-img-top">
                            <div class="card-body" style="">
                                <div style="
                                 width: 140px;
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
                                   
                                    ">{{ $information->title }}</h5>
                                </div>
                                <p style="
                                font-weight: normal;
                                font-size: 14px;
                                color: #030d36;
                                ">By {{ $information->user->name }}</p>

                            </div>
                        </div>
                    </a>

                </div>
                @endforeach
            </div>
        </div>
    </div>



</div>

@endsection