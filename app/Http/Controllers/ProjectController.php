<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Models\ProjectCategory;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Artisan;

class ProjectController extends Controller
{

    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }


    public function index()
    {

        Artisan::call('cache:clear');
        $All = Project::with('getCategory')->orderBy('rank')->get();
        $Kategori = ProjectCategory::all();
        return view('backend.project.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = ProjectCategory::pluck('title', 'id');
        return view('backend.project.create',  compact('Kategori'));
    }


    public function store(ProjectRequest $request)
    {
        $New = Project::create($request->except('token', 'image', 'images'));
        
        $this->mediaService->handleMediaUpload(
            $New, 
            $request->file('image'),
            'page',
            false
        );

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            
            $this->mediaService->handleMultipleMediaUpload(
                $New,
                $files,
                'gallery',
            );
        }

        toast(SWEETALERT_MESSAGE_CREATE, 'success');
        return redirect()->route('project.index');
    }


    public function show($id)
    {
        $Show = Project::findOrFail($id);
        return view('frontend.project.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = Project::findOrFail($id);
        $Kategori = ProjectCategory::pluck('title', 'id');
        return view('backend.project.edit', compact('Edit', 'Kategori'));
    }

    public function update(ProjectRequest $request, Project $update)
    {
        tap($update)->update($request->except('image', 'images'));

        $this->mediaService->updateMedia(
            $update, 
            $request->file('image'),
            'page',
            false
        );

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            
            $this->mediaService->handleMultipleMediaUpload(
                $update,
                $files,
                'gallery',
                false
            );
        }

        toast(SWEETALERT_MESSAGE_UPDATE, 'success');
        return redirect()->route('project.index');
    }

    public function destroy($id)
    {
        $Delete = Page::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('project.index');
    }

    public function getTrash(){
        $Trash = Page::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.project.trash', compact('Trash'));
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Page::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Page::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

    public function postUpload(Request $request)
    {

        if($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Resim Yüklendi';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

    public function deleteGaleriDelete($id){

        $Delete = Project::find($id);
        $Delete->media()->where('id', \request('image_id'))->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('project.edit', $id);

    }
}
