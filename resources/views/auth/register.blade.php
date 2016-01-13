@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Register
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Task Form -->
					<form action="/auth/register" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- Nombre -->
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombre</label>

							<div class="col-sm-6">
								<input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
							</div>
						</div>

            <!-- Identificacion -->
						<div class="form-group">
							<label for="identificacion" class="col-sm-3 control-label">Identificación</label>

							<div class="col-sm-6">
								<input type="text" name="identificacion" class="form-control" value="{{ old('identificacion') }}">
							</div>
						</div>

            <!-- Direccion -->
						<div class="form-group">
							<label for="direccion" class="col-sm-3 control-label">Dirección</label>

							<div class="col-sm-6">
								<input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
							</div>
						</div>

            <!-- Ciudad -->
            <div class="form-group">
							<label>Selects</label>
							<select class="form-control" name="ciudad">
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
						  </select>
						</div>

            <!-- Teléfono -->
						<div class="form-group">
							<label for="telefono" class="col-sm-3 control-label">Teléfono</label>

							<div class="col-sm-6">
								<input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
							</div>
						</div>

						<!-- E-Mail Address -->
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">E-Mail</label>

							<div class="col-sm-6">
								<input type="email" name="email" class="form-control" value="{{ old('email') }}">
							</div>
						</div>

            <!-- Observaciones -->
						<div class="form-group">
							<label for="observaciones" class="col-sm-3 control-label">Observaciones</label>

							<div class="col-sm-6">
								<input type="text" name="observaciones" class="form-control" value="{{ old('observaciones') }}">
							</div>
						</div>

						<!-- Password -->
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Password</label>

							<div class="col-sm-6">
								<input type="password" name="password" class="form-control">
							</div>
						</div>

						<!-- Confirm Password -->
						<div class="form-group">
							<label for="password_confirmation" class="col-sm-3 control-label">Confirm Password</label>

							<div class="col-sm-6">
								<input type="password" name="password_confirmation" class="form-control">
							</div>
						</div>

						<!-- Register Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-sign-in"></i>Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
