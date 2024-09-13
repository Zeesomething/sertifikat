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
    <link rel="icon" href="{{ asset('assets/img/logo-bartech-no-text.png') }}" type="image/png">

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Training/</span> Data Detail
                        </h4>

                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">
                            <!-- Basic with Icons -->
                            <div class="col-7">
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0"><b style="color: #0B2B8A">DETAIL DATA</b>
                                            <hr style="height: 3px; width: 95%; background-color: #0B2B8A">
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('training.update', $training->id) }}" method="post"
                                            role="form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Jenis Training</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i
                                                                class='bx bx-category'></i></span>
                                                        <input type="text" class="form-control" disabled
                                                            id="basic-icon-default-fullname"
                                                            placeholder="AI Development" aria-label="John Doe"
                                                            name="nama_training" style="padding-left: 15px;"
                                                            aria-describedby="basic-icon-default-fullname2"
                                                            value="{{ $training->nama_training }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Tanggal Mulai</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2"
                                                            class="input-group-text"><i
                                                                class="bx bx-buildings"></i></span>
                                                        <input class="form-control" type="date" name="tanggal_mulai"
                                                            disabled id="html5-date-input" style="padding-left: 15px;"
                                                            value="{{ $training->tanggal_mulai }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Tanggal Selesai</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2"
                                                            class="input-group-text"><i
                                                                class="bx bx-buildings"></i></span>
                                                        <input class="form-control" name="tanggal_selesai" disabled
                                                            type="date" id="html5-date-input"
                                                            style="padding-left: 15px;"
                                                            value="{{ $training->tanggal_selesai }}" />
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
                                                            style="padding-left: 15px;" placeholder="AI Development"
                                                            aria-label="John Doe" name="kode"
                                                            value="{{ $training->kode }}" disabled
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form action="{{ route('training.update', $training->id) }}" method="post"
                                            role="form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <h5 class="card-title"><b style="color: #0B2B8A ">COVER IMAGE</b>
                                                    <hr style="height: 3px; width: 31%; background-color: #0B2B8A">
                                                </h5>
                                                @csrf
                                                <center><img class="card"
                                                        src="{{ asset('images/training/' . $training->cover) }}"
                                                        width="350">
                                                </center>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5" style="margin-left: 4.5%; margin-top: 3.5%;">
                                                    <a href="{{ route('training.index') }}" class="btn btn-danger"><i
                                                            class='bx bx-arrow-back'></i> Back</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <label class="col-sm-2 form-label" for="basic-icon-default-message">
                                            <h5><b style="color: #0B2B8A">Deskripsi</b></h5>
                                            <hr style="height: 3px; width: 54%; background-color: #0B2B8A">
                                        </label>
                                        <div class="col-sm-11" style="">
                                            <div class="input-group input-group-merge" style="margin-left: 40px;">
                                                {!! $training->konten !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- / Content -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- / CKEditor 5 -->
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var textarea = document.getElementById('basic-icon-default-message');

                function adjustTextareaHeight() {
                    textarea.style.height = 'auto'; // Reset height to auto to get the full content height
                    textarea.style.height = textarea.scrollHeight + 'px'; // Set height to scrollHeight
                }

                adjustTextareaHeight(); // Adjust height on page load

                // Optional: Adjust height on input if the textarea is editable
                textarea.addEventListener('input', adjustTextareaHeight);
            });
        </script>

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- endbuild -->


        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>    
</body>

</html>
