@extends('layouts.app')

@section('content')
@include('layouts.navbars.guest.navbar')
<main class="main-content  mt-0 pb-10 bg-info">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url({{ asset('img/office.jpg') }}) background-position: center">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Bienvenido!</h1>
                    <p class="text-lead text-white"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-6 col-lg-9 col-md-8 mx-auto">
                <div class="card z-index-0" style="border: solid black 2px">
                    <div class="card-header text-center pt-4">
                        <h5>Formulario de Registro</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register.perform') }}">
                            @csrf
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label> Nombre </label>
                                    <input type="text   " name="username" class="form-control" placeholder="Nombre" aria-label="Name" value="{{ old('username') }}">
                                    @error('username')
                                    <p class='text-info text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label> Contraseña </label>
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña" aria-label="Password">
                                    @error('password')
                                    <p class='text-info text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label> Email </label>
                                    <input type="email" name="email" class="form-control" placeholder="yunior@gmail.com" aria-label="Password" required>
                                    @error('password')
                                    <p class='text-info text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6">
                                    <label> Nro de Tarjeta </label>
                                    <input type="number" name="numero_c" class="form-control" placeholder="8732 **** **** ****" aria-label="Password">
                                    @error('password')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div> --}}
                            </div>

                           {{--  <div class="row mb-2">

                                <div class="col-md-6">
                                    <label> Fecha de Expiración </label>
                                    <input type="date" name="fecha_v" class="form-control" placeholder="Password" aria-label="Password">
                                    @error('password')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label> CVV </label>
                                    <input type="number" name="cvv" class="form-control" placeholder="CVV" aria-label="Password">
                                    @error('password')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror

                                </div>

                            </div> --}}
                            <!-- subcripcion -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Rol:</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"type="radio" name="rol" id="usuario" value="usuario">
                                        <label class="form-check-label" for="usuario">Usuario</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rol" id="organizador" value="organizador">
                                        <label class="form-check-label" for="organizador">personal</label>
                                    </div>
                                </div>
                            </div>
                            <!-- endsupcripcion -->

                            <div class="text-center">
                                <button type="submit" class="btn bg-info w-100 my-4 mb-2" style="color: #ffffff;">Registrarse</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">¿Tienes una cuenta? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Inicia sesión</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register cliente</h5>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register.perform') }}">
                                @csrf
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Name" value="{{ old('username') }}">
                                    @error('username')
        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
    @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" value="{{ old('email') }}">
                                    @error('email')
        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
    @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                                    @error('password')
        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</main>
@include('layouts.footers.guest.footer')
@endsection