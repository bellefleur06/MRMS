@include('admin.includes.header')
<style type="text/css">
    .text-decoration-none {
        color: inherit;
        text-decoration: none;
    }
</style>
@include('admin.includes.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-tachometer-alt"></span> Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
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
            <div class="row">
                <div class="col-xl-12 col-md-12 mb-12">
                    <a href="{{ url('/0/patient') }}" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body elevation-2">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="fa fa-hospital-user text-info fa-3x me-4"></i>
                                        </div>
                                        <div>
                                            <h4>Patients</h4>
                                            <p class="mb-4">Number of Patient</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-4">{{ $patient_count }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-12 col-md-12 mb-12">
                    <a href="{{ url('/0/child') }}" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body elevation-2">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="fa fa-baby text-info fa-3x me-4"></i>
                                        </div>
                                        <div>
                                            <h4>Childs</h4>
                                            <p class="mb-4">Number of Child</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-4">{{ $child_count }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-12 col-md-12 mb-12">
                    <a href="{{ url('/0/immunization') }}" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body elevation-2">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="fa fa-syringe text-info fa-3x me-4"></i>
                                        </div>
                                        <div>
                                            <h4>Immunized</h4>
                                            <p class="mb-4">Number of Immunized Child</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-4">{{ $immunization_count }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.includes.footer')
<script>
    $(document).ready(function() {
        var alert = $('#alert');
        setTimeout(function() {
            alert.hide();
        }, 3000);
    });
</script>
