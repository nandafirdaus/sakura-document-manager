@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Download Dokumen Karyawan</div>
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

					<form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Karyawan</label>
							<div class="col-md-6">
								<select id="employee_id" name="employee_id" class="js-dropdown-employee form-control" placeholder='Pilih karyawan'>
									<option value="" selected disabled>Pilih karyawan</option>
									@foreach ($employees->all() as $employee)
										<option value="{{$employee->id}}">{{$employee->name}} ( {{$employee->company->name}} )</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a id="download" class="btn btn-primary" href="#" role="button">Download</a>
							</div>
						</div>
					</form>

					<script type="text/javascript">
						$(".js-dropdown-employee").select2({
							placeholder: "Pilih karyawan"
						});

						$('.js-dropdown-employee').val("{{ old('employee_id') }}").trigger("change");

						$('#download').click(
						function download() {
							var id = $('#employee_id').val();
							if (id == null) {
								alert('Pilih karyawan');
							} else {
								window.open("{{ url('report/download-document/') }}/" + id);
							}
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
