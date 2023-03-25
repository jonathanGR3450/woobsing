@extends('layout')

@section('title', "porjects | " . $user->name . ' ' . $user->last_name)

@section('content')
<div class="container">
    <div class="bg-white p-5 shadow rounded">
        <h1>{{  $user->name . ' ' . $user->last_name }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Apellido</th>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>
                                @forelse ($user->roles as $role)
                                    <li>{{ $role->display_name }}</li>
                                @empty
                                    No hay informacion
                                @endforelse
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-12">
                <a class="btn btn-info btn-lg btn-block" href="{{ route('user.index') }}">Regresar</a>
                @can('edit', $user)
                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('user.edit', $user) }}">Edit</a>
                @endcan
                @can('destroy', $user)
                    <a class="btn btn-danger btn-lg btn-block" href="#" onclick="document.getElementById('delete-user').submit()">Delete</a>
                    <form class="d-none" id="delete-user" action="{{ route("user.destroy", $user) }}" method="post">
                        @csrf @method("DELETE")
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection