@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new Town</div>
                <br />

                <div class="card-body">
                    <form method="POST" action="{{route('admin.towns.store')}}">
                         @csrf
                        <label class="col-sm-2 control-label">Name</label>
                        <br />
                        <input type="text" name="name" class="form-control"/>
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




