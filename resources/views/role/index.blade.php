@extends('adminlte::page')
@section('title', 'Roles')
@section('content')

            <div class="card">
                <div class="card-header"><h2>Lista de Roles</h2></div>

                <div class="card-body">
                    @can('haveaccess', 'role.create')
                        <a href="{{ route('role.create') }}"
                            class="btn btn-primary float-right"
                        > Agregar nuevo Rol
                        </a>
                    @endcan
                    <br><br>

                    @include('custom.message')

                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Full-acesso</th>
                            <th colspan="3" style="text-align: center">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $role )
                            <tr>
                                <th scope="row">{{$role->id}}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role['full-access'] }}</td>

                                <td>
                                    @can('haveaccess', 'role.show')
                                        <a class="btn btn-info" href="{{ route ('role.show', $role->id) }}">Ver</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('haveaccess', 'role.edit')
                                        <a class="btn btn-success" href="{{ route ('role.edit', $role->id) }}">Editar</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('haveaccess', 'role.destroy')

                                        <form action="{{ route ('role.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                             @endforeach
                        </tbody>
                      </table>
                        {{ $roles->links() }}
                </div>
            </div>
@endsection
