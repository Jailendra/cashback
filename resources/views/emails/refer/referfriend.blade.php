Hello,

<p><b>{{ $name }}</b> sent you a request to join him on <b>{{ config ('app.name') }}</b></p>
<p>You can join him by clicking on <a href="{{ config('app.url') }}/register">{{ config ('app.name') }}</a></p>

<p><h3>Refrence Code:</h3><h2>{{ $reference_code }}</h2></p>