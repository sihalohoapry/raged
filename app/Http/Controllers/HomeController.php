<?php

namespace App\Http\Controllers;

use App\Models\SubjectLearning;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $guru = User::all()->where('roles','GURU')->count();
        $siswa = User::all()->where('roles','SISWA')->count();
        $materi = SubjectLearning::all()->count();
        return view('page.dashboard',[
            'guru'=> $guru,
            'siswa'=> $siswa,
            'materi'=> $materi,
        ]);
    }
}
