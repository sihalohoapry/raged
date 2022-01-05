<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\SubjectLearning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function profile($id){
        $user = User::findOrFail($id);
        $materi = SubjectLearning::all()->where('user_id',$id);
        return view('page.profile',[
            'user' => $user,
            'materi' => $materi
        ]);

    }

    public function updateProfile(UserRequest $request, $id){
        $data = $request->all();

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }else{
            unset($data['password']);
        }

        if($request->email){
            $data['email'] = $request->email ;
        }else{
            unset($data['email']);
        }
        if($request->avatar){
            $data['avatar'] = $request->file('avatar')->store('assets/avatar','public');
        }else{
            unset($data['avatar']);
        }

        $item = User::findOrFail($id);
        $item->update($data);
        return back()->with('success','Profile anda sudah diperbarui');
    }

    public function status(UserRequest $request, $id){
        $user = User::findOrFail($id);
        $data = $request->all();
        if($user->status == 'active'){
            $data['status'] = 'non active';
        } else{
            $data['status'] = 'active';
        }
        
        $user->update($data);
        return back()->with('success','Status guru berhasil di update');
    }
    public function statusActive(UserRequest $request, $id){
        $user = User::findOrFail($id);
        $data = $request->all();
        $data['status'] = 'active';
        $user->update($data);
        return back()->with('success','Status guru berhasil di update');
    }


}
