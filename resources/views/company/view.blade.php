@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Perusahaan</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Ada yang salah dengan input yang anda masukkan.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<input type="hidden" name="id" value="{{ $company->id }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Nama:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $company->name }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Alamat:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $company->address }}</p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a class="btn btn-primary" href="{{ url('/company') }}" role="button">Kembali</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
