@extends('layouts.app')

@section('header_title', "Dashboard")

@section('js')
@parent
    <script type="text/javascript">
    var datatable = null;
    $(document).ready(function () {
        datatable = $('#dataTable').DataTable({
            "searching": false,
            "cache": false,
            "lengthChange": true,
            "responsive": false,
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": {
                "url": "{{url('get')}}",
                "type": "POST",
                "cache": false,
                "data": function (d) {
                    console.log(d);
                    return getDtAjaxData(d);
                },
                "error": function (XMLHttpRequest, textStatus, errorThrown) {
                    swError(errorThrown);
                }
            },
            "order": [[1, "desc"]],
            "columnDefs": [
                {
                    "targets": [0],
                    "sortable": false
                }
            ],
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var btn_view = '<a type="button" class="btn btn-primary btn-sm detailBtn" href="' + "{{url('book')}}" + "/" + aData[0] + '"><i class="fa fa-eye"></i> View</a>';
                $("td:eq(0)", nRow).html(btn_view);
                // var btn_delete = '<a type="button" class="btn btn-danger btn-sm deleteBtn" href="' + "{{url('book')}}" + "/" + aData[0] +'"><i class="fa fa-trash"></i> Delete</a>';
                // $("td:eq(0)", nRow).html(btn_delete)
            }        
        })
        initDtSearchButton($("#btnSearch"), $("#searchForm"), datatable);
    });

    $('#is_read').on('change', function(){
        // if($(this).is(':checked')){
        //     $(this).val(1);
        // }else{
        //     $(this).val(0);
        // }
        
        // console.log($(this).val());
    })

    // $("#date").flatpickr();
    </script>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="tab-content">
        <div class="tab-pane fade show active" role="tabpanel">
            <div class="card w-50" style="margin-left:25%">
                <div class="card-header">
                    <h3>Filter</h3>
                </div>
                <div class="card-body">
                    <form id="searchForm" action="{{url('get')}}" method="POST" role="form">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Book Title</label>
                                        <input type="text" class="form-control" name="book_title" id="book_title">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Date</label>
                                        <input type="text" class="form-control flatpickr-input active" name="date" id="date" data-flatpickr="{&quot;mode&quot;: &quot;range&quot;}" readonly="readonly">
                                    </div>
                                </div> --}}

                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        {{-- <input type="checkbox" class="form-check-input" name="is_read" id="is_read" value="0"> --}}
                                        <label class="form-label">Is Read</label>
                                        <select class="form-control" name="is_read" id="is_read">
                                            @foreach(\App\Models\BookShelf::getReadStatusOptions() as $key => $value)
                                                <option value="{{$value}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col"></div>
                                <div class="col-auto">
                                    <button type="button" id="btnSearch" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <br/>

            <div class="card w-75 mb-5" style="margin-left:13%">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-header-title">Listing</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-0" style="margin-top: 10px;">
                    <table id="dataTable" class="table table-sm table-nowrap card-table table-striped" width="100%">
                        <thead>
                        <tr>
                            <th><a class="list-sort text-muted">Action</a></th>
                            <th><a class="list-sort text-muted">Title</a></th>
                            <th><a class="list-sort text-muted">Description</a></th>
                            <th><a class="list-sort text-muted">Is Read</a></th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr><td colspan="4"></td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection