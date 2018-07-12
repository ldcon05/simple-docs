@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="text-center">Shared Admin</h1>
    <div class=" row  mt-5 justify-content-center">
        <input type="hidden" id="documentId" value="{{$documentId}}">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Users</label>
                </div>
                <select class="custom-select" id="user">
                        <option selected>Choose...</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-1">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="edit">
                <label class="custom-control-label" for="edit">Edit</label>
            </div>
        </div>
        <div class="col-sm-1">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="view">
                <label class="custom-control-label" for="view">View</label>
            </div>
        </div>
        <div class="col-sm-4 text-align-center">
            <button type="button" id="btnShared" class="btn btn-outline-primary">Shared</button>
        </div>
    </div>
    <table class="table" id="sharedTable">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="d-none">#</th>
                <th scope="col">User</th>
                <th scope="col">Edit</th>
                <th scope="col">View</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shared as $docShared)
                <tr>
                    <th class="id-{{ $docShared-> id }} d-none" scope="row">{{ $docShared-> id }}</th>
                    <td>
                        {{ $docShared-> user -> email }}
                    </td>
                    <td>
                        {{ $docShared-> edit }}
                    </td>
                    <td>
                        {{ $docShared-> view }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger btnRemove">Remove</button>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    function getElement(params, email) {
        return `
                <th class="id-${params.id} d-none" scope="row">${params.id}</th>
                <td>
                        ${email}
                </td>
                <td>
                        ${params.edit}
                </td>
                <td>
                        ${params.view}
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger btnRemove">Remove</button>
                </td>
        `;
    }

    function appendNewRecord(params, email) {
        $('#sharedTable tbody').append(
            `
                <tr>
                    ${getElement(params, email)}
                </tr>
            `
        );
    }

    function updateRecord (params, email) {
        $( '.id-'+params.id )
            .parent()
            .empty()
            .append(
                getElement(params, email)
            );
    }



    $('#sharedTable tbody').on('click', '.btnRemove', function() {
        var id = $(this).parent('td').siblings('th');
        $.ajax({
            type: "DELETE",
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/shared/"+id.html(),
            success : function (data) {
                
            },
            error: function (data) {
            }
        });
        id.parent('tr').remove();
    });

    $( "#btnShared" ).click(function() {
        $.ajax({
            type: "POST",
            dataType:'json',
            data: { 
                    documentId: $('#documentId').val() ,
                    userId: $('#user').val() ,
                    view: $('#view').is(":checked") ,
                    edit: $('#edit').is(":checked"),
                },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/shared",
            success : function (data) {
                if(data.status)
                    appendNewRecord(data.shared, data.email)
                else
                    updateRecord(data.shared, data.email)
            },
            error: function (data) {
                console.log(data)
            }
        });
    });
</script>
@endsection