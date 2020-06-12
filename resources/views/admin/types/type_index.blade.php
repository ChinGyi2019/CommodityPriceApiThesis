@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="card-header">List of Types</div>
                    <br />
                    <div class="d-flex justify-content-end"> <a href="{{route('admin.types.create')}}" class="btn btn-sm btn-primary">Add Type</a></div>

                    <br /><br />
                <table class="table table-light card-body">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th colspan="2">Action</th>
                         <th></th>
                    </tr>

                        @forelse($types as $type )
                            <tr>
                                <td>{{$type->id}}</td>
                                <td>{{$type->name}}</td>
                                <td>{{$type->type}}</td>
                                <td>  <a href="{{route('admin.types.edit',$type->id)}}" class="btn btn-sm btn-info">Edit</a> </td>
                                <td> <form method="POST" action="{{route('admin.types.destroy',$type->id)}}">
                                        @csrf
                                        {{method_field("DELETE")}}
                                        <input type="submit" value="Delete" onclick="return confirm('Are you Sure ??')"
                                               class="btn btn-sm btn-danger"/>
                                    </form></td>

                            </tr>

                        @empty
                    <tr>
                        <td colspan="2"> No record found</td>
                    </tr>
                        @endforelse
                    </thead>
                </table>
                </div>
            </div>

        </div>
    </div>
</div>

</div>

@endsection




