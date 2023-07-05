@include('admin.includes.header')
@include('admin.includes.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-syringe"></span> Immunized Records</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Immunization</li>
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
                                <th>Child Name</th>
                                <th>Age</th>
                                <th>Immunization Type</th>
                                <th>Date of Immunization</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($immunizations as $immunization)
                                <tr>
                                    <td>{{ $immunization->name }}</td>
                                    <td>{{ $immunization->age }}</td>
                                    <td>{{ $immunization->immunization_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($immunization->immunization_date)->format('F j, Y') }}
                                    </td>
                                    <td>{{ $immunization->remarks }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-sm btn-success edit" href="#" data-toggle="modal"
                                            data-target="#edit" data-id="{{ $immunization->id }}"><i
                                                class="fa fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger delete" href="#" data-toggle="modal"
                                            data-target="#delete" data-id="{{ $immunization->id }}"><i
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
                <h3>Are you sure want to delete this Immunized Record?</h3>
                <div class="m-t-20">
                    <form action="{{ url('0/immunization', 'id') }}" method="POST">
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
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{ url('/0/immunization', 'id') }}" method="POST">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Child Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Child Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="number" class="form-control" name="age" placeholder="Age">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Immunization Type</label>
                                            <select class="form-control" name="immunization_type">
                                                <option value="Hepa A">Hepa A</option>
                                                <option value="Hepa B">Hepa B</option>
                                                <option value="Influenza">Influenza</option>
                                                <option value="Measles">Measles</option>
                                                <option value="Inactivated Poliovirus">Inactivated Poliovirus</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date Of Immunization</label>
                                            <input type="date" class="form-control" name="immunization_date">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control" name="remarks" placeholder="Remarks">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="add" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{ url('/0/immunization') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-baby"> Child Information</span>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Child Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Child Name">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="number" class="form-control" name="age"
                                                placeholder="Age">
                                            @error('age')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Immunization Type</label>
                                            <select class="form-control" name="immunization_type">
                                                <option value="Hepa A">Hepa A</option>
                                                <option value="Hepa B">Hepa B</option>
                                                <option value="Influenza">Influenza</option>
                                                <option value="Measles">Measles</option>
                                                <option value="Inactivated Poliovirus">Inactivated Poliovirus</option>
                                            </select>
                                            @error('immunization_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date Of Immunization</label>
                                            <input type="date" class="form-control" name="immunization_date">
                                            @error('immunization_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control" name="remarks"
                                                placeholder="Remarks">
                                            @error('remarks')
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
                url: '{{ url('/0/immunization', '') }}/' + id,
                type: 'GET',
                success: function(response) {
                    var immunization = response.immunization;
                    // Populate the modal fields with immunization data
                    $('#edit input[name="id"]').val(immunization.id);
                    $('#edit input[name="name"]').val(immunization.name);
                    $('#edit input[name="age"]').val(immunization.age);
                    $('#edit select[name="immunization_type"]').val(immunization.immunization_type);
                    $('#edit input[name="immunization_date"]').val(immunization.immunization_date);
                    $('#edit input[name="remarks"]').val(immunization.remarks);
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
