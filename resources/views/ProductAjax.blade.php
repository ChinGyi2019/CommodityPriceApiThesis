<!DOCTYPE html>
<html>
<head>
    <title>Commodity Price API</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

{{--        //datePicker--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('admin.ajaxproducts.index')}}" >
                            Products
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('admin.towns.index')}}" >
                           Towns
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('admin.types.index')}}" >
                            Type
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <br />
    <div class="d-flex justify-content-center"> <h2 class="text-primary">Commodity Price API</h2></div>
    <div class="d-flex justify-content-end">  <a class=" btn btn-success"   href="javascript:void(0)" id="createNewProduct"> Create New Product</a></div>
    <br />
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th width="5px">No</th>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Weight_unit</th>
            <th>Town</th>
            <th>Date</th>
            <th width="110px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                            <table class="table table-borderless table-light">
                                <thead>
                                <div class="col-sm-12">
                                <tr>
                                    <td>Price</td>
                                    <td>Weight Unit</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="" maxlength="50" required=""> </td>
                                    <td><input type="text" class="form-control" id="weight_unit" name="weight_unit" placeholder="Enter Weight_unit" value="" maxlength="50" required=""></td>
                                </tr>
                                </div>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-12">
                            <input class="date form-control"  placeholder="Select Date" type="text" id="date" value="" name="date">
                        </div>
                    </div>
                    <div class="form-group">

                        <table class="table table-borderless table-light">
                            <thead>
                            <div class="col-sm-12">
                                <tr>
                                    <td><label for="name" class="col-sm-2 control-label">Town</label></td>
                                    <td>  <label for="name" class="col-sm-2 control-label">Type</label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-sm-12">
                                            <select class="form-control" id ="town" name="town">
                                                {{--                                && count($products) > 0--}}
                                                @if(!empty($towns))
                                                    @forelse($towns as $town)
                                                        <option id ="town" name="town" required="" value="{!! $town->id !!}"> {{$town->name}}</option>
                                                        @endforeach
                                                        @endif
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-sm-12">
                                            <select class="form-control" id ="type" name="type">
                                                {{--                                && count($products) > 0--}}
                                                @if(!empty($types))
                                                    @forelse($types as $type)
                                                        <option id ="type" name="type" required="" value="{!! $type->type !!}"> {{$type->name}}</option>
                                                        @endforeach
                                                        @endif
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </div>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>


{{--                        <label for="name" class="col-sm-2 control-label">Town</label>--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <select class="form-control" id ="town" name="town">--}}
{{--                                && count($products) > 0--}}
{{--                                @if(!empty($towns))--}}
{{--                                @forelse($towns as $town)--}}
{{--                                <option id ="town" name="town" required="" value="{!! $town->id !!}"> {{$town->name}}</option>--}}
{{--                                @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#date').datepicker({
            autoclose: true,
            format: 'd/m/yyyy'
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ajaxproducts.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'price', name: 'price'},
                {data: 'weight_unit', name: 'weight_unit'},
                {data: 'town', name: 'town'},
                {data: 'date', name: 'date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#product_id').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxModel').modal('show');

        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('ajaxproducts.index') }}" +'/' + product_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Product");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $('#price').val(data.price);
                $('#weight_unit').val(data.weight_unit);
                $('#date').val(data.date);
                $('#town').val(data.town);
                $('#type').val(data.type);


            })
        });



        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('ajaxproducts.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#productForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },

                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });
        $('body').on('click', '.deleteProduct', function () {
            var product_id = $(this).data("id");
            confirm("Are You sure want to delete !");
            $.ajax({

                type: "DELETE",
                url: "{{ route('ajaxproducts.store') }}"+'/'+product_id,
                success: function (data) {
                    table.draw();

                },

                error: function (data) {
                    console.log('Error:', data);

                }
            });
        });
    });

</script>
</html>
</html>

