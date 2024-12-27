<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Models\ServiceCategory;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{

    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }


    public function index()
    {
        $All = Service::with('getCategory')->orderBy('rank')->get();
        $Kategori = ServiceCategory::all();
        return view('backend.service.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = ServiceCategory::pluck('title', 'id');
        return view('backend.service.create',  compact('Kategori'));
    }


    public function store(ServiceRequest $request)
    {

        $New = Service::create($request->except('image', 'images'));

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

        $New->save();

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('service.index');

    }


    public function show($id)
    {
        $Show = Service::findOrFail($id);
        return view('frontend.service.index', compact('Show'));
    }

    public function edit($id)
    {


        $Edit = Service::findOrFail($id);

        //dd($Edit->getMedia('page'));
        $Kategori = ServiceCategory::pluck('title', 'id');
        return view('backend.service.edit', compact('Edit', 'Kategori'));
    }

    public function update(ServiceRequest $request, Service $update)
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

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('service.index');

    }

    public function destroy($id)
    {
        $Delete = Service::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('service.index');
    }

    public function getTrash(){
        $Trash = Service::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.service.trash', compact('Trash'));
    }

    public function getOrder(Request $request){
        foreach($request->get('service') as  $key => $rank ){
            Service::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Service::findOrFail($request->id);
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

    public function deleteGaleriDelete($id){

        $Delete = Service::find($id);
        $Delete->media()->where('id', \request('image_id'))->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('service.edit', $id);

    }
}
