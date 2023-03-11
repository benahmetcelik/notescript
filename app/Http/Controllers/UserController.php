<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myNotes(){
        $notes = Note::where('user_id',auth()->user()->id);
        $views = $notes->sum('view');
        $count = $notes->count();
        $notes = $notes->paginate(10);

        return view('my-notes',compact('notes','views','count'));
    }

    public function index(){
        return view('user');
    }

    public function update(Request $request){
        if(!auth()->check()){
            return redirect()->route('home');
        }
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('user');
    }
}
