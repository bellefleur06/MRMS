@include('admin.includes.header')
<style type="text/css">
    td p {
        margin: 2px;
    }
</style>
@include('admin.includes.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-child"></span> Prenatal Records</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Prenatal</li>
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
                                <th>Patient Code</th>
                                <th>Patient Info</th>
                                <th>Nurse Midwife</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prenatals as $prenatal)
                                <tr>
                                    <td>{{ $prenatal->patient_code }}</td>
                                    <td>
                                        <p class="info">Patient Name: <b>{{ $prenatal->patient_name }}</b></p>
                                        <p class="info"><small>Schedule:
                                                <b>{{ $prenatal->prenatal_schedule }}</b></small></p>
                                        <p class="info"><small>Blood Pressure: <b>{{ $prenatal->blood_pressure }}
                                                    mmHg</b></small></p>
                                        <p class="info"><small>Weight: <b>{{ $prenatal->weight }} kg</b></small></p>
                                        <p class="info"><small>Size of tummy: <b>{{ $prenatal->tummy_size }}
                                                    cm</b></small></p>
                                    </td>
                                    <td>{{ $prenatal->nurse_midwife }}</td>
                                    <td>{{ $prenatal->remarks }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-sm btn-success edit" href="#" data-toggle="modal"
                                            data-target="#edit" data-id="{{ $prenatal->id }}"><i
                                                class="fa fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger delete" href="#" data-toggle="modal"
                                            data-target="#delete" data-id="{{ $prenatal->id }}"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                    <br>
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
                <h3>Are you sure want to delete this Prenatal Record?</h3>
                <div class="m-t-20">
                    <form action="{{ url('0/prenatal', 'id') }}" method="POST">
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
                <form action="{{ url('/0/prenatal', 'id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-baby"> Prenatal Information</span>
                                </div>
                                <br>
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Patient Code</label>
                                            <input type="disabled" readonly class="form-control" name="patient_code"
                                                placeholder="PNT-123">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input type="text" class="form-control" name="patient_name"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prenatal Schedule</label>
                                            <input type="date" class="form-control" name="prenatal_schedule">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Midwife/Nurse/Doctor</label>
                                            <input type="text" class="form-control" name="nurse_midwife"
                                                placeholder="Midwife/Nurse/Doctor">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Pressure</label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="blood_pressure">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">mmHg</span>
                                                </div>
                                            </div>
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
                                            <label>Sise of Tummy</label>
                                            <input type="number" class="form-control" name="tummy_size"
                                                placeholder="Sise of Tummy">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" name="remarks" placeholder="Remarks"></textarea>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{ url('/0/prenatal') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-baby"> Prenatal Information</span>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Patient Code</label>
                                            <input type="disabled" readonly class="form-control" name="patient_code"
                                                placeholder="PNT-123" value="{{ $patientCode }}">
                                            @error('patient_code')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input type="text" class="form-control" name="patient_name"
                                                placeholder="Name">
                                            @error('patient_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prenatal Schedule</label>
                                            <input type="date" class="form-control" name="prenatal_schedule">
                                            @error('prenatal_schedule')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nurse Midwife</label>
                                            <input type="text" class="form-control" name="nurse_midwife"
                                                placeholder="Nurse Midwife">
                                            @error('nurse_midwife')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Pressure</label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="blood_pressure">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">mmHg</span>
                                                </div>
                                            </div>
                                            @error('blood_pressure')
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
                                            <label>Tummy Size</label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="num" class="form-control" name="tummy_size">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                            @error('tummy_size')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" name="remarks" placeholder="Remarks"></textarea>
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
                url: '{{ url('/0/prenatal', '') }}/' + id,
                type: 'GET',
                success: function(response) {
                    var prenatal = response.prenatal;
                    // Populate the modal fields with patient data
                    $('#edit input[name="id"]').val(prenatal.id);
                    $('#edit input[name="patient_code"]').val(prenatal.patient_code);
                    $('#edit input[name="patient_name"]').val(prenatal.patient_name);
                    $('#edit input[name="prenatal_schedule"]').val(prenatal
                        .prenatal_schedule);
                    $('#edit input[name="nurse_midwife"]').val(prenatal.nurse_midwife);
                    $('#edit input[name="blood_pressure"]').val(prenatal.blood_pressure);
                    $('#edit input[name="weight"]').val(prenatal.weight);
                    $('#edit input[name="tummy_size"]').val(prenatal.tummy_size);
                    $('#edit textarea[name="remarks"]').val(prenatal.remarks);
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
