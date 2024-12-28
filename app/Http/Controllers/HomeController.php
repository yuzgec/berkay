<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Form;
use App\Models\Page;
use App\Models\Team;
use App\Models\Video;
use App\Models\Project;
use App\Models\Service;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Artesaos\SEOTools\Facades\SEOMeta;

class HomeController extends Controller
{

    public function index(){
        SEOMeta::setTitle('İzmir Dekorasyon ve Tadilat Firması');
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.index');

    }

    public function contact(){

        SEOMeta::setTitle('İletişim');
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());
        return view('frontend.contact');
    }

    public function servicedetail($url){
        $Detail = Service::where('slug', $url)->firstOrFail();

        SEOMeta::setTitle($Detail->title);
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.service.detail', compact('Detail'));
    }

    public function service(){

        SEOMeta::setTitle('Çalışma Alanlarımız');
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.service.index');
    }

    public function blogdetail($url){
        $Detail = Blog::where('slug', $url)->firstOrFail();

        SEOMeta::setTitle($Detail->title);
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());


        return view('frontend.blog.detail', compact('Detail'));
    }


    public function corporatedetail($url){
        $Detail = Page::where('slug', $url)->firstOrFail();

        SEOMeta::setTitle($Detail->title);
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.page.detail', compact('Detail'));
    }


    public function blog(){

        SEOMeta::setTitle('Makaleler');
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());

        $Blog = Blog::all();

        return view('frontend.blog.index', compact('Blog'));
    }


    public function proje($url){

        SEOMeta::setTitle('Projeler');
        SEOMeta::setDescription("");
        SEOMeta::setCanonical(url()->full());

        $Detail = ProjectCategory::where('slug', $url)->orderBy('rank')->first();

        return view('frontend.project.index', compact('Detail'));
    }

    public function projedetail($url){
        $Detail = Project::where('slug', $url)->firstOrFail();
        return view('frontend.project.detail',compact('Detail'));
    }

    public function video(){

        SEOMeta::setTitle('Video Galeri');
        SEOMeta::setDescription('');
        SEOMeta::setCanonical(url()->full());

        $Video = Video::all();
        return view('frontend.video.index', compact('Video'));
    }

    public function form(ContactRequest $request){

        $New = new Form;
        $New->name =  $request->name;
        $New->email =  $request->email;
        $New->phone =  $request->phone;
        $New->subject =  $request->subject;
        $New->message =  $request->message;
        $New->save();

        Mail::send("mail.form",compact('New'),function ($message) use($New) {
            $message->to('berkay_dekorasyon@hotmail.com')->subject($New->name.' - Site Bilgi Formu');
        });

        return redirect()->route('home');
    }

}
