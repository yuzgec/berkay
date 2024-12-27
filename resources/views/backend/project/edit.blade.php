@extends('backend.layout.app')
@section('title', $Edit->title.' | Proje Düzenle')
@section('content')
    {{Form::model($Edit, ["route" => ["project.update", $Edit->id],'enctype' => 'multipart/form-data'])}}
    @method('PUT')
    {{ Form::hidden('id', $Edit->id) }}
    <div class="row">
        <div class="col-12 col-md-9">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="d-flex">
                        <h4 class="card-title justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Proje Düzenle [ {{$Edit->title }}]
                        </h4>
                    </div>
                    <div>
                        <a class="btn btn-tabler btn-sm p-2" href="{{  url()->previous() }}" title="Geri">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 18v-6a3 3 0 0 0 -3 -3h-10l4 -4m0 8l-4 -4" /></svg>
                            Geri
                        </a>
                        <button class="btn btn-tabler btn-sm p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="10" y1="14" x2="21" y2="3" /><path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                            Kaydet
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-form-inputtext label="Başlık" name="title"/>
                    <x-form-select label="Kategori" name="category" :list="$Kategori"/>
                    <x-form-textarea label="Açıklama" name="desc"/>
                </div>
            </div>


        </div>

        <div class="col-12 col-md-3">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="15" y1="8" x2="15.01" y2="8" /><rect x="4" y="4" width="16" height="16" rx="3" /><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" /><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" /></svg>
                        Blog Kapak Resim
                    </h4>
                </div>
                <div class="form-group mb-3 row p-2">
                    <div class="col">
                        <img src="{{ $Edit->getFirstMediaUrl('page', 'thumb')}}" class="img-fluid mb-2" width="250px" alt="Image">
                    </div>
                </div>
                <div class="p-2">
                    <x-form-file label="" name="image"></x-form-file>
                </div>
            </div>

            <div class="card mt-2" >
                <div class="card-header">
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" /><line x1="9" y1="13" x2="15" y2="13" /></svg>
                        Proje Galeri
                    </h4>
                </div>
                <div class="p-2">
                    <input type="file" name="images[]" multiple class="form-control">
                </div>
                <div class="form-group mb-3 row p-2">

                </div>

            </div>
            {{Form::close()}}
            
            @if($Edit->getFirstMediaUrl('gallery'))
            <div class="card mt-2" style="height: calc(30rem + 10px)">
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
            <div class="table-responsive ">
                <table class="table table-hover table-striped table-bordered table-center">
                    <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Sil</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    <div class="divide-y">
                    @foreach($Edit->getMedia('gallery') as $item)
                        <tr id="gallery_{{$item->id}}">
                            <td>
                                <img src="{{ $item->getUrl('thumb')}}" width="75">
                            </td>
                            <td>
                                <form action="{{route('service.deleteGaleriDelete', $Edit->id)}}" method="POST">
                                    <input type="hidden" name="image_id" value="{{$item->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Resim Sil">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </div>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        @endif
        </div>
    </div>


    
@endsection

@section('customJS')
    <script type="text/javascript">

        CKEDITOR.replace( 'aciklama', {
            filebrowserUploadUrl: "{{ route('blog.postUpload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
             allowedContent: true,
            height : 400,
        });
    </script>
@endsection
