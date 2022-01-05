<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformationRequest;
use App\Http\Requests\RatingRequest;
use App\Models\InformationModel;
use App\Models\Rating;
use App\Models\SubjectLearning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['information_models'] = InformationModel::all();
        if($filterKeyword){
            $data['information_models'] =InformationModel::where('title','LIKE',"%$filterKeyword%")->get();
        }
        return view('page.view-information',$data
        );
    }

    public function showAndAddInfoView(InformationRequest $request, $id){
        $data = $request->all();
        $item = InformationModel::findOrFail($id);
        $data['view'] = $item->view + 1;
        $item->update($data);
        return view('page.detail-info',[
            'data' => $item
        ]);

    }

    public function info_guru(Request $request){
        $filterKeyword = $request->get('keyword');
        $data['users'] = User::all()->where('roles','GURU');
        if($filterKeyword){
            $data['users'] =User::where('name','LIKE',"%$filterKeyword%")->get();
        }
        return view('page.view-guru',$data
        );
    }
    public function guruSd(){
        $data['users'] = User::where([
            ['roles','GURU'],
            ['jenjang','SD']
        ])->get();
        
        return view('page.view-guru',$data
        );
    }
    public function guruSmp(){
        $data['users'] = User::where([
            ['roles','GURU'],
            ['jenjang','SMP']
        ])->get();
        
        return view('page.view-guru',$data
        );
    }
    public function guruSma(){
        $data['users'] = User::where([
            ['roles','GURU'],
            ['jenjang','SMA']
        ])->get();
        
        return view('page.view-guru',$data
        );
    }

    public function showTeacher($id){
        $data = User::findOrFail($id);
        $total_user_rate = Rating::all()->where('id_teacher',$id)->count();
        $total_rate = Rating::where('id_teacher',$id)->sum('point_rate');
        $subject = SubjectLearning::all()->where('user_id',$id)->count();
        $listSubject = SubjectLearning::all()->where('user_id',$id);
        
        if($total_user_rate ==null){
            $total_user_rate = 1.0;
            $total_user_rate = 0.5;
            $rating = $total_rate/$total_user_rate;
        }else{
            $rating = $total_rate/$total_user_rate;
        }
        {
            return view('page.detail-user',[
                'data' => $data,
                'rating'=>$rating,
                'subject'=>$subject,
                'listSubject'=>$listSubject
            ]);
        }
    }

    
    public function info_siswa(Request $request){
        $filterKeyword = $request->get('keyword');
        $data['users'] = User::all()->where('roles','SISWA');
        if($filterKeyword){
            $data['users'] =User::where('name','LIKE',"%$filterKeyword%")->get();
        }
        return view('page.view-siswa',$data
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['cover'] = $request->file('cover')->store('assets/cover-information','public');

         $data['user_id'] = Auth::user()->id;

         InformationModel::create($data);
         return redirect()->route('information.index');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = InformationModel::findOrFail($id);
        return view('page.edit-information',[
            'data'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InformationRequest $request, $id)
    {
        $data = $request->all();
        $item = InformationModel::findOrFail($id);
        $item->update($data);
        return redirect()->route('information.index');
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

    public function showInfo($id){

    }


}
