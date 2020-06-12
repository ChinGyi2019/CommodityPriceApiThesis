@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new Types</div>
                <br />

                <div class="card-body">
                    <form method="POST" action="{{route('admin.types.store')}}">
                         @csrf
                        <label class="col-sm-2 control-label">Name</label>
                        <input type="text" name="name" class="form-control"/>
                        <br />
                        <label class="col-sm-2 control-label">Type</label>
                        <input type="number" name="type" class="form-control"/>
                        <br /> <br />
{{--                        Detail--}}
{{--                        <input type="text" name="detail" class="form-control"/>--}}
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




