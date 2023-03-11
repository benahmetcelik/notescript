<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Setting;
use App\Models\Banner;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function saveNote(Request $request){
        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->note;
        $note->link = $this->generateUniqueLink();
        $note->user_id = auth()->user()->id ?? null;
        $note->save();
        return redirect()->route('get-note',['note'=>$note->link]);
    }




    public function getNote($note){
        $note = Note::where('link',$note)->first();
        if(!$note){
            return redirect()->route('home');
        }
        $note->view = $note->view + 1;
        $note->save();
        return view('note',['note'=>$note]);
    }

    public function generateUniqueLink(){
        $link = $this->str_random(10);
        $note = Note::where('link',$link)->first();
        if($note){
            $this->generateUniqueLink();
        }
        return $link;
    }

    public function str_random($limit){
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function deleteNote($note){
       if(!auth()->user()){
           return redirect()->route('home');
         }
        $note = Note::where('link',$note)->first();
        if(!$note){
            return redirect()->route('home');
        }
        $note->delete();
        return redirect()->back();
    }

    public function clickBanner($banner){
        $banner = Banner::where('uid',$banner)->first();
        if(!$banner){
            return redirect()->route('home');
        }
        $banner->click = $banner->click + 1;
        $banner->save();
        return redirect()->away($banner->link);
    }
}
