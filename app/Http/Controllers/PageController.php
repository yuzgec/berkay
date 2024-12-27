<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PageController extends Controller
{

    public function __construct(){
        Artisan::call('cache:clear');
    }

    public function index()
    {
        $All = Page::with('getCategory')->orderBy('rank')->get();
        $Kategori = PageCategory::all();
        return view('backend.page.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = PageCategory::pluck('title', 'id');
        return view('backend.page.create',  compact('Kategori'));
    }


    public function store(PageRequest $request)
    {
        $New = Page::create($request->except('image', 'gallery'));

        
        $this->mediaService->updateMedia(
            $New, 
            $request->file('image'),
            $request->input('deleteImage'),
            'page',
            false
        );

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $this->mediaService->handleMediaUpload(
                    $New,
                    $file,
                    'gallery',
                    false,
                    true
                );
            }
        }
        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('page.index');

    }


    public function show($id)
    {
        $Show = Page::findOrFail($id);
        return view('frontend.page.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = Page::findOrFail($id);
        $Kategori = PageCategory::pluck('title', 'id');
        return view('backend.page.edit', compact('Edit', 'Kategori'));
    }

    public function update(PageRequest $request, $id, Page $update)
    {
        //dd($request->all());
        tap($update)->update($request->except('image', 'gallery', 'deleteImage', 'deleteCover'));

        $this->mediaService->updateMedia(
            $update, 
            $request->file('image'),
            $request->input('deleteImage'),
            'page',
            false
        );

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $this->mediaService->handleMediaUpload(
                    $update,
                    $file,
                    'gallery',
                    false,
                    true
                );
            }
        }


        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('page.index');

    }

    public function destroy($id)
    {
        $Delete = Page::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('page.index');
    }

    public function getTrash(){
        $Trash = Page::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.page.trash', compact('Trash'));
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

        $Delete = Page::find($id);
        $Delete->media()->where('id', \request('image_id'))->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('page.edit', $id);

    }
}
