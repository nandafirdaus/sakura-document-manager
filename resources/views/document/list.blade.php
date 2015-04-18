@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Daftar Karyawan</div>
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
						<a class="btn btn-primary btn-sm" href="{{ url('/employee/create') }}" role="button">Tambah Karyawan</a>
					</div>

					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Posisi</th>
									<th>Perusahaan</th>
									<th>Perintah</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($employees->all() as $employee)
									<tr>
										<td>{{$employee->name}}</td>
										<td>{{$employee->position}}</td>
										<td>{{$employee->company->name}}</td>
										<td>
											<a class="btn btn-success" href="{{ url('/employee/' . $employee->id . '/view') }}" role="button">Lihat</a>
											<a class="btn btn-primary" href="{{ url('/employee/' . $employee->id . '/edit') }}" role="button">Edit</a>
											<a class="btn btn-warning" href="{{ url('/employee/' . $employee->id . '/delete') }}" role="button" Onclick="javascript:return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
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
