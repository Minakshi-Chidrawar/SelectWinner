<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Select Winners </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container mt-5">
            <h3>Select Winners</h3>
        </div>

        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    <strong>Success:</strong> {{ session()->get('message') }}
                </div>
            @endif

            @yield('content')
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#add', function(){
                //alert("hello");
                $('#userForm').trigger("reset");
                $('#saveName').val("create");
                $('#titleForModal').html("Add New User");                
                $('#addEditNameModal').modal('show');
            });

            $(document).on('click', '#saveName', function () {
                var user_id = $(this).data('id');
                var actionType = $('#saveName').val();
                alert($('#userForm').serialize());
                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "{{ route('store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alert("id is :" + data.id);
                        alert("Name is :" + data.name);
                        alert(actionType);

                        var user = '<tr id="user_id_' + data.id + '"><td>' + data.name + '</td>';
                        user += '<td><a href="javascript:void(0)" id="editName" data-id="' + data.id + '" data-name="' + data.name + '" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a> ';
                        user += '<a href="javascript:void(0)" id="deleteName" data-id="' + data.id + '" data-name="' + data.name + '" class="btn btn-danger btn-sm delete-user"><span class="fa fa-minus"></span></a></td></tr>';
                        $('#userForm').trigger("reset");
                        $('#addEditNameModal').modal('hide');                        
                        if (actionType == "create") {
                            $('#nameList').append(user);
                        } else {
                            $("#user_id_" + data.id).replaceWith(user);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            $(document).on('click', '#editName', function () {
                var user_id = $(this).data('id');
                var user_name = $(this).data('name');
                $('#userForm').trigger("reset");
                $('#titleForModal').html("Edit User");
                $('#saveName').val("edit-user");
                $('#addEditNameModal').modal('show');
                $('#user_id').val(user_id);
                $('#name').val(user_name);
            });

            //delete user name
            $(document).on('click', '.delete-user', function () {
                var user_id = $(this).data("id");
                var user_name = $(this).data('name');
                var deleteText = 'Are you Sure you want to delete ' + user_name + ' ?';
                $('#user_id').val(user_id); 
                $('.deleteContent').text(deleteText);
                $('#deleteModal').modal('show');
            });

            $(document).on('click', '#deleteUser', function() {
                var user_id = $('#user_id').val();
                $.ajax({
                    type: 'delete',
                    url: '/'+user_id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': user_id
                    },
                    success: function(data) {
                        $("#user_id_" + user_id).remove();
                        $('#deleteModal').modal('hide');
                    }
                });
            });

            $(document).on('click', '#selectWinner', function () {
                $('#selectWinnerForm').trigger("reset");
                $('#titleModal').html("Number to select for the winners");                
                $('#selectWinnerModal').modal('show');
            });
        });
    </script>
</html>