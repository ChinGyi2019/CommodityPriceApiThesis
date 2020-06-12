@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Type</div>
                <br />

                <div class="card-body">
                    <form method="POST" action="{{route('admin.types.update',$type->id)}}">
                        {{method_field("PUT")}}
                         @csrf
                        <label class="col-sm-2 control-label">Name</label>
                        <input type="text" name="name" value="{{$type->name}}" class="form-control"/>
                        <br />
                        <label class="col-sm-2 control-label">Type</label>
                        <input type="number" name="type" value="{{$type->type}}" class="form-control"/>
                        <br /> <br />
{{--                        Detail--}}
{{--                        <input type="text" name="detail" value="{{$town->detail}}" class="form-control"/>--}}
{{--                        <br /> <br />--}}
                        <input type="submit" value="save"/>
                        </form>
                </div>
            </div>

        </div>
    </div>
</div>

</div>

@endsection




