@extends('home')
@section('title')
Detail Materi
@endsection

@section('content')

<div class="container">

    @if(Session::get('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>MAAF,</strong> Kamu sudah pernah mengirim rating ke Guru ini
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Terima kasih,</strong> Kamu sudah mengirim rating ke Guru ini
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row mb-5">
        <div class="col-12  col-md-7">
            @if ($data->video != null && $data->audio == null && $data->link_streaming == null)
            <video controls width="640" style="max-width: 100%">
                <source src="{{ Storage::url($data->video) }}" type="video/webm" />
                Browsermu tidak mendukung tag ini, upgrade donk!
            </video>
            @elseif ($data->audio != null && $data->video == null && $data->link_streaming == null)
            <audio controls>
                <source src="{{ Storage::url($data->audio) }}" type="audio/mpeg">
                Browsermu tidak mendukung tag audio, upgrade donk!
            </audio>
            @elseif ($data->link_streaming != null && $data->video == null && $data->audio == null)
            <iframe width="640" height="460" style="max-width: 100%;"
                src="https://www.youtube.com/embed/{{ $data->link_streaming }}" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            @endif

        </div>
        <div class="col-12 col-md-5 m-0">
            <h3>{{ $data->title }}</h3>
            <h5>Oleh {{ $data->user->name }}</h5>
            <div>
                <p>Rating Guru : {{ $rating }} / 5.0 <i class="fas fa-star"></i></p>
            </div>
            <div class="row">
                <div class="col-5">
                    <p>Created {{ $data->created_at->diffForHumans() }} </p>
                </div>
                <div class="col-5">
                    <p>Dilihat {{ $data->view }} <i class="fa fa-eye" aria-hidden="true"></i></p>
                </div>
            </div>
            <p class="mt-0">{!! $data->description !!}</p>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <h4>Berikan Ulasan Anda untuk Guru {{ $data->user->name}}</h4>
    </div>

    <div>

        <form method="POST" action="{{ route('make-rate',$data->user_id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="point_rate" class="form-control" id="">
                            <option value="">Pilih Angka </option>
                            <option value="1">1</option>
                            <option value="1">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col text-left">
                    <button type="submit" class="btn btn-success px-5">Kirim </button>
                </div>
            </div>
            <div class="modal fade" id="contohModal" role="dialog" arialabelledby="modalLabel" area-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <img src="" width="" height="" alt="INI POP UP">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>


</div>

@endsection