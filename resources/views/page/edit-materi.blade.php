@extends('home')
@section('title')
Edit Materi
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil,</strong> {{ Session::get('update-materi') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Materi</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <p class="dashboard-subtitle">Silahkan edit materi</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                        <div class="alert alert-danger ">
                            <ul>
                                @foreach ($errors->all() as $error )
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('materi.update',$data->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Judul Materi</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $data->title }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="description" id="editor" required>
                                                    {!! $data->description !!}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Link Streaming (Youtube)</label>
                                                <input type="text" name="link_streaming" class="form-control"
                                                    value="{{ $data->link_streaming }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="mb-3"><img src="{{ Storage::url($data->cover_materi) }}"
                                                        alt=""></div>
                                                <label>Ganti Cover Materi</label>
                                                <input type="file" name="cover_materi" class="form-control"
                                                    placeholder="Photo">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <video controls width="640" style="max-width: 100%">
                                                            <source src="{{ Storage::url($data->video) }}"
                                                                type="video/webm" />
                                                            Browsermu tidak mendukung tag ini, upgrade donk!
                                                        </video>
                                                    </div>
                                                </div>
                                                <label>Ganti Video</label>
                                                <input type="file" name="video" class="form-control" id="video">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">Edit Materi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endpush