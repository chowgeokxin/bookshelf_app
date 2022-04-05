@extends('layouts.app')

@section('header_title', "Book Details")

@section('js')
@parent
    <script type="text/javascript">
        $(document).ready(function(){
            // 
        })
    </script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title ">Book Details</h3>
                </div>
                <div class="card-body">
                    <form class="mb-5" method="post" action="{{route('bookshelf.update', ['id'=> $data->id])}}">
                        @csrf
                        @method('PUT')

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
                            <div class="col-lg-12 mt-3 mb-4">
                                <div class="form-group">
                                    <label class="form-label">Title<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ $data->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="is_read" id="is_read" value="{{ $data->is_read }}" {{ $data->is_read == '1' ? 'checked':''}}>
                                    <label class="form-label">Readed</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Created At</label>
                                    <input type="text" class="form-control" value="{{$data->created_at}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Updated At</label>
                                    <input type="text" class="form-control" value="{{$data->updated_at}}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-5 mb-5">

                        <!-- Buttons -->
                        <button type="submit" class="btn w-100 btn-primary"><i class="fa fa-save"></i> Update</button>
                        <a href="#" class="btn w-100 btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="fa fa-trash"></i> Delete</a>
                        <a href="{{route('bookshelf.index')}}" class="btn w-100 btn-link text-muted mt-2">Back</a>
                    </form>
                </div>
            </div>
            
        </div>
    </div>           
</div>


<!-- Modal: Members -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-card card">
                <div class="card-header">
                    <!-- Title -->
                    <h4 class="card-header-title" id="exampleModalCenterTitle"></h4>
                    <!-- Close -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <h4 class="form-label">Are you sure you want to delete this item?</h4>
                </div>
                <div class="card-footer">
                    @if(auth()->user())
                    <form class="mb-4" method="post" action="{{ route('bookshelf.delete',['id'=>$data->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Yes</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection