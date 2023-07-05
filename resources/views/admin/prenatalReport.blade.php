@include('admin.includes.header')
@include('admin.includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-chart-pie"></span> Reports</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-title">
                                <h4>Prenatal per Month </h4>
                            </div>
                            <table class="table table-bordered mytable">
                                <tbody>
                                    @foreach ($prenatal_records as $prenatal_record)
                                    <tr>
                                        <td>{{ $prenatal_record->month }}</td>
                                        <td>{{ $prenatal_record->count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-title">
                                <h4>Graphical Representaion Prenatal per Month</h4><br>
                            </div>
                            <canvas id="bargraph"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Bar Chart

        // Get the prenatal records data from the Laravel variable
        var prenatalRecords = @json($prenatal_records);

        var barChartData = {
            labels: prenatalRecords.map(record => record.month),
            datasets: [{
                label: 'Prenatal',
                backgroundColor: 'rgb(79,129,189)',
                borderColor: 'rgba(0, 158, 251, 1)',
                borderWidth: 1,
                data: prenatalRecords.map(record => record.count)
            }]
        };

        var ctx = document.getElementById('bargraph').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    display: false,
                }
            }
        });

    });
</script>

@include('admin.includes.footer')
