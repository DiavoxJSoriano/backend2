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
                                <th scope="col">Email</th>
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


                    <!-- Modal Sign Up -->
                    <div class="modal" id="modal_signup">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <!-- <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div> -->

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <!-- form card register -->
                                    <div class="card card-outline-secondary">
                                        <div class="card-header">
                                            <h3 class="mb-0">Add User</h3>
                                        </div>
                                        <div class="card-body">
                                            <form class="form" role="form" autocomplete="off" id="frm_signup">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="reg_username">Username *</label>
                                                    <input type="text" class="form-control" id="reg_username" placeholder="Username">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reg_email">Email *</label>
                                                    <input type="email" class="form-control" id="reg_email" placeholder="Email" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reg_password">Password *</label>
                                                    <input type="password" class="form-control" id="reg_password" placeholder="Password" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reg_verify">Verify *</label>
                                                    <input type="password" class="form-control" id="reg_verify" placeholder="Password (again)" required="">
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" id="btnRegister" class="btn btn-success btn-lg float-right">Register</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /form card register -->

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Profile -->
                    <div class="modal" id="modal_edit">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <!-- <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div> -->

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <!-- form card modify -->
                                    <div class="card card-outline-secondary">
                                        <div class="card-header">
                                            <h3 class="mb-0">Edit Profile</h3>
                                        </div>
                                        <div class="card-body">
                                            <form class="form" role="form" autocomplete="off" id="frm_edit">
                                                @method('PUT')
                                                @csrf

                                                <input type="hidden" class="form-control" id="hid_id">
                                                <div class="form-row form-group">
                                                    <div class="col">
                                                        <label for="edit_first">First Name</label>
                                                        <input type="text" class="form-control" id="edit_first" placeholder="First name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="edit_last">Last Name</label>
                                                        <input type="text" class="form-control" id="edit_last" placeholder="Last name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_email">Email</label>
                                                    <input type="email" class="form-control" id="edit_email" placeholder="Email" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_address">Address</label>
                                                    <textarea class="form-control" rows="5" id="edit_address"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_postcode">Postal Code</label>
                                                    <input type="email" class="form-control" id="edit_postcode" placeholder="Postal code" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_phone">Contact Phone</label>
                                                    <input type="email" class="form-control" id="edit_phone" placeholder="Contact number" required="">
                                                </div>

                                                <div class="form-group">
                                                    <button type="button" id="btnSave" class="btn btn-success btn-lg float-right">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /form card modify -->

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <div class="container inline">
                    <button type="button" id="btnAdd" class="btn btn-success">Add</button>
                    <!-- <button type="button" id="btnData" class="btn btn-success">Show Data</button> -->
                    <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Convert Table To DataTable
        var table;
        var selected = [];
        $.noConflict();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        LoadDataTable();

        // Table Multiple Selection
        $('#table_manage tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
            var data = table.row(this).data();
            console.log(data);
            $("#hid_id").val(data.id);
            $("#edit_first").val(data.name_first);
            $("#edit_last").val(data.name_last);
            $("#edit_email").val(data.email);
            $("#edit_address").val(data.address);
            $("#edit_postcode").val(data.postcode);
            $("#edit_phone").val(data.contact_phone);
        });

        // Add New Record
        $("#btnAdd").click(function() {
            $('#modal_signup').modal('show');
        });

        // Delete Multiple Records
        $("#btnDelete").click(function() {
            //alert("Delete");

            var data = table.rows('.selected').data();
            var ids = [];

            if (data == 0) {
                alert("Please select users to be removed!");
                return;
            }

            $.each(data, function(key, value) {
                console.log("Key: " + key + ", Value: " + value);
                console.log(data[key]["id"]);
                ids.push(data[key]["id"]);
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('user.destruct') }}",
                data: {
                    ids: ids
                },
                /* headers: {
                    Authorization: 'Bearer '+load_api_config()
                }, */
                success: function(data, textStatus) {
                    console.log(textStatus);
                    console.log(data.responseText);
                    alert("User(s) has been removed successfully!");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.responseText);
                    var errorObj = JSON.parse(XMLHttpRequest.responseText);
                    alert(errorObj.status);
                },
                /* complete: function(XMLHttpRequest, textStatus) {
                    console.log(XMLHttpRequest.responseText);
                } */
            });

            LoadDataTable();
        });

        // Debug Table Selected Data
        $('#btnData').click(function() {
            console.log(table.rows('.selected').data());
            var data = table.rows('.selected').data();
            console.log("length: " + data.length);
            console.log(data[0].id);
            var ids = [];
            $.each(data, function(key, value) {
                console.log("Key: " + key + ", Value: " + value);
                console.log(data[key]["id"]);
                ids.push(data[key]["id"]);
            });
            console.log(ids);
        });

        // Edit Button Modal Popup
        $('#table_manage tbody').on('click', '#btnEdit', function() {
            event.stopPropagation();
            $('#modal_edit').modal('show');
        });

        // Add New Record
        $("#btnRegister").click(function() {
            event.preventDefault();

            console.log("attempting to register...");

            var username = $("#reg_username").val();
            var email = $("#reg_email").val();
            var password = $("#reg_password").val();
            var verify = $("#reg_verify").val();

            console.log(username + " - " + email + " - " + password + " - " + verify);

            if (username == "" || email == "" || password == "" || verify == "") {
                alert("Please enter required fields!");
                return;
            }

            if (password != verify) {
                alert("Password doesn't match!");
                return;
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('user.store') }}",
                /* headers: {
                    Authorization: 'Bearer '+load_api_config()
                }, */
                data: {
                    username: username,
                    email: email,
                    password: password,
                },
                success: function(data, textStatus) {
                    console.log(textStatus);
                    console.log(data.responseText);
                    alert("User has been added successfully!");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.responseText);
                    var errorObj = JSON.parse(XMLHttpRequest.responseText);
                    alert(errorObj.status);
                },
                /* complete: function(XMLHttpRequest, textStatus) {
                    console.log(XMLHttpRequest.responseText);
                } */
            });

            LoadDataTable();
            $('#modal_signup').modal('hide');
        });


        // Save Changes to Record
        $("#btnSave").click(function() {
            event.preventDefault();

            console.log("attempting to save changes...");

            var id = $("#hid_id").val();
            var first = $("#edit_first").val();
            var last = $("#edit_last").val();
            var email = $("#edit_email").val();
            var address = $("#edit_address").val();
            var postcode = $("#edit_postcode").val();
            var phone = $("#edit_phone").val();
            var fullName = first + " " + last;

            console.log(id + " - " + first + " - " + last + " - " + email + " - " + address + " - " + postcode + " - " + phone);
            console.log("{{ route('user.update', ':v') }}");

            // Pass :v as variable then replace it with the js data value.
            var fullPath = "{{ route('user.update', ':v') }}";
            fullPath = fullPath.replace(':v', id);
            console.log(fullPath);

            $.ajax({
                type: 'PUT',
                url: fullPath,
                /* headers: {
                    Authorization: 'Bearer '+load_api_config()
                }, */
                data: {
                    name: fullName,
                    name_first: first,
                    name_last: last,
                    email: email,
                    address: address,
                    postcode: postcode,
                    contact_phone: phone,
                },
                success: function(data, textStatus, XMLHttpRequest) {
                    console.log(textStatus);
                    console.log(data);
                    console.log(XMLHttpRequest);
                    alert("User has been updated successfully!");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.responseText);
                    var errorObj = JSON.parse(XMLHttpRequest.responseText);
                    alert(errorObj.status);
                },
                /* complete: function(XMLHttpRequest, textStatus) {
                    console.log(XMLHttpRequest.responseText);
                } */
            });

            LoadDataTable();
            $('#modal_edit').modal('hide');
        });


        function LoadDataTable() {

            table = $("#table_manage").DataTable({
                "processing": true,
                "bDestroy": true, // if problem cannot reinitialize appears
                "ajax": {
                    type: 'GET',
                    url: "{{ route('user.index') }}",
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
                        "data": "email"
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
                    "targets": [5],
                    "data": null,
                    "defaultContent": "<button type='button' id='btnEdit' class='btn btn-warning'>Edit</button>"
                }],
            });
        }

    });
</script>

@endsection
