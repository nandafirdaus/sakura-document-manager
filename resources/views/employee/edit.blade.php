@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Karyawan</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/employee/' . $employee->id .  '/edit') . $prev }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nama</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $employee->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Jabatan</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="position" value="{{ $employee->position }}">
							</div>
						</div>

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
							<label class="col-md-4 control-label">RPTKA</label>
							<div class="col-md-6">
								<select id="rptka_id" name="rptka_id" class="js-dropdown-rptka form-control" placeholder='Pilih RPTKA'>
									<option></option>
									@foreach ($employee->company->rptka->all() as $rptka)
										<option value="{{$rptka->id}}">{{$rptka->doc_number}}</option>
									@endforeach

								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Passport Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="passport_number" value="{{ $employee->passport_number }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Passport Issued</label>
							<div class="col-md-6">
								<input type="text" id="issued" class="form-control" name="passport_issued" value="{{ $employee->passport_issued }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Passport Expired</label>
							<div class="col-md-6">
								<input type="text" id="expired" class="form-control" name="passport_expired" value="{{ $employee->passport_expired }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Scan Passport</label>
							<div class="col-md-6">
								<input type="file" name="passport_file">
								<p class="help-block">Hanya upload file pdf, jpg, dan png</p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Simpan
								</button>
								@if($prev == '')
									<a class="btn btn-primary" href="{{ url('/employee') }}" role="button">Kembali</a>
								@else
									<a class="btn btn-primary" href="{{ url('expired/passport') }}" role="button">Kembali</a>
								@endif
							</div>
						</div>
					</form>

					<script type="text/javascript">
						$('#company_id').val("{{$employee->company->id}}").trigger("change");

						$('#company_id').change(function(){
							$.get("{{ url('company/rptka')}}", 
								{ id: $(this).val() }, 
								function(data) {
									var rptkaId = $('#rptka_id');
									rptkaId.empty();

									rptkaId.append("<option></option>")

									$.each(data, function(index, element) {
							            rptkaId.append("<option value='"+ element.id +"'>" + element.doc_number + "</option>");
							        });

								});
						});

						$( "#issued" ).datepicker({
							changeMonth: true,
							changeYear: true,
							dateFormat: "dd-mm-yy"
						});
						$( "#expired" ).datepicker({
							changeMonth: true,
							changeYear: true,
							dateFormat: "dd-mm-yy"
						});

						$(".js-dropdown-company").select2({
							placeholder: "Pilih perusahaan"
						});

						@if($employee->rptka != null)
							$('select[name^="rptka_id"] option[value="{{$employee->rptka->id}}"]').attr("selected","selected");
						@endif
					</script>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
