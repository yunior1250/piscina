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
                <h6>Crear Piscina</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('piscinas.store') }}" method="POST" role="form text-left"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nombrepisicna" class="form-label">Nombre de la Piscina</label>
                            <input type="text" name="nombrepisicna" class="form-control" id="nombrepisicna" require>
                        </div>
                        <div class="col-md-4">
                            <label for="tipopiscina" class="form-label">tipo</label>
                       {{--      <input type="number" name="telefonosucursal" class="form-control" id="telefonosucursal" require> --}}
                            <select name="tipopiscina" id="tipo" class="form-control" required>
                                <option value="rectangular">Rectangular</option>
                                <option value="circular">Circular</option>
                                <!-- Agrega otras opciones de tipo de piscina aquí si es necesario -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="largopiscina" class="form-label">largo</label>
                            <input type="text" name="largopiscina" class="form-control" id="largopiscina" require>
                        </div>
                        <div class="col-md-4">
                            <label for="anchopiscina" class="form-label">Ancho</label>
                            <input type="text" name="anchopiscina" class="form-control" id="anchopiscina" require>
                        </div>
                        <div class="col-md-4">
                            <label for="profundidadpiscina" class="form-label">Profundidad</label>
                            <input type="text" name="profundidadpiscina" class="form-control" id="profundidadpiscina" require>
                        </div>
                        <div class="col-md-4">
                            <label for="radiopiscina" class="form-label">Radio</label>
                            <input type="text" name="radiopiscina" class="form-control" id="radiopiscina" require>
                        </div>
                        <div class="col-md-4">
                            <label for="sucursal_id" class="form-label">Sucursales</label>
                            <select name="sucursal_id" class="form-control" id="sucursal_id">
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcionpisicna" class="form-label">Descripción dela Sucursal</label>
                        <textarea class="form-control" name="descripcionpisicna" id="descripcionpisicna" rows="3" require></textarea>
                    </div>
  
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="fotopiscina">Foto de Piscina</label>
                            <input type="file" class="form-control" id="fotopiscina" name="fotopiscina">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info">Añadir piscina</button>
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
