<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>
	<table>
		<tr>
			<td>
				{{ Form::open(array('url' => 'bassengweb/hvertime', 'method' => 'GET')) }}
				{{ Form::submit('Hver Time') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/hvertredjetime', 'method' => 'GET')) }}
				{{ Form::submit('Hver Tredje Time') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/gjoremal', 'method' => 'GET')) }}
				{{ Form::submit('Gjøremål') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/dagvakt', 'method' => 'GET')) }}
				{{ Form::submit('Dagvakt') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/kveldsvakt', 'method' => 'GET')) }}
				{{ Form::submit('Kveldsvakt') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/kontrollcm', 'method' => 'GET')) }}
				{{ Form::submit('Kontroll CM') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/sok', 'method' => 'GET')) }}
				{{ Form::submit('Søk') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/diagram', 'method' => 'GET')) }}
				{{ Form::submit('Diagrammer') }}
				{{ Form::close() }}
			</td>

			<td>
				{{ Form::open(array('url' => 'bassengweb/rapport', 'method' => 'GET')) }}
				{{ Form::submit('Rapport') }}
				{{ Form::close() }}
			</td>
		</tr>
	</table>

	@if(Session::has('message'))
		<p style="color: green;">{{ Session::get('message') }}</p>
	@endif
	
	@yield('content')

	@if(Session::has('noData'))
		<p style="color: red;">{{ Session::get('noData') }}</p>
	@endif
</body>
</html>
