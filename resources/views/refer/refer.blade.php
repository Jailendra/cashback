@include('shared.errors')
@include('shared.success')

<form method="POST" action="{{ route('refer') }}">
    <div class="input-group">
        @csrf
        <input name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control @error('email') is-invalid @enderror" placeholder="Add your email">
        <span class="input-group-btn">
            <button class="btn" type="submit">Send Now</button>
        </span>
    </div>
</form>