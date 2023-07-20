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
                <h6>Crear reserva</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('reservas.store') }}" method="POST" role="form text-left"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="nombrereserva" class="form-label">Nombre de la Reserva</label>
                            <input type="text" name="nombrereserva" class="form-control" id="nombrereserva" require>
                        </div>
                        <div class="col-md-4">
                            <label for="precioreserva" class="form-label">Precio</label>
                            <input type="number" name="precioreserva" class="form-control" id="precioreserva" require>
                        </div>
                        <div class="col-md-4">
                            <label for="horainireserva" class="form-label">Hora Inicio</label>
                            <input type="time" name="horainireserva" class="form-control" id="horainireserva" require>
                        </div>
                        <div class="col-md-4">
                            <label for="ambiente_id" class="form-label">Ambientes</label>
                            <select name="ambiente_id" class="form-select" id="ambiente_id">
                                @php
                                    $ambientesDisponibles = $ambientes->where('estado', 'disponible');
                                @endphp
                        
                                @if ($ambientesDisponibles->isEmpty())
                                    <option value="" disabled>No hay ambientes disponibles para reservar</option>
                                @else
                                    @foreach ($ambientesDisponibles as $ambiente)
                                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        {{-- <div class="col-md-4">
                            <label for="ambiente_id" class="form-label">Ambientes</label>
                            <select name="ambiente_id" class="form-select" id="ambiente_id">
                                @foreach ($ambientes as $ambiente)
                                    @if ($ambiente->estado == 'disponible')
                                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-md-4">
                            <label for="user_id" class="form-label">Clientes</label>
                            <select name="user_id" class="form-control" id="user_id">
                                @foreach ($users as $user)
                                    @if ($user->rol == 'usuario')
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="horafinreserva" class="form-label">Hora Final</label>
                            <input type="time" name="horafinreserva" class="form-control" id="horafinreserva"
                                require>
                        </div>

                        <div class="col-md-4">
                            <label for="fechareserva" class="form-label">Fecha de la reserva</label>
                            <input type="date" name="fechareserva" class="form-control" id="fechareserva" require>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionreserva" class="form-label">Descripción del reserva</label>
                        <textarea class="form-control" name="descripcionreserva" id="descripcionreserva" rows="3" require></textarea>
                    </div>

                    <button type="submit" class="btn btn-info">Añadir reserva</button>
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
