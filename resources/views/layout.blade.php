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

            $("#addName").click(function() {
                $('#userForm').trigger("reset");
                $('#titleForModal').html("Add New User");
                $('#addNamemodal').modal('show');
                //alert($("#userForm").length);
            });

            $("#saveName").click(function() {
                //alert($("#userForm").serialize());
                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "{{ route('store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        var user = '<tr id="user_id_' + data.id + '"><td>' + data.name + '</td>';
                        user += '<td><a href="javascript:void(0)" id="editName" data-id="' + data.id + '" class="btn btn-info"><span class="fa fa-pencil"></span></a></td>';
                        user += '<td><a href="javascript:void(0)" id="deleteName" data-id="' + data.id + '" class="btn btn-danger"><span class="fa fa-minus"></span></a></td></tr>';

                        $('#userForm').trigger("reset");
                        $('#addNamemodal').modal('hide');
                        $('#nameList').append(user);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>
</html>