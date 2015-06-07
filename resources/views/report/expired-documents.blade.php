@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Laporan Dokumen Expired</div>
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
							<label class="col-md-4 control-label">Bulan Awal</label>
							<div class="col-md-6">
								<select id="month-start" name="month-start" class="js-dropdown-company form-control" placeholder='Pilih bulan awal'>
									<option value="" selected disabled>Pilih bulan awal</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Bulan Akhir</label>
							<div class="col-md-6">
								<select id="month-end" name="month-end" class="js-dropdown-company form-control" placeholder='Pilih bulan awal'>
									<option value="" selected disabled>Pilih bulan akhir</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
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
						$(".js-dropdown-company").select2({
							placeholder: "Pilih Bulan Awal"
						});

						$('.js-dropdown-company').val("{{ old('month-start') }}").trigger("change");

						$('#download').click(
						function download() {
							var id = $('#month-start').val();
							if (id == null) {
								alert('Pilih bulan');
							} else {
								window.open("{{ url('report/generate-expired/') }}/" + id);
							}
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
