@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Tambah Dokumen</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/document/create') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Issued</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="issued" value="{{ old('issued') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Expired</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="expired" value="{{ old('expired') }}">
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
							<label class="col-md-4 control-label">Tipe Dokumen</label>
							<div class="col-md-6">
								<select name="type_id" class="js-dropdown-document-type form-control" placeholder='Pilih tipe dokumen'>
									<option value="" selected disabled>Pilih tipe dokumen</option>
									@foreach ($documentTypes->all() as $documentType)
										<option value="{{$documentType->id}}">{{$documentType->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Pilih Karyawan</label>
							<div class="col-md-6">
								<select name="employee_id" class="js-dropdown-employee form-control" placeholder='Pilih karyawan'>
									<option value="" selected disabled>Pilih karyawan</option>
									@foreach ($employees->all() as $employee)
										<option value="{{$employee->id}}">{{$employee->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Scan Dokumen</label>
							<div class="col-md-6">
								<input type="file" id="file_url">
								<p class="help-block">Hanya upload file pdf, jpg, dan png</p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Simpan
								</button>
								<a class="btn btn-primary" href="{{ url('/document') }}" role="button">Kembali</a>
							</div>
						</div>
					</form>

					<script type="text/javascript">
						$(".js-dropdown-document-type").select2({
							placeholder: "Pilih tipe dokumen"
						});

						$('.js-dropdown-document-type').val("{{ old('type_id') }}").trigger("change");

						$(".js-dropdown-employee").select2({
							placeholder: "Pilih karyawan"
						});

						$('.js-dropdown-employee').val("{{ old('employee_id') }}").trigger("change");
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
