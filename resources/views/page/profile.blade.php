@extends('home')
@section('title')
Profile
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses</strong> {{ Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile Anda</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <p class="dashboard-subtitle">Ubah Profile</p>
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
                        <div class="card mb-5">
                            <div class="card-body">
                                <form action="{{ route('update-profile', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" name="nik" class="form-control"
                                                    value="{{ $user->nik }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password(Kosongkan bila tidak ingin mengganti)</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <img src="{{ Storage::url($user->avatar) }}"
                                                style="max-height: 250px; margin-bottom: 10px" alt="">

                                            <div class="form-group">
                                                <label>Ganti gambar</label>
                                                <input type="file" name="avatar" class="form-control"
                                                    placeholder="Photo">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h3>Daftar materimu</h3>
                        <div class="row mb-4">
                            @foreach ($materi as $information)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">


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
                                    <a href="{{ route('materi.edit',$information->id) }}"
                                        class="btn btn-primary m-2">Edit</a>

                                </div>

                            </div>
                            @endforeach
                        </div>



                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection