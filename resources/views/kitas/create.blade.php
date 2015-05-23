@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Tambah KITAS</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/kitas/create') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Issued</label>
							<div class="col-md-6">
								<input type="text" id="issued" class="form-control" name="issued" value="{{ old('issued') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Expired</label>
							<div class="col-md-6">
								<input type="text" id="expired" class="form-control" name="expired" value="{{ old('expired') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nomor Dokumen</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="doc_number" value="{{ old('doc_number') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Ke</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="sequence" value="{{ old('sequence') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Pilih Karyawan</label>
							<div class="col-md-6">
								<select name="employee_id" class="js-dropdown-employee form-control" placeholder='Pilih karyawan'>
									<option value="" selected disabled>Pilih karyawan</option>
									@foreach ($employees->all() as $employee)
										<option value="{{$employee->id}}">{{$employee->name}} ({{$employee->company->name}})</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Scan Dokumen</label>
							<div class="col-md-6">
								<input type="file" name="document_file">
								<p class="help-block">Hanya upload file pdf, jpg, dan png</p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Simpan
								</button>
								<a class="btn btn-primary" href="{{ url('/kitas') }}" role="button">Kembali</a>
							</div>
						</div>
					</form>

					<script type="text/javascript">

						$(".js-dropdown-employee").select2({
							placeholder: "Pilih karyawan"
						});

						$('.js-dropdown-employee').val("{{ old('employee_id') }}").trigger("change");

						$( "#issued" ).datepicker({
							changeMonth: true,
							changeYear: true,
							dateFormat: "dd-mm-yy"
						});
						$( "#expired" ).datepicker({
							changeMonth: true,
							changeYear: true,
							dateFormat: "dd-mm-yy"
						});

					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
