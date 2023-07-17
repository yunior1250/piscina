@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Money</p>
                                    <h5 class="font-weight-bolder">
                                        $53,000
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+55%</span>
                                        since yesterday
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                                    <h5 class="font-weight-bolder">
                                        2,300
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+3%</span>
                                        since last week
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                    <h5 class="font-weight-bolder">
                                        +3,462
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                        since last quarter
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                    <h5 class="font-weight-bolder">
                                        $103,430
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card mb-4" style="margin-top: 50px;">
            <div class="card-header pb-0">
                <h6>Crear ambiente</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('ambientes.update',$ambiente->id) }}" method="POST" role="form text-left"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nombreambiente" class="form-label">Nombre del ambiente</label>
                            <input type="text" name="nombreambiente" class="form-control" id="nombreambiente" value="{{ $ambiente->nombre }}" require>
                        </div>
                        <div class="col-md-4">
                            <label for="capacidadambiente" class="form-label">Capacidad</label>
                            <input type="number" name="capacidadambiente" class="form-control" id="capacidadambiente" value="{{ $ambiente->capacidad }}" require>
                        </div>

                        <div class="col-md-4">
                            <label for="sucursal_id" class="form-label">Sucursal</label>
                            <select name="sucursal_id" class="form-control" id="sucursal_id">
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <div class="mb-3">
                        <label for="descripcionambiente" class="form-label">Descripción del ambiente</label>
                        <textarea class="form-control" name="descripcionambiente" id="descripcionambiente" rows="3" require></textarea>
                    </div>

                   {{--  <div class="mb-4">
                        <label for="archivoambiente" class="form-label">Subir Archivos</label>
                        <input type="file" class="form-control" name="archivoambiente" id="archivoambiente">
                    </div> --}}

                    <button type="submit" class="btn btn-info">Actulizar  ambiente</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('./assets/js/plugins/chartjs.min.js') }}"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
