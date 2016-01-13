@extends('layouts.init')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading login-header">
					Iniciar Sesión
				</div>

				<div class="panel-body">

					<!-- New Task Form -->
					<form action="{{ route('login') }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- E-Mail Address -->
						<div class="form-group">
							<label for="nick" class="col-sm-3 control-label">Nombre de Usuario</label>

							<div class="col-sm-6">
								<input type="text" name="nick" class="form-control" value="{{ old('nick') }}" placeholder="Ingrese El Nombre De Usuario">
							</div>
						</div>

						<!-- Password -->
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Contraseña</label>

							<div class="col-sm-6">
								<input type="password" name="password" class="form-control" placeholder="Ingrese La Contraseña">
							</div>
						</div>

						<!-- Login Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-sign-in"></i>Login
								</button>
							</div>
						</div>
					</form>
					<!-- Display Validation Errors -->
					@include('common.errors')
				</div>
			</div>
		</div>
	</div>
@endsection
