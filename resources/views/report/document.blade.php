@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Cetak Dokumen</div>
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
							<label class="col-md-4 control-label">Perusahaan</label>
							<div class="col-md-6">
								<select id="company_id" name="company_id" class="js-dropdown-company form-control" placeholder='Pilih perusahaan'>
									<option value="" selected disabled>Pilih perusahaan</option>
									@foreach ($companies->all() as $company)
										<option value="{{$company->id}}">{{$company->name}}</option>
									@endforeach
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
							placeholder: "Pilih perusahaan"
						});

						$('.js-dropdown-company').val("{{ old('company_id') }}").trigger("change");

						$('#download').click(
						function download() {
							var id = $('#company_id').val();
							if (id == null) {
								alert('Pilih perusahaan');
							} else {
								window.open("{{ url('report/generate-document/') }}/" + id);
							}
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
