<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BookShelf</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- DataTables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    {{-- font awesome icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .main-header{
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            padding: 0 1rem;
            z-index: 1;
        }

        .main-sidebar{
            position: fixed;
            top: 40px;
            width: var(--nav-width);
            width: 280px;
            padding: .5rem 1rem 0 0;
        }
    </style>
    @yield('css')
    
</head>
<body>
<div class="wrapper">
    @include('layouts.header')
        
    <aside class="col-12 p-0 bg-dark flex-shrink-1 h-100 main-sidebar">
        <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
        <div class="collapse navbar-collapse">
            <ul class="flex-column flex-sm-column  flex-row navbar-nav w-100 justify-content-between ">
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap" href="#"><i class="fa fa-bullseye fa-fw"></i>
                    <span>Dashboard</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="bi bi-book"></i>
                    <span>BookShelf</span></a>
                    <ul>
                        @if(auth()->user())
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{ route('bookshelf.create') }}">
                            <span>Add New Book</span></a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{ route('bookshelf.index') }}">
                            <span>Listing</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        </nav>
    </aside>            

    <div class="main-content h-100" style="margin-left: 280px; margin-top:40px">

        <div class="container-fluid">

            <div class="col-12">
                <div class="header">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col my-3">
                                <h1 class="header-title text-truncate">@yield('header_title')</h1>
                            </div>
                        </div>
                    </div>
                </div>             
            @yield('content')
        </div>

    </div>    
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    function getDtAjaxData(data) {
        data._token = "{{csrf_token()}}";
        data._act = "get_listing";
        data.searchParams = getDtSearchParams($("#searchForm"));
    }

    function getDtSearchParams(searchForm) {
        var obj = {};

        $("input, select", searchForm).each(function () {
            obj[$(this).attr("name")] = $(this).val();
        });
        return JSON.stringify(obj);
    }

    function initDtSearchButton(searchButton, searchForm, dataTable) {
        searchForm.submit(function (event) {
            if (dataTable != null) {
                event.preventDefault();
                dataTable.ajax.reload();
            }
        });

        searchButton.click(function () {
            if (dataTable != null) {
                dataTable.ajax.reload();
            }
        });

        $("input", searchForm).keyup(function (e) {
            var obj = $(this);

            if (!obj.prop("readonly") && !obj.prop("disabled")) {
                if (e.keyCode == 13) {
                    searchButton.trigger("click");
                }
            }
        });
    }

    function swError() {
        showErrorModal(true);
    }

    function swSuccess() {
        showSuccessModal(true);
    }

    function showErrorModal(show) {
        swShowCustomModal($("#errorModal"), show);
    }

    function showSuccessModal(show) {
        swShowCustomModal($("#successModal"), show);
    }

    function swShowCustomModal(modalSelector, show) {
        if (show) {
            setTimeout(function () {
                modalSelector.modal("show");
            }, 800);
        } else {
            modalSelector.modal("hide");
        }
    }
</script>
@yield('js')
</body>
</html>

