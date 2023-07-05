@include('admin.includes.header')
@include('admin.includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-hospital-user"></span> Patients List</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>
                <!-- /.col -->
                <a class="btn btn-sm elevation-2" href="#" data-toggle="modal" data-target="#add"
                    style="margin-top: 20px;margin-left: 10px;background-color: rgba(131,219,214);"><i
                        class="fa fa-plus"></i> Add New</a>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
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
            <div class="card card-info elevation-2 table-responsive">
                <br>
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Patient Code</th>
                                <th>Full Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Birthdate</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->patient_code }}</td>
                                    <td>{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}
                                    </td>
                                    <td>{{ $patient->contact }}</td>
                                    <td>{{ $patient->email }}</td>
                                    <td>{{ $patient->address }}</td>
                                    <td>{{ \Carbon\Carbon::parse($patient->birthdate)->format('F j, Y') }}</td>
                                    <td>{{ $patient->age }}</td>
                                    <td>
                                        @if ($patient->status == 0)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-sm btn-success edit" href="#" data-toggle="modal"
                                            data-target="#edit" data-id="{{ $patient->id }}">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger delete" href="#" data-toggle="modal"
                                            data-target="#delete" data-id="{{ $patient->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{ asset('asset/img/sent.png') }}" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Patient?</h3>
                <div class="m-t-20">
                    <form action="{{ url('0/patient', 'id') }}" method="POST">
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
                <form action="{{ url('/0/patient', 'id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-hospital-user"> Patient Information</span>
                                </div>
                                <br>
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Code</label>
                                            <input type="disabled" readonly class="form-control" name="patient_code"
                                                placeholder="PNT-123">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name"
                                                placeholder="Middle Name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input type="text" class="form-control" name="contact"
                                                placeholder="Contact">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <input type="date" class="form-control" name="birthdate">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="number" class="form-control" name="age">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="0">Active</option>
                                                <option value="1">Inactive</option>
                                            </select>
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
                <form action="{{ url('/0/patient') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-hospital-user"> Patient Information</span>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Patient Code</label>
                                            <input type="disabled" readonly class="form-control" name="patient_code"
                                                placeholder="PNT-123" value="{{ $patientCode }}">
                                            @error('patient_code')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                placeholder="First Name">
                                            @error('first_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name"
                                                placeholder="Middle Name">
                                            @error('middle_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Last Name">
                                            @error('last_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input type="text" class="form-control" name="contact"
                                                placeholder="Contact">
                                            @error('contact')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" placeholder="Address"></textarea>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <input type="date" class="form-control" name="birthdate">
                                            @error('birthdate')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="number" class="form-control" name="age">
                                            @error('age')
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
                url: '{{ url('/0/patient', '') }}/' + id,
                type: 'GET',
                success: function(response) {
                    var patient = response.patient;
                    // Populate the modal fields with patient data
                    $('#edit input[name="id"]').val(patient.id);
                    $('#edit input[name="patient_code"]').val(patient.patient_code);
                    $('#edit input[name="first_name"]').val(patient.first_name);
                    $('#edit input[name="middle_name"]').val(patient.middle_name);
                    $('#edit input[name="last_name"]').val(patient.last_name);
                    $('#edit input[name="contact"]').val(patient.contact);
                    $('#edit input[name="email"]').val(patient.email);
                    $('#edit textarea[name="address"]').val(patient.address);
                    $('#edit input[name="birthdate"]').val(patient.birthdate);
                    $('#edit input[name="age"]').val(patient.age);
                    $('#edit select[name="status"]').val(patient.status);
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
