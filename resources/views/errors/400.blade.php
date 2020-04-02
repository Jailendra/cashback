<h1>400</h1>
<div>Bad request</div>
@if(env('APP_ENV') === "local")
<p>{{ $exception->getMessage() }}</p>
@endif