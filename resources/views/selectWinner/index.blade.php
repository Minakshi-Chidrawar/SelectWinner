@extends('layout')

@section('title', 'Add New Customer')
    
@section('content')
    <div class="container py-4">
        <div class="row mb-3">
            <div class="col-12">
                <button type="submit" class="btn btn-success mb-2" id="addName">Add User</button>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table table-borderless table-hover" id="nameList">
                    <tbody id="users-crud">
                        @foreach($names as $name)
                        <tr id="user_id_{{ $name->id }}">
                            <td>{{ $name->name }}</td>
                            <td>
                                <a href="javascript:void(0)" id="editName" data-id="{{ $name->id }}" data-name="{{$name->name}}" class="btn btn-info">
                                    <span class="fa fa-pencil"></span>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" id="deleteName" data-id="{{ $name->id }}" data-name="{{$name->name}}" class="btn btn-danger delete-user">
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

    @include('selectWinner.createModal')
@endsection