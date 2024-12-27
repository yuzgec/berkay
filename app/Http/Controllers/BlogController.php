<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\PageRequest;

class BlogController extends Controller
{

    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }
    
    public function index()
    {
        $All = Blog::with('getCategory')->orderBy('rank')->get();
        $Kategori = BlogCategory::all();
        return view('backend.blog.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = BlogCategory::pluck('title', 'id');
        return view('backend.blog.create',  compact('Kategori'));
    }


    public function store(BlogRequest $request)
    {
        $New = Blog::create($request->except('image', 'gallery'));

        
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


        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('blog.index');

    }


    public function show($id)
    {
        $Show = Blog::findOrFail($id);
        return view('frontend.blog.index', compact('Show'));

    }

    public function edit($id)
    {
        $Edit = Blog::findOrFail($id);
        $Kategori = BlogCategory::pluck('title', 'id');
        return view('backend.blog.edit', compact('Edit', 'Kategori'));
    }

    public function update(BlogRequest $request, $id, Blog $update)
    {

        tap($update)->update($request->except('image', 'gallery', 'deleteImage', 'deleteCover'));

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
        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('blog.index');

    }

    public function destroy($id)
    {
        $Delete = Blog::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('blog.index');
    }

    public function getTrash(){
        $Trash = Blog::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.blog.trash', compact('Trash'));
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Blog::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Blog::findOrFail($request->id);
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
