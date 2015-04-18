@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Daftar Perusahaan</div>
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
						<a class="btn btn-primary btn-sm" href="{{ url('/company/create') }}" role="button">Tambah Perusahaan</a>
					</div>

					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Perintah</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($companies->all() as $company)
									<tr>
										<td>{{$company->name}}</td>
										<td>{{$company->address}}</td>
										<td>
											<a class="btn btn-success" href="{{ url('/company/' . $company->id . '/view') }}" role="button">Lihat</a>
											<a class="btn btn-primary" href="{{ url('/company/' . $company->id . '/edit') }}" role="button">Edit</a>
											<a class="btn btn-warning" href="{{ url('/company/' . $company->id . '/delete') }}" role="button" Onclick="javascript:return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
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
