<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use App\Models\Setting;

class AdminController extends Controller
{
    public function index(){
        $users = User::count();
        $notes = Note::count();
        $note_views = Note::sum('view');

        return view('admin.index', compact('users','notes','note_views'));
    }

    public function users(){
        if(request()->get('search')){
            $users = User::where('name','like','%'.request()->get('search').'%')->paginate(12);
         }else{
            $users = User::paginate(12);
         }
        return view('admin.users', compact('users'));
    }

    public function user_store(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'user';
        $user->save();
        return redirect()->back();
    }

    public function user_delete($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
    public function backup(){

        $sql = $this->sql_backup();
        $script = $this->script_backup();

        if(!file_exists(storage_path('app/backup'))){
            mkdir(storage_path('app/backup'));
        }
        $path = storage_path('app/backup/backup_'.date('Y-m-d_H-i-s').'-downloaded.zip');
        $zip = new \ZipArchive();
        $zip->open($path, \ZipArchive::CREATE);
        $zip->addFile($sql, basename($sql));
        $zip->addFile($script, basename($script));
        $zip->close();


        return response()->download($path)->deleteFileAfterSend(true);

    }

    public function sql_backup(){
        $tables = ['users','notes','password_resets','failed_jobs','personal_access_tokens','settings','banners'];
        $sql = '';
        foreach($tables as $table){
            $sql .= 'DROP TABLE IF EXISTS '.$table.';';
            $sql .= 'CREATE TABLE '.$table.' (';
            $fields = \DB::select('DESCRIBE '.$table);
            foreach($fields as $field){
                $sql .= '`'.$field->Field.'` '.$field->Type;
                if($field->Null == 'NO'){
                    $sql .= ' NOT NULL';
                }
                if($field->Default){
                    $sql .= ' DEFAULT "'.$field->Default.'"';
                }
                if($field->Extra){
                    $sql .= ' '.$field->Extra;
                }
                $sql .= ',';
            }
            $sql = rtrim($sql,',');
            $sql .= ');';
            $data = \DB::select('SELECT * FROM '.$table);
            $values = [];
            foreach($data as $row){
                $values[] = '("'.implode('","',array_values((array)$row)).'")';
            }
            $sql .= 'INSERT INTO '.$table.' VALUES '.implode(',',$values).';';
        }

        $file = 'backup_'.date('Y-m-d_H-i-s').'.sql';
        if(!file_exists(storage_path('app/backup'))){
            mkdir(storage_path('app/backup'));
        }
        $path = storage_path('app/backup/'.$file);


        file_put_contents($path,$sql);
        return $path;
    }

    public function script_backup(){

        if(!file_exists(storage_path('app/backup'))){
            mkdir(storage_path('app/backup'));
        }
        $path = storage_path('app/backup/backup_'.date('Y-m-d_H-i-s').'.zip');
        $zip = new \ZipArchive();
        $zip->open($path, \ZipArchive::CREATE);
        $this->addContent($zip, base_path());
        $zip->close();
        return $path;
    }


    /**
     * This takes symlinks into account.
     *
     * @param ZipArchive $zip
     * @param string     $path
     */
    private function addContent(\ZipArchive $zip, string $path)
    {
        /** @var SplFileInfo[] $files */
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $path,
                \FilesystemIterator::FOLLOW_SYMLINKS
            ),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        while ($iterator->valid()) {
            if (!$iterator->isDot()) {
                $filePath = $iterator->getPathName();
                $relativePath = substr($filePath, strlen($path) + 1);

                if (!$iterator->isDir()) {
                    $zip->addFile($filePath, $relativePath);
                } else {
                    if ($relativePath !== false) {
                        $zip->addEmptyDir($relativePath);
                    }
                }
            }
            $iterator->next();
        }
    }

    public function notes(){
        $notes = Note::paginate(12);
        return view('admin.notes', compact('notes'));
    }
    public function notesDelete($link){
        $note = Note::where('link',$link)->first();
        $note->delete();
        return redirect()->back();
    }

    public function banners(){

        if(request()->get('search')){
            $banners = Banner::where('title','like','%'.request()->get('search').'%')->paginate(12);
         }else{
            $banners     = Banner::paginate(12);
         }
        return view('admin.banners', compact('banners'));
    }

    public function bannersStore(Request $request){

        $banner = Banner::create($request->only([
            'title',
            'link',
            'image',
            'image_link',
            'start_date',
            'end_date',
            'status',
        ]));

        return redirect()->back();
    }

    public function banner_delete($id){

            $banner = Banner::find($id);
            $banner->delete();
            return redirect()->back();
    }

    public function colors(){
        $colors = Setting::where('setting_key','colors')->first();
        if($colors){
            $colors = json_decode($colors->setting_value);
        }else{
            $colors = json_decode(json_encode([
                'primary' => '#007bff',
                'second' => '#6c757d',
                'tertiary' => '#28a745',
            ]));
        }
        return view('admin.colors', compact('colors'));
    }

    public function colorsStore(Request $request){
        $colors = Setting::firstOrCreate([
            'setting_key' => 'colors',

        ]);
        $colors->setting_value = json_encode($request->colors);
        $colors->save();
        return redirect()->back();
    }

    public function settings(){

        return view('admin.settings');
    }

    public function settingsStore(Request $request){
        $settings = Setting::firstOrCreate([
            'setting_key' => 'general',
        ]);
        $settings->setting_value = json_encode($request->setting);
        $settings->save();
        return redirect()->back();
    }
}
