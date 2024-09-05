<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('assets/img/favicon/favicon.ico"')}}' />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }} " class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />


    <!-- Datatables CSS -->
    <link
        href="https://cdn.datatables.net/v/bs5/dt-2.1.5/b-3.1.2/b-html5-3.1.2/r-3.0.3/sc-2.4.3/sb-1.8.0/datatables.min.css"
        rel="stylesheet">


    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('backend.sidebar')

            <!-- Layout container -->
            <div class="layout-page">

                @include('backend.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Training /</span> Data Table
                        </h4>

                        <!-- Bordered Table -->
                        <div class="card">
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-10">
                                    <h5 class="card-header">Data Training Tables</h5>
                                </div>

                                {{-- CREATE DATA --}}
                                <div class="col-2">
                                    <div class="mt-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter">
                                            <i class='bx bx-plus-circle'></i> Add Data
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade"  id="modalCenter" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Add Data Training
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('training.store') }}" method="post"
                                                        role="form" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 col-form-label"
                                                                        for="basic-icon-default-fullname">Nama
                                                                        Training</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bx-category'></i></span>
                                                                            <input type="text" class="form-control"
                                                                                id="basic-icon-default-fullname"
                                                                                placeholder="AI Development"
                                                                                aria-label="John Doe"
                                                                                name="nama_training"
                                                                                aria-describedby="basic-icon-default-fullname2" />
                                                                        </div>
                                                                    </div>
                                                                    @error('nama_training')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 col-form-label"
                                                                        for="basic-icon-default-company">Tanggal
                                                                        Mulai</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-company2"
                                                                                class="input-group-text"><i
                                                                                    class="bx bx-buildings"></i></span>
                                                                            <input class="form-control" type="date"
                                                                                name="tanggal_mulai"
                                                                                id="tanggal_mulai" value="2024-01-01"
                                                                                id="html5-date-input" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 col-form-label"
                                                                        for="basic-icon-default-company">Tanggal
                                                                        Selesai</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-company2"
                                                                                class="input-group-text"><i
                                                                                    class="bx bx-buildings"></i></span>
                                                                            <input class="form-control"
                                                                                name="tanggal_selesai"
                                                                                id="tanggal_selesai" type="date"
                                                                                value="2024-01-01"
                                                                                id="html5-date-input" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 col-form-label"
                                                                        for="basic-icon-default-fullname">Kode</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bx-category'></i></span>
                                                                            <input type="text" class="form-control"
                                                                                id="basic-icon-default-fullname"
                                                                                placeholder="AI Development"
                                                                                aria-label="John Doe" name="kode"
                                                                                aria-describedby="basic-icon-default-fullname2" />
                                                                        </div>
                                                                    </div>
                                                                    @error('kode')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 form-label"
                                                                        for="basic-icon-default-phone">Cover</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-phone2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bx-image'></i></span>
                                                                            <input class="form-control" type="file"
                                                                                id="formFile" name="cover" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 form-label"
                                                                        for="basic-icon-default-message">Deskripsi</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-message2"
                                                                                class="input-group-text"><i
                                                                                    class="bx bx-comment"></i></span>
                                                                            <textarea id="basic-icon-default-message" class="form-control" name="konten"
                                                                                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pelatihan</th>
                                                <th>tanggal</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach ($training as $data)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td><b>{{ $data->nama_training }}</b></td>
                                                    <td>{{ $data->formatted_tanggal }}</td>
                                                    <form action="{{ route('training.destroy', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <td>
                                                            <a href="{{ route('training.show', $data->id) }}"
                                                                class="btn btn-sm btn-warning"
                                                                data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                data-bs-placement="top" data-bs-html="true"
                                                                title="<span>Show</span>"><i
                                                                    class='bx bx-show-alt'></i></a>
                                                            <a href="{{ route('training.edit', $data->id) }}"
                                                                class="btn btn-sm btn-primary"
                                                                data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                data-bs-placement="top" data-bs-html="true"
                                                                title="<span>Edit</span>"><i
                                                                    class='bx bxs-edit-alt'></i></a>
                                                            <button class="btn btn-sm btn-danger" type="submit"
                                                                data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                data-bs-placement="top" data-bs-html="true"
                                                                title="<span>Delete</span>"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                <i class='bx bx-trash'></i>
                                                            </button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/ Bordered Table -->

                        <hr class="my-5" />

                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>


    </div>
    <!-- / Layout wrapper -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                var myModal = new bootstrap.Modal(document.getElementById('modalCenter'));
                myModal.show();
            @endif
        });
    </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    @include('sweetalert::alert')
    <!-- endbuild -->

    <!-- Datatables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/dt-2.1.5/b-3.1.2/b-html5-3.1.2/r-3.0.3/sc-2.4.3/sb-1.8.0/datatables.min.js">
    </script>
    <script>
        let table = new DataTable('#myTable');
    </script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
