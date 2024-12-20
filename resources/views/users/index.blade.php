@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Users') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label for="from_date" class="form-label fw-bold">From Date</label>
                                    <input type="date" class="form-control" id="from_date">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="to_date" class="form-label fw-bold">To Date</label>
                                    <input type="date" class="form-control" id="to_date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered" id="yajra-data-table">
                                    <thead>
                                        <tr>
    {{--                                        <th>S.No</th>--}}
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#yajra-data-table').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("users.index") }}',
                    type: 'GET',
                    data: function(data) {
                        data.from_date = $('#from_date').val(); // Get value of from_date input
                        data.to_date = $('#to_date').val();     // Get value of to_date input
                    }
                },
                columns: [
                    // {data: 'DT_RowIndex'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'created_at'},
                ]
            });
        });

        $(document).on('change', "#from_date, #to_date", function() {
            $('#yajra-data-table').DataTable().ajax.reload(null, false);
        });
    </script>
@endsection
