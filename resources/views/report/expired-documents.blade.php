@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Laporan Dokumen Expired Bulanan</div>
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
							<div class="col-md-3">
								<select id="month-start" name="month-start" class="js-dropdown-month-start form-control" placeholder='Pilih bulan awal'>
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
							<div class="col-md-3">
								<select id="year-start" name="year-start" class="js-dropdown-year-start form-control" placeholder='Pilih tahun awal'>
									<option value="" selected disabled>Pilih tahun awal</option>
									<option value="2014">2014</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
									<option value="2026">2026</option>
									<option value="2027">2027</option>
									<option value="2028">2028</option>
									<option value="2029">2029</option>
									<option value="2030">2030</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Bulan Akhir</label>
							<div class="col-md-3">
								<select id="month-end" name="month-end" class="js-dropdown-month-end form-control" placeholder='Pilih bulan awal'>
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
							<div class="col-md-3">
								<select id="year-end" name="year-end" class="js-dropdown-year-end form-control" placeholder='Pilih tahun akhir'>
									<option value="" selected disabled>Pilih tahun akhir</option>
									<option value="2014">2014</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
									<option value="2026">2026</option>
									<option value="2027">2027</option>
									<option value="2028">2028</option>
									<option value="2029">2029</option>
									<option value="2030">2030</option>
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
						$(".js-dropdown-month-start").select2({
							placeholder: "Pilih Bulan Awal"
						});

						$('.js-dropdown-month-start').val("{{ old('month-start') }}").trigger("change");

						$(".js-dropdown-year-start").select2({
							placeholder: "Pilih Tahun Awal"
						});

						$('.js-dropdown-year-start').val("{{ old('year-start') }}").trigger("change");

						$(".js-dropdown-month-end").select2({
							placeholder: "Pilih Bulan Akhir"
						});

						$('.js-dropdown-month-end').val("{{ old('month-end') }}").trigger("change");

						$(".js-dropdown-year-end").select2({
							placeholder: "Pilih Tahun Akhir"
						});

						$('.js-dropdown-year-end').val("{{ old('year-end') }}").trigger("change");

						$('#download').click(
						function download() {
							var monthStart = $('#month-start').val();
							var yearStart = $('#year-start').val();
							var monthEnd = $('#month-end').val();
							var yearEnd = $('#year-end').val();

							if (monthStart == null || yearStart == null || monthEnd == null || yearEnd == null) {
								alert('Pilih bulan');
							} else if (yearEnd < yearStart || (yearEnd == yearStart && monthEnd < monthStart) ) {
								alert('Tanggal awal harus lebih kecil atau sama dengan tanggal akhir!');
							}else {
								window.open("{{ url('report/generate-expired/') }}/" + monthStart + '/' 
									+ yearStart + '/' + monthEnd + '/' + yearEnd);
							}
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
