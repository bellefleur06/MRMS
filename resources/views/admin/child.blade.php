@include('admin.includes.header')
@include('admin.includes.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-baby"></span> Child Records</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Child</li>
                    </ol>
                </div>
                <a class="btn btn-sm elevation-2" href="#" data-toggle="modal" data-target="#add"
                    style="margin-top: 20px;margin-left: 10px;background-color: rgba(131,219,214);"><i
                        class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div id="alert" class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div id="alert" class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info elevation-2">
                <br>
                <div class="col-md-12 table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Mother Name</th>
                                <th>Child Name</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($childs as $child)
                                <tr>
                                    <td>{{ $child->mothers_name }}</td>
                                    <td>{{ $child->first_name }} {{ $child->middle_name }} {{ $child->last_name }}</td>
                                    <td>{{ $child->gender === 'M' ? 'Male' : 'Female' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($child->birthdate)->format('F j, Y') }}</td>
                                    <td>{{ $child->weight }} kg</td>
                                    <td>{{ $child->height }} cm</td>
                                    <td class="text-right">
                                        <a class="btn btn-sm btn-success edit" href="#" data-toggle="modal"
                                            data-target="#edit" data-id="{{ $child->id }}"><i
                                                class="fa fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger delete" href="#" data-toggle="modal"
                                            data-target="#delete" data-id="{{ $child->id }}"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{ asset('asset/img/sent.png') }}" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Child Record?</h3>
                <div class="m-t-20">
                    <form action="{{ url('0/child', 'id') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" class="form-control" name="id" id="id">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{ url('/0/child', 'id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-baby"> Child Information</span>
                                </div>
                                <br>
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mothers Name</label>
                                            <input type="text" class="form-control" name="mothers_name" placeholder="Mothers Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Child Last Name</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Child First Name</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Child Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <input type="date" class="form-control" name="birthdate">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Weight</label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="weight">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Height</label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="height">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="add" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{ url('/0/child') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-baby"> Child Information</span>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mothers Name</label>
                                            <input type="text" class="form-control" name="mothers_name"
                                                placeholder="Mothers Name">
                                            @error('mothers_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Child Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Last Name">
                                            @error('last_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Child First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                placeholder="First Name">
                                            @error('first_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Child Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name"
                                                placeholder="Middle Name">
                                            @error('middle_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <input type="date" class="form-control" name="birthdate">
                                            @error('birthdate')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Weight</label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="weight">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                            @error('weight')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Height</label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="height">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                            @error('height')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.footer')
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            $('#id').val(id);
        });
    });

    $(document).ready(function() {
        $('.edit').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ url('/0/child', '') }}/' + id,
                type: 'GET',
                success: function(response) {
                    var child = response.child;
                    // Populate the modal fields with patient data
                    $('#edit input[name="id"]').val(child.id);
                    $('#edit input[name="mothers_name"]').val(child.mothers_name);
                    $('#edit input[name="last_name"]').val(child.last_name);
                    $('#edit input[name="first_name"]').val(child.first_name);
                    $('#edit input[name="middle_name"]').val(child.middle_name);
                    $('#edit select[name="gender"]').val(child.gender);
                    $('#edit input[name="birthdate"]').val(child.birthdate);
                    $('#edit input[name="weight"]').val(child.weight);
                    $('#edit input[name="height"]').val(child.height);
                },
                error: function(xhr) {
                    // Handle error if the AJAX request fails
                    console.log(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        var alert = $('#alert');
        setTimeout(function() {
            alert.hide();
        }, 3000);
    });
</script>
