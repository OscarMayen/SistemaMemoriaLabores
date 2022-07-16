@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Detail Rol</h2></div>

                <div class="card-body">
                    @include('custom.message')

                    <form action="{{route('role.update', $role->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="container">

                            <h3>Datos requeridos</h3>

                            <div class="form-group">
                                <input type="text" class="form-control" id="name"
                                    name="name" placeholder="Name"
                                    value="{{ $role->name}}" readonly>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control"
                                    id="slug"
                                   name="slug" placeholder="Slug"
                                   value="{{$role->slug }}" readonly>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3" readonly>{{ $role->description }}</textarea>
                            </div>

                            <hr>
                            <h3>Full Access</h3>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullaccessyes" name="full-access" disabled
                                    class="custom-control-input" value="si"
                                        @if ($role['full-access'] =="si")
                                        checked
                                        @elseif (old('full-access')=="si")
                                            checked
                                        @endif
                                    >
                                <label class="custom-control-label" for="fullaccessyes">Si</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullaccessno" name="full-access" disabled
                                    class="custom-control-input" value="no"
                                        @if ($role['full-access'] =="no")
                                        checked
                                        @elseif (old('full-access')=="no")
                                        checked
                                        @endif
                                    >
                                <label class="custom-control-label" for="fullaccessno">No</label>
                            </div>
                            <hr>

                            <h3>Permission List</h3>
                            @foreach ( $permissions as $permission)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" disabled
                                        class="custom-control-input"
                                        id="permission_{{$permission->id}}"
                                        value="{{$permission->id}}"
                                        name="permission[]"
                                        @if ( is_array(old('permission')) && in_array("$permission->id", old('permission')  ) )
                                            checked

                                        @elseif ( is_array($permission_role) && in_array("$permission->id", $permission_role  ) )
                                        checked
                                        @endif
                                    >
                                    <label class="custom-control-label"
                                        for="permission_{{$permission->id}}">
                                        {{$permission->id}}
                                        -
                                        {{$permission->name}}
                                        <em>( {{ $permission -> description }} )</em>
                                    </label>
                                </div>
                            @endforeach
                            <hr>
                            <a class="btn btn-success" href="{{route('role.edit', $role->id)}}">Edit</a>
                            <a class="btn btn-danger" href="{{route('role.index')}}">Atras</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
