@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="card-header">List of Products</div>
                    <br />
                    <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-primary">Add New</a>
                    <br /><br />
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Details</th>
                         <th></th>
                    </tr>
                    @forelse($products as $product )
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->detail}}</td>
                            <td>  <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-sm btn-info">Edit</a> </td>
                            <td> <form method="POST" action="{{route('admin.products.destroy',$product->id)}}">
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
                </table>
                </div>
            </div>

        </div>
    </div>
</div>

</div>

@endsection




