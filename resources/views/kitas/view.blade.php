@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lihat KITAS</div>
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
							<label class="col-md-4 control-label">Nama Karyawan:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $kitas->employee->name }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Perusahaan:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $kitas->employee->company->name }}</p>
							</div>
						</div>

						<input type="hidden" name="id" value="{{ $kitas->id }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Issued:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ date('d-m-Y', strtotime($kitas->issued)) }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Expired:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ date('d-m-Y', strtotime($kitas->expired)) }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nomor Dokumen:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $kitas->doc_number }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Ke:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $kitas->sequence }}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Download KITAS:</label>
							<div class="col-md-6">
								@if($kitas->file_url != '')
									<a class="btn btn-default btn-sm" href="{{ url($kitas->file_url) }}" target="_blank" role="button">Download</a>
								@else
									<a class="btn btn-default btn-sm" disabled="disabled" target="_blank" role="button">Download</a>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								@if($prev == '')
									<a class="btn btn-primary" href="{{ url('/kitas') }}" role="button">Kembali</a>
								@else
									<a class="btn btn-primary" href="{{ url('expired/kitas') }}" role="button">Kembali</a>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Daftar Dokumen</div>
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

					<div class="form-group">
						<a class="btn btn-primary btn-sm" href="{{ url('/document/create/' . $kitas->id) }}" role="button">Tambah Dokumen</a>
					</div>

					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Tipe Dokumen</th>
									<th>Issued</th>
									<th>Expired</th>
									<th>Perintah</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($documents->all() as $document)
									<tr>
										<td>{{$document->documentType->name}}</td>
										<td>{{date('d-m-Y', strtotime($document->issued))}}</td>
										<td>{{date('d-m-Y', strtotime($document->expired))}}</td>
										<td>
											<a class="btn btn-success" href="{{ url('/document/' . $document->id . '/view') }}" role="button">Lihat</a>
											<a class="btn btn-primary" href="{{ url('/document/' . $document->id . '/edit') }}" role="button">Edit</a>
											<a class="btn btn-warning" href="{{ url('/document/' . $document->id . '/delete') }}" role="button" Onclick="javascript:return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
										</td>
									</td>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
