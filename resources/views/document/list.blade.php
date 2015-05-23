@extends('app')

@section('content')
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
						<a class="btn btn-primary btn-sm" href="{{ url('/document/create') }}" role="button">Tambah Dokumen</a>
					</div>

					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Nama Karyawan</th>
									<th>Tipe Dokumen</th>
									<th>Ke</th>
									<th>Perusahaan</th>
									<th>Issued</th>
									<th>Expired</th>
									<th>Perintah</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($documents->all() as $document)
									<tr>
										<td>{{$document->employee->name}}</td>
										<td>{{$document->documentType->name}}</td>
										<td>{{$document->sequence}}</td>
										<td>{{$document->employee->company->name}}</td>
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
