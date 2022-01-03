<?php

namespace App\Http\Controllers;

use App\Http\Requests\MateriRequest;
use App\Models\Rating;
use App\Models\SubjectLearning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


            $filterKeyword = $request->get('keyword');
            $data['subject_learnings'] = SubjectLearning::all();
            if($filterKeyword){
                $data['subject_learnings'] =SubjectLearning::where('title','LIKE',"%$filterKeyword%")->get();
            }
            return view('page.view-materi',$data
            );
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('page.create-materi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MateriRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['materi_untuk'] = Auth::user()->jenjang;
        $data['cover_materi'] = $request->file('cover_materi')->store('assets/materi/cover-materi','public');
        if($request->video){
            $data['video'] = $request->file('video')->store('assets/materi/video-materi','public');

        }else{
            unset($data['video']);
        }
        if($request->audio){
            $data['audio'] = $request->file('audio')->store('assets/materi/audio-materi','public');

        }else{
            unset($data['audio']);
        }

        SubjectLearning::create($data);
        return redirect()->route('materi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SubjectLearning::findOrFail($id);
        $teacherRate = $data->user_id;
        $total_user_rate = Rating::all()->where('id_teacher',$teacherRate)->count();
        $total_rate = Rating::where('id_teacher',$teacherRate)->sum('point_rate');
        
        if($total_user_rate ==null){
            $total_user_rate = 1.0;
            $total_user_rate = 0.5;
            $rating = $total_rate/$total_user_rate;
        }else{
            $rating = $total_rate/$total_user_rate;
        }
        return view('page.detail-materi',[
            'data'=>$data,
            'rating'=>$rating,
        ]);
        
    }

    public function showAndAddView(MateriRequest $request, $id){
        $item = $request->all();
        $data = SubjectLearning::findOrFail($id);
        $teacherRate = $data->user_id;
        $total_user_rate = Rating::all()->where('id_teacher',$teacherRate)->count();
        $total_rate = Rating::where('id_teacher',$teacherRate)->sum('point_rate');

        
        
        $item['view'] = $data->view + 1;
        $data->update($item);
        
        if($total_user_rate ==null){
            $total_user_rate = 1.0;
            $total_user_rate = 0.5;
            $rating = $total_rate/$total_user_rate;
        }else{
            $rating = $total_rate/$total_user_rate;
        }
        return view('page.detail-materi',[
            'data'=>$data,
            'rating'=>$rating,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SubjectLearning::findOrFail($id);
        return view('page.edit-materi',[
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MateriRequest $request, $id)
    {
        $materi = SubjectLearning::findOrFail($id);
        $data = $request->all();
        if($request->cover_materi){
            $data['cover_materi'] = $request->file('cover_materi')->store('assets/materi/cover-materi','public');
        }else{
            unset($data['cover_materi']);
        }
        if($request->video){
            $data['video'] = $request->file('video')->store('assets/materi/video-materi','public');

        }else{
            unset($data['video']);
        }
        if($request->audio){
            $data['audio'] = $request->file('audio')->store('assets/materi/audio-materi','public');

        }else{
            unset($data['audio']);
        }

        $materi->update($data);
        return back()->with('update-materi','Kamu berhasil mengupdate materi');
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
