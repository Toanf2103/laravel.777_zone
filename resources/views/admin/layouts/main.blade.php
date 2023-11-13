<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="root-url" data-index="{{ URL::to('/'); }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- End bootstrap -->

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">
    <!-- End Fontawesome -->

    <!-- Header -->
    <link rel="stylesheet" href="{{ url('public/admin/css/header.css') }}">
    <!-- End Header -->

    <!-- Sidebar -->
    <link rel="stylesheet" href="{{ url('public/admin/css/sidebar.css') }}">
    <!-- End sidebar -->

    @yield('css')
</head>

<body>
    <div class="wrapper">
        @include('admin/partials/header')
        @include('admin/partials/sidebar')
        <div class="content">
            <div class="content-header row mb-5">
                <div class="col-6 d-flex">
                    <h1 class="fw-bold" style="font-size: 1.8rem;">@yield('title-content')</h1>
                </div>
                <div class="col-6 d-flex align-items-end justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </div>

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- End Bootstrap JS -->

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End Sweetalert2 -->

    <!-- Main JS -->
    <script src="{{ url('public/admin/js/admin.js') }}"></script>
    <!-- End main JS -->

    @yield('js')
</body>

</html>