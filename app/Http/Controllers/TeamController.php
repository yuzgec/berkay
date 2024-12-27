<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Models\TeamCategory;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $All = Team::with('getCategory')->orderBy('rank')->get();
        $Kategori = TeamCategory::all();
        return view('backend.team.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = TeamCategory::pluck('title', 'id');
        return view('backend.team.create',  compact('Kategori'));
    }

    public function store(TeamRequest $request)
    {

        $New = Team::create($request->except('image', '_token', 'gallery'));


        if($request->hasfile('image')){
            $New->addMedia($request->image)->withResponsiveImages()->toMediaCollection('page');
        }

        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $New->addMedia($item)->withResponsiveImages()->toMediaCollection('gallery');
            }
        }

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('team.index');
    }

    public function show($id)
    {
        $Show = Team::findOrFail($id);
        return view('frontend.team.index', compact('Show'));

    }

    public function edit($id)
    {
        $Edit = Team::findOrFail($id);
        $Kategori = TeamCategory::pluck('title', 'id');
        return view('backend.team.edit', compact('Edit', 'Kategori'));
    }

    public function update(TeamRequest $request, $id)
    {

        $Update = Team::findOrFail($id);

        $Update->title = $request->title;
        $Update->category = $request->category;
        $Update->short = $request->short;
        $Update->desc = $request->desc;

        $Update->master = $request->master;
        $Update->instagram = $request->instagram;
        $Update->youtube = $request->youtube;

        $Update->seo_title = $request->seo_title;
        $Update->seo_desc = $request->seo_desc;
        $Update->seo_key = $request->seo_key;
        $Update->save();

        if($request->removeImage == "1"){
            $Update->media()->where('collection_name', 'page')->delete();
        }

        if ($request->hasFile('image')) {
            $Update->media()->where('collection_name', 'page')->delete();
            $Update->addMedia($request->image)->withResponsiveImages()->toMediaCollection('page');
        }

        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $Update->addMedia($item)->withResponsiveImages()->toMediaCollection('gallery');
            }
        }
        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('team.index');
    }

    public function destroy($id)
    {
        $Delete = Team::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('team.index');
    }

    public function getTrash(){
        $Trash = Team::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.team.trash', compact('Trash'));
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Team::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Team::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

    public function postUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = seo($filename).'_'.time().'.'.$extension;
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Resim Yüklendi';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
