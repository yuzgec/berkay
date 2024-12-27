@extends('backend.layout.app')
@section('title', 'Video Ekle')
@section('content')
    <div class="col-12 col-md-12">
        <div class="card">
            {{Form::open(['route' => 'video.store', 'enctype' => 'multipart/form-data'])}}

                <div class="card-header d-flex justify-content-between">
                    <x-add title="Video"></x-add>
                    <div>
                        <x-back></x-back>
                        <x-save></x-save>
                    </div>
                </div>
                <div class="card-body">
                <x-form-inputtext label="Başlık" name="title"/>
                <x-form-inputtext label="Video URL" name="video_url"/>
                <x-form-select label="Kategori" name="category" :list="$Kategori"/>
                <x-form-textarea label="Açıklama" name="desc" />

            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection

@section('customJS')
    <script type="text/javascript">

        CKEDITOR.replace( 'aciklama', {
            filebrowserUploadUrl: "{{ route('video.postUpload', ['_token' => csrf_token()]) }}",
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
