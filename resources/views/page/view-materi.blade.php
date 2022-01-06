@extends('home')
@section('title')
Materi
@endsection

@section('content')

<div class="container">

    <div class="row mb-5">
        <div class="col-12 col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Materi Pembelajaran</h1>
        </div>
        <div class="col-12 col-md-6 m-0">
            <form action="{{route('materi.index')}}">
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

    <a href="{{ route('materi-sd') }}" class="btn btn-primary mb-4 ">SD</a>
    <a href="{{ route('materi-smp') }}" class="btn btn-primary mb-4 ">SMP</a>
    <a href="{{ route('materi-sma') }}" class="btn btn-primary mb-4 ">SMA</a>
    <a href="{{ route('materi.index') }}" class="btn btn-primary mb-4 ">SEMUA</a>

    <div class="row mb-4">
        @foreach ($subject_learnings as $information)
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <a href="{{ route('show',$information->id) }}" style="
            text-decoration:none;
            ">
                <div class=" card mb-5" style="width: 250px">
                    <img src="{{ Storage::url($information->cover_materi) }}" style="
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

@endsection