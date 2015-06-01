@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Welcome!</div>
					
				<div class="panel-body">
					<p>Selamat datang di Document Management System Sakura Dewata Tour & Travel.</p>
				</div>
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">KITAS Expired</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<a href="{{ url('expired/kitas') }}" style="font-size:75px">{{ $kitas }}</a>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 text-center">
							<p style='font-weight: bold'>KITAS akan segera expired</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Passport Expired</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<a href="{{ url('expired/passport') }}" style="font-size:75px">{{ $passport }}</a>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 text-center">
							<p style='font-weight: bold'>Passport akan segera expired</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">RPTKA Expired</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<a href="{{ url('expired/rptka') }}" style="font-size:75px">{{ $rptka }}</a>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 text-center">
							<p style='font-weight: bold'>RPTKA akan segera expired</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">IMTA Expired</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<a href="{{ url('expired/imta') }}" style="font-size:75px">{{ $imta }}</a>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 text-center">
							<p style='font-weight: bold'>IMTA akan segera expired</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
