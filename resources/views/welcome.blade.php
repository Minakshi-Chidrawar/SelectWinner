<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Select Winners </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container mt-5">
            <h3>Select Winners</h3>
        </div>

        <div class="container py-5">

            <div class="row">
                <div class="col-12">
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add User</a> 
                    <table class="table" id="laravel_crud">
                        <tbody id="users-crud">
                            @foreach($names as $name)
                            <tr id="user_id_{{ $name->id }}">
                                <td>{{ $name->name }}</td>
                                <td>
                                    <a href="javascript:void(0)" id="edit-user" data-id="{{ $name->id }}" class="btn btn-info">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" id="delete-user" data-id="{{ $name->id }}" class="btn btn-danger delete-user">
                                        <span class="fa fa-minus"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>

        <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="userForm" name="userForm" class="form-horizontal">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="create">Save changes
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /*  When user click add user button */
            $('#create-new-user').click(function () {
                $('#btn-save').val("create-user");
                $('#userForm').trigger("reset");
                $('#userCrudModal').html("Add New User");
                $('#ajax-crud-modal').modal('show');
            });
        
            /* When click edit user */
            $('body').on('click', '#edit-user', function () {
                var user_id = $(this).data('id');
                $.get('ajax-crud/' + user_id +'/edit', function (data) {
                    $('#userCrudModal').html("Edit User");
                    $('#btn-save').val("edit-user");
                    $('#ajax-crud-modal').modal('show');
                    $('#user_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                })
            });
            //delete user login
            $('body').on('click', '.delete-user', function () {
                var user_id = $(this).data("id");
                confirm("Are You sure want to delete !");
        
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('ajax-crud')}}"+'/'+user_id,
                    success: function (data) {
                        $("#user_id_" + user_id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });   
        });
        
        if ($("#userForm").length > 0) {
            console.log("Hello");
        }
        if ($("#userForm").length > 0) {
            $("#userForm").validate({        
            submitHandler: function(form) {        
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');            
            $.ajax({
                data: $('#userForm').serialize(),
                url: "{{ route('ajax-crud.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
                    user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                    user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
                    
                    if (actionType == "create-user") {
                        $('#users-crud').prepend(user);
                    } else {
                        $("#user_id_" + data.id).replaceWith(user);
                    }
        
                    $('#userForm').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    $('#btn-save').html('Save Changes');                    
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        }
    })
    }    
    </script>
</html>
