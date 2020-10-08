@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Management') }}</div>

                <div class="card-body">
                    <table id="table_manage" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name_first }}</td>
                                <td>{{ $user->name_last }}</td>
                                <td>{{ $user->address }}</td>
                                <td><button type="button" class="btn btn-warning">Edit</button></td>
                            </tr>
                            @empty
                            <div class="alert alert-warning">
                                <strong>Sorry!</strong> No Product Found.
                            </div>
                            @endforelse -->
                        </tbody>
                    </table>
                </div>

                <div class="container inline">
                    <button type="button" id="btnAdd" class="btn btn-info">Add</button>
                    <button type="button" id="btnData" class="btn btn-success">Show Data</button>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Convert Table To DataTable
        var selected = [];
        $.noConflict();

        var table = $("#table_manage").DataTable({
            "processing": true,
            "ajax": {
                type: 'GET',
                url: "http://localhost:8000/api/user",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                /* headers: {
                    Authorization: 'Bearer '+load_api_config()
                }, */
                select: "true",
                dataSrc: "data",
                error: function(jqXHR, ajaxOptions, thrownError) {
                    console.log("Cannot retrieve.", "error");
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name_first"
                },
                {
                    "data": "name_last"
                },
                {
                    "data": "address"
                }
            ],
            "columnDefs": [{
                "targets": [4],
                "data": null,
                "defaultContent": "<button type='button' class='btn btn-warning'>Edit</button>"
            }],
        });

        // Table Multiple Selection
        $('#table_manage tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        // Add New Record
        $("#btnAdd").click(function() {
            $.get("http://localhost:8000/api/user", function(data, status) {
                alert("Data: " + data + "\nStatus: " + status);
            });
        });

        // Debug Table Selected Data
        $('#btnData').click(function() {
            console.log(table.rows('.selected').data());
        });

    });
</script>

@endsection
