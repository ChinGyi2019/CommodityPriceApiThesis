@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="card-header">List of Towns</div>
                    <br />
                    <div class="d-flex justify-content-end"> <a href="{{route('admin.towns.create')}}" class="btn btn-sm btn-primary">Add Town</a></div>

                    <br /><br />
                <table class="table table-light card-body">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th colspan="2">Action</th>
                         <th></th>
                    </tr>

                        @forelse($towns as $town )
                            <tr>
                                <td>{{$town->id}}</td>
                                <td>{{$town->name}}</td>
                                {{--                            <td>{{$product->detail}}</td>--}}
                                <td>  <a href="{{route('admin.towns.edit',$town->id)}}" class="btn btn-sm btn-info">Edit</a> </td>
                                <td> <form method="POST" action="{{route('admin.towns.destroy',$town->id)}}">
                                        @csrf
                                        {{method_field("DELETE")}}
                                        <input type="submit" value="Delete" onclick="return confirm('Are you Sure')"
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




