@extends('layouts.app')

@section('header_title', "Add a Book")

@section('js')
@parent
    <script type="text/javascript">

    </script>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-3">New Book Details</h3>
                    </div>
                    <div class="card-body">
                        <form class="mb-5" method="post" action="{{route('bookshelf.store')}}">
                            @csrf

                            @if ($errors->all())
                                <div class="alert alert-danger">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close" style="padding: 10px;"></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session()->has('fail'))
                                <div class="alert alert-danger">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close" style="padding: 10px;"></button>
                                    {{ session()->get('fail') }}
                                </div>
                            @endif

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close" style="padding: 10px;"></button>
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-12 mb-5">
                                    <div class="form-group">
                                        <label class="form-label">Title <strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                    </div>
                                </div>

                            </div>
                            <hr class="mt-5 mb-5">
                            <!-- Buttons -->
                            <button type="submit" class="btn w-100 btn-primary">Create</button>
                            <a href="{{route('bookshelf.index')}}" class="btn w-100 btn-link text-muted mt-2">Back</a>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>           
    </div>
@endsection
