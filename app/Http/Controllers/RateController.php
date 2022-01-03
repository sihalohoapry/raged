<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class RateController extends Controller
{
    public function makeRate(Request $request, $id){
        $user = Auth::user()->id;
        if(DB::table('ratings')->where('user_rate', $user)->first() &&DB::table('ratings')->where('id_teacher', $id)->first()){
            return back()->with('message','Kamu sudah pernah memberi rating kepada Guru ini');
        }else{
            $data = [
                'user_rate' => Auth::user()->id,
                'id_teacher'=> $id,
                'point_rate'=> $request->get('point_rate'),
            ];
            Rating::create($data);
            return back()->with('success','Kamu sudah pernah memberi rating kepada Guru ini');
        }

        
        // $user = Auth::user()->id;
        // $user_rate = DB::table('ratings')->where('user_rate', $user)->first();
        // $teacher_rated = DB::table('ratings')->where('id_teacher', $id)->first();

        // if($user_rate->user_rate != null && $teacher_rated->id_teacher != null){
            
        // }else{
            
        // }

       
        

       
    }
}
