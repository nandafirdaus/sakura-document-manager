@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Lihat Karyawan</div>
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

						<input type="hidden" name="id" value="{{ $employee->id }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Nama:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $employee->name }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Jabatan:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $employee->position }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Perusahaan:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $employee->company->name }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">RPTKA:</label>
							<div class="col-md-6">
								@if($employee->rptka != null)
									<p class="form-control-static">{{ $employee->rptka->doc_number }}</p>
								@else
									<p class="form-control-static">-</p>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">RPTKA Issued:</label>
							<div class="col-md-6">
								@if($employee->rptka != null)
									<p class="form-control-static">{{ date('d-m-Y', strtotime($employee->rptka->issued)) }}</p>
								@else
									<p class="form-control-static">-</p>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">RPTKA Expired:</label>
							<div class="col-md-6">
								@if($employee->rptka != null)
									<p class="form-control-static">{{ date('d-m-Y', strtotime($employee->rptka->expired)) }}</p>
								@else
									<p class="form-control-static">-</p>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Passport Number:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $employee->passport_number }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Passport Issued:</label>
							<div class="col-md-6">
								@if($employee->passport_issued != null)
									<p class="form-control-static">{{ date('d-m-Y', strtotime($employee->passport_issued)) }}</p>
								@else
									<p class="form-control-static">-</p>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Passport Expired:</label>
							<div class="col-md-6">
								@if($employee->passport_expired != null)
									<p class="form-control-static">{{ date('d-m-Y', strtotime($employee->passport_expired)) }}</p>
								@else
									<p class="form-control-static">-</p>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Scan Passport:</label>
							<div class="col-md-6">
								@if($employee->passport_file_url != '')
								<a class="btn btn-default btn-sm" href="{{ url($employee->passport_file_url) }}" target="_blank" role="button">Download</a>
								@else
									<a class="btn btn-default btn-sm" disabled="disabled" target="_blank" role="button">Download</a>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								@if($prev == '')
									<a class="btn btn-primary" href="{{ url('/employee') }}" role="button">Kembali</a>
								@else
									<a class="btn btn-primary" href="{{ url('expired/passport') }}" role="button">Kembali</a>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
