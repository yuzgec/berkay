<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferenceRequest;
use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function index()
    {
        $All = Reference::all();
        return view('backend.reference.index', compact('All'));
    }

    public function create()
    {
        return view('backend.reference.create');
    }

    public function store(ReferenceRequest $request)
    {
        $New = new Reference;
        $New->title = $request->title;

        if($request->hasfile('image')){
            $New->addMedia($request->image)->toMediaCollection('page');
        }

        $New->save();

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('reference.index');

    }


    public function show($id)
    {
        $Show = Reference::findOrFail($id);
        return view('frontend.reference.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = Reference::findOrFail($id);
        return view('backend.reference.edit', compact('Edit'));
    }

    public function update(ReferenceRequest $request, $id)
    {
        $Update = Reference::findOrFail($id);
        $Update->title = $request->title;

        if($request->removeImage == "1"){
            $Update->media()->where('collection_name', 'page')->delete();
        }

        if ($request->hasFile('image')) {
            $Update->media()->where('collection_name', 'page')->delete();
            $Update->addMedia($request->image)->toMediaCollection('page');
        }

        $Update->save();

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('reference.index');

    }

    public function destroy($id)
    {
        $Delete = Reference::findOrFail($id);
        $Delete->delete();
        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('reference.index');
    }

    public function getTrash(){
        $Trash = Reference::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.page.trash', compact('Trash'));
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Reference::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Reference::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }
}
