@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lihat RPTKA</div>
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

						<div class="form-group">
							<label class="col-md-4 control-label">Perusahaan:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $rptka->company->name }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Issued:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ date('d-m-Y', strtotime($rptka->issued)) }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Expired:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ date('d-m-Y', strtotime($rptka->expired)) }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nomor Dokumen:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $rptka->doc_number }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Download dokumen:</label>
							<div class="col-md-6">
								@if($rptka->file_url != '')
									<a class="btn btn-default btn-sm" href="{{ url($rptka->file_url) }}" target="_blank" role="button">Download</a>
								@else
									<a class="btn btn-default btn-sm" disabled="disabled" target="_blank" role="button">Download</a>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								@if($prev == '')
									<a class="btn btn-primary" href="{{ url('/rptka') }}" role="button">Kembali</a>
								@else
									<a class="btn btn-primary" href="{{ url('expired/rptka') }}" role="button">Kembali</a>
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
