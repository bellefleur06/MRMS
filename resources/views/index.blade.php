@include('includes.__header')

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('asset/img/logo.png') }}" alt="DSMS Logo" width="200">
                </a>
            </div>
            <div class="card-body">
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
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    {{-- @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div> --}}
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 offset-3">
                            <button type="submit" class="btn btn-block btn-bg"
                                style="background-color: rgba(131,219,214);">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</body>

@include('includes.__footer')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alert = document.getElementById('alert');
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000);
    });
</script>
