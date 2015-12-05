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
							<label class="col-md-4 control-label">Versi:</label>
							<div class="col-md-6">
								<p class="form-control-static">{{ $kitas->version }}</p>
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
							<tfoot>
							    <tr role="row">
							        <th data-column="0" colspan="4" class="ts-pager form-horizontal tablesorter-pager tablesorter-headerAsc">
										<button aria-disabled="false" tabindex="0" type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
										<button aria-disabled="false" tabindex="0" type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
										<span class="pagedisplay">41 - 50 / 50 (50)</span> <!-- this can be any element, including an input -->
										<button aria-disabled="true" tabindex="0" type="button" class="btn next disabled"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
										<button aria-disabled="true" tabindex="0" type="button" class="btn last disabled"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
										<select aria-disabled="false" class="pagesize input-mini" title="Select page size">
											<option value="10">10</option>
											<option value="20">20</option>
											<option value="30">30</option>
											<option value="40">40</option>
										</select>
										<select aria-disabled="false" class="pagenum input-mini" title="Select page number"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
									</th>
							    </tr>
							</tfoot>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Daftar Dokumen Lama</div>
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
									<th>Versi</th>
									<th>Perintah</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($deletedDocuments->all() as $document)
									<tr>
										<td>{{$document->documentType->name}}</td>
										<td>{{date('d-m-Y', strtotime($document->issued))}}</td>
										<td>{{date('d-m-Y', strtotime($document->expired))}}</td>
										<td>{{$document->version}}</td>
										<td>
											<a class="btn btn-success" href="{{ url('/document/' . $document->id . '/view') }}" role="button">Lihat</a>
											<!-- <a class="btn btn-primary" href="{{ url('/document/' . $document->id . '/edit') }}" role="button">Edit</a> -->
											<!-- <a class="btn btn-warning" href="{{ url('/document/' . $document->id . '/delete') }}" role="button" Onclick="javascript:return confirm('Yakin ingin menghapus data ini?');">Hapus</a> -->
										</td>
									</td>
								@endforeach
							</tbody>
							<tfoot>
							    <tr role="row">
							        <th data-column="0" colspan="5" class="ts-pager form-horizontal tablesorter-pager tablesorter-headerAsc">
										<button aria-disabled="false" tabindex="0" type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
										<button aria-disabled="false" tabindex="0" type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
										<span class="pagedisplay">41 - 50 / 50 (50)</span> <!-- this can be any element, including an input -->
										<button aria-disabled="true" tabindex="0" type="button" class="btn next disabled"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
										<button aria-disabled="true" tabindex="0" type="button" class="btn last disabled"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
										<select aria-disabled="false" class="pagesize input-mini" title="Select page size">
											<option value="10">10</option>
											<option value="20">20</option>
											<option value="30">30</option>
											<option value="40">40</option>
										</select>
										<select aria-disabled="false" class="pagenum input-mini" title="Select page number"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
									</th>
							    </tr>
							</tfoot>
						</table>

						<script type="text/javascript">
							$(function() {

							  // NOTE: $.tablesorter.theme.bootstrap is ALREADY INCLUDED in the jquery.tablesorter.widgets.js
							  // file; it is included here to show how you can modify the default classes
							  $.tablesorter.themes.bootstrap = {
								// these classes are added to the table. To see other table classes available,
								// look here: http://getbootstrap.com/css/#tables
								table			: 'table table-bordered table-striped',
								caption	  		: 'caption',
								// header class names
								header	   		: 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
								sortNone		: '',
								sortAsc	  		: '',
								sortDesc		: '',
								active	   		: '', // applied when column is sorted
								hover			: '', // custom css required - a defined bootstrap style may not override other classes
								// icon class names
								icons			: '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
								iconSortNone 	: 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
								iconSortAsc  	: 'icon-chevron-up glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
								iconSortDesc 	: 'icon-chevron-down glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
								filterRow		: '', // filter row class
								footerRow		: '',
								footerCells  	: '',
								even		 	: '', // even row zebra striping
								odd		  		: ''  // odd row zebra striping
							  };

							  // call the tablesorter plugin and apply the uitheme widget
							  $("table").tablesorter({
								// this will apply the bootstrap theme if "uitheme" widget is included
								// the widgetOptions.uitheme is no longer required to be set
								theme : "bootstrap",

								widthFixed: true,

								headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

								// widget code contained in the jquery.tablesorter.widgets.js file
								// use the zebra stripe widget if you plan on hiding any rows (filter widget)
								widgets : [ "uitheme", "filter", "zebra" ],

								widgetOptions : {
								  // using the default zebra striping class name, so it actually isn't included in the theme variable above
								  // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
								  zebra : ["even", "odd"],

								  // reset filters button
								  filter_reset : ".reset"

								  // set the uitheme widget to use the bootstrap theme class names
								  // this is no longer required, if theme is set
								  // ,uitheme : "bootstrap"

								}
							  })
							  .tablesorterPager({

								// target the pager markup - see the HTML block below
								container: $(".ts-pager"),

								// target the pager page select dropdown - choose a page
								cssGoto  : ".pagenum",

								// remove rows from the table to speed up the sort of large tables.
								// setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
								removeRows: true,

								// output string - default is '{page}/{totalPages}';
								// possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
								output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

							  });
							});
						</script>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
