@extends('layouts.app')

@section('content')

    <div class="container">
        <a href="{{ route('roles.index') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-info mx-1">Permissions</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>
                            Roles
                            @can('create role')
                            <a href="{{ route('roles.create') }}" class="btn btn-primary float-right">Add Role</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route('addpermission',$role->id) }}" class="btn btn-warning">
                                            Add / Edit Role Permission
                                        </a>

                                        @can('update role')
                                        <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success">
                                            Edit
                                        </a>
                                        @endcan

                                        @can('delete role')
                                        {{-- <a href="{{ url('roles.delete') }}" class="btn btn-danger mx-2">
                                            Delete
                                        </a> --}}
                                        <button class="btn btn-danger" onclick="document.getElementById('{{$role->id}}').submit()">Delete</button>
                                        <form action="{{route('roles.destroy',$role->id)}}" id="{{$role->id}}" method="POST" style="display:none">
                                           @csrf
                                           @method("DELETE")
                                         </form>

                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
