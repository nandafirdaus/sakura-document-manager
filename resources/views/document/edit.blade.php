@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Dokumen</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/document/' . $document->id .  '/edit') . $prev  }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="kitas_id" value="{{ $document->kitas_id }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Tipe Dokumen</label>
							<div class="col-md-6">
								<select name="type_id" class="js-dropdown-document-type form-control" placeholder='Pilih tipe dokumen'>
									<option value="" selected disabled>Pilih tipe dokumen</option>
									@foreach ($documentTypes->all() as $documentType)
										<option value="{{$documentType->id}}">{{$documentType->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Issued</label>
							<div class="col-md-6">
								<input type="text" id="issued" class="form-control" name="issued" value="{{ date('d-m-Y', strtotime($document->issued)) }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Expired</label>
							<div class="col-md-6">
								<input type="text" id="expired" class="form-control" name="expired" value="{{ date('d-m-Y', strtotime($document->expired)) }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nomor Dokumen</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="doc_number" value="{{ $document->doc_number }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Scan Dokumen</label>
							<div class="col-md-6">
								<input type="file" name="document_file">
								<p class="help-block">Hanya upload file pdf, jpg, dan png</p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Simpan
								</button>
								@if($prev == '')
									<a class="btn btn-primary" href="{{ url('kitas/' . $document->kitas_id . '/view') }}" role="button">Kembali</a>
								@else
									<a class="btn btn-primary" href="{{ url('expired/imta') }}" role="button">Kembali</a>
								@endif
							</div>
						</div>
					</form>

					<script type="text/javascript">
						$(".js-dropdown-document-type").select2({
							placeholder: "Pilih tipe dokumen"
						});

						$('.js-dropdown-document-type').val("{{ $document->document_type_id }}").trigger("change");

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

					</script>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
