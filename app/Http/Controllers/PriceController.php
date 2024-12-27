<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $All = Price::all();
        return view('backend.price.index', compact('All'));
    }

    public function create()
    {
        return view('backend.price.create');
    }


    public function store(PriceRequest $request)
    {
        $New = new Price;
        $New->title = $request->title;
        $New->price = $request->price;
        $New->desc = $request->desc;
        $New->save();

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('price.index');

    }

    public function show($id)
    {
        $Show = Price::findOrFail($id);
        return view('frontend.price.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = Price::findOrFail($id);
        return view('backend.price.edit', compact('Edit'));
    }

    public function update(PriceRequest $request, $id)
    {
        $Update = Price::findOrFail($id);
        $Update->title = $request->title;
        $Update->price = $request->price;
        $Update->desc = $request->desc;
        $Update->save();

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('price.index');

    }

    public function destroy($id)
    {
        $Delete = Price::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('page.index');
    }


    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Price::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Price::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

    public function getHome(Request $request){
        $update=Price::findOrFail($request->id);
        $update->active = $request->active == "true" ? 1 : 0 ;
        $update->save();
    }
}
