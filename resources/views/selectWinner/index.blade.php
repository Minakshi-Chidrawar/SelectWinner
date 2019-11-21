@extends('layout')

@section('title', 'Add New Customer')
    
@section('content')
    <div class="container py-4">
        <div class="row mb-3">
            <div class="col-12">
                <button type="submit" class="btn btn-success mb-2 addName" id="add">Add User</button>               

                @if(count($names ?? '') > 2)
                    <button type="submit" class="btn btn-success mb-2 selectWinner" id="selectWinner">Select Winner</button>
                @endif

                @if(count($winnerNames ?? '') > 0)
                    <button type="submit" class="btn btn-success mb-2" id="clearWinners">
                        <a href="clear" class="link">Reset Winners List</a>
                    </button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                @if(count($names) > 0)
                    <h2 class="user-list">List of users</h2>
                    <table class="table table-borderless table-hover" id="nameList">
                        <tbody id="users-crud">
                            @foreach($names ?? '' as $name)
                            <tr id="user_id_{{ $name->id }}">
                                <td>{{ $name->name }}</td>
                                <td>
                                    <a href="javascript:void(0)" id="editName" data-id="{{ $name->id }}" data-name="{{$name->name}}" class="btn btn-info btn-sm">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    
                                    <a href="javascript:void(0)" id="deleteName" data-id="{{ $name->id }}" data-name="{{$name->name}}" class="btn btn-danger btn-sm delete-user">
                                        <span class="fa fa-minus"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="col-6 offset-1 mt-5">
                @if(count($winnerNames) > 0)
                    <div class="winnerList shadow p-3 mb-5 bg-white rounded">
                        <h2 class="winner-heading">Winners are:</h2>
                        <table class="table table-borderless table-hover">
                            @foreach($winnerNames as $winnerName)
                                <tr><td><strong>{{ $winnerName->name }}</strong></td></tr>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div> 
        </div>
    </div>

    @include('selectWinner.createModal')
    @include('selectWinner.deleteModal')
    @include('selectWinner.numberToSelectWinner')
@endsection