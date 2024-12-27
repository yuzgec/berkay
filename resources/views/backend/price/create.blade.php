@extends('backend.layout.app')
@section('title', 'Fiyat Ekle')
@section('content')
    <div class="col-12">
        <div class="card">
            {{Form::open(['route' => 'price.store'])}}

                <div class="card-header d-flex justify-content-between">
                    <x-add title="Fiyat"></x-add>
                    <div>
                        <x-back></x-back>
                        <x-save></x-save>
                    </div>
                </div>
                <div class="card-body">
                <x-form-inputtext label="Adet" name="title"/>
                <x-form-inputtext label="Fiyat" name="price"/>
                <x-form-textarea label="Açıklama" name="desc" />

            </div>
            {{Form::close()}}
        </div>
    </div>

@endsection

@section('customJS')
    <script type="text/javascript">

        CKEDITOR.replace( 'aciklama', {
            height : 250,
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
