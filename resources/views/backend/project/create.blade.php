@extends('backend.layout.app')
@section('title', 'Proje Ekle')
@section('content')
    <div class="col-12 col-md-9">
        <div class="card">
            {{Form::open(['route' => 'project.store', 'enctype' => 'multipart/form-data'])}}
                <div class="card-header d-flex justify-content-between">
                   <x-add title="Proje"></x-add>
                    <div>
                        <x-back></x-back>
                        <x-save></x-save>
                    </div>
                </div>

                <div class="card-body">

                      <x-form-inputtext label="Başlık Adı Giriniz" name="title"/>
                      <x-form-select label="Kategori" name="category" :list="$Kategori"/>
                      <x-form-textarea label="Açıklama" name="desc" />
                      
                 </div>
            {{Form::close()}}
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="15" y1="8" x2="15.01" y2="8" /><rect x="4" y="4" width="16" height="16" rx="3" /><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" /><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" /></svg>
                    Proje Kapak Resim
                </h4>
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
        </div>
    </div>
@endsection

@section('customJS')
    <script type="text/javascript">

        CKEDITOR.replace( 'aciklama', {
            filebrowserUploadUrl: "{{ route('project.postUpload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            height : 400,
            toolbar: [
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold']},
                { name: 'paragraph',items: [ 'BulletedList']},
                { name: 'colors', items: [ 'TextColor' ]},
                { name: 'styles', items: [ 'Format', 'FontSize']},
                { name: 'links', items : [ 'Link', 'Unlink'] },
                { name: 'insert', items : [ 'Image', 'Table']},
                { name: 'document', items : [ 'Source','Maximize' ]},
                { name: 'clipboard', items : [ 'PasteText', 'PasteFromWord' ]},
            ],
        });
    </script>
@endsection
