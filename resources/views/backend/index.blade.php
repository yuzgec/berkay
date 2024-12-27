@extends('backend.layout.app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-3">Kullanılan Alan <strong>276MB </strong>of 8 GB</p>
                <div class="progress progress-separated mb-3">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 44%"></div>
                    <div class="progress-bar bg-info" role="progressbar" style="width: 19%"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 9%"></div>
                </div>
                <div class="row">
                    <div class="col-auto d-flex align-items-center pe-2">
                        <span class="legend me-2 bg-primary"></span>
                        <span>Regular</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">915MB</span>
                    </div>
                    <div class="col-auto d-flex align-items-center px-2">
                        <span class="legend me-2 bg-info"></span>
                        <span>System</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">415MB</span>
                    </div>
                    <div class="col-auto d-flex align-items-center px-2">
                        <span class="legend me-2 bg-success"></span>
                        <span>Shared</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">201MB</span>
                    </div>
                    <div class="col-auto d-flex align-items-center ps-2">
                        <span class="legend me-2"></span>
                        <span>Free</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">612MB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-12 col-md-9 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">En Çok Bakılan Sayfalar</h3>
            </div>
            <table class="table card-table table-vcenter">
                <thead>
                <tr>
                    <th>Sayfa Adı</th>
                    <th colspan="2">Ziyaret Sayısı</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hakkımızda</td>
                        <td>3,550</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12 col-md-3 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Aranan Kelimeler</h3>
            </div>
            <table class="table card-table table-vcenter">
                <thead>
                <tr>
                    <th>Aranan Kelime</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Search as $item)
                <tr>
                    <td>{{ $item->key }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

