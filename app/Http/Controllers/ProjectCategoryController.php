<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Models\ProjectCategory;
use App\Http\Requests\ProjectCategoryRequest;

class ProjectCategoryController extends Controller
{
  
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $All = ProjectCategory::get()->toFlatTree();
        return view('backend.projectcategory.index', compact('All'));
    }

    public function create()
    {
        $Kategori = ProjectCategory::pluck('title', 'id');
        return view('backend.projectcategory.create',  compact('Kategori'));
    }

    public function store(ProjectCategoryRequest $request)
    {
         $New = ProjectCategory::create($request->except('image', 'images'));
        
        
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


        if ($request->parent_id){
            $node = ProjectCategory::find($request->parent_id);
            $node->appendNode($New);
        }

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('project-categories.index');

    }


    public function show($id)
    {
        $Show = ProjectCategory::findOrFail($id);
        return view('frontend.pagecategory.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = ProjectCategory::findOrFail($id);
        $Kategori = ProjectCategory::pluck('title', 'id');
        return view('backend.projectcategory.edit', compact('Edit', 'Kategori'));
    }

    public function update(ProjectCategoryRequest $request, $id, ProjectCategory $update)
    {

        tap($update)->update($request->except('image', 'images', 'deleteImage', 'deleteCover'));

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



        if ($request->parent){
            $node = ProjectCategory::find($request);
            $node->appendNode($update);
        }

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('project-categories.index');

    }

    public function destroy($id)
    {
        $Delete = ProjectCategory::find($id);
        if($Delete->getCategoryCount() > 0){
            alert()->error('Silinemez','Kategoriye ait sayfa bulunmaktadır.');
            return Redirect::back();
        }
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('project-categories.index');
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
