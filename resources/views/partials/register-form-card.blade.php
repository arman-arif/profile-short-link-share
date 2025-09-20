<div class="card rounded-4">
    <div class="card-body p-4">
        <h3 class="card-title mb-3">{{ __('Register') }}</h3>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>


            <div class="form-group mb-3">
                <label for="about" class="form-label">{{ __('About Yourself') }}</label>
                <textarea id="about" class="form-control @error('about') is-invalid @enderror"
                          name="about" required>{{ old('about') }}</textarea>

                @error('about')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="avatar" class="form-label">{{ __('Avatar') }}</label>
                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" required>

                @error('avatar')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-3">
                {!! app('captcha')->display() !!}
                @error('g-recaptcha-response')
                <span class="text-danger small mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>

            <div class="d-flex justify-content-center mb-0">
                <button type="submit" class="btn btn-primary px-5">
                    {{ __('Register') }}
                </button>
            </div>


            <div class="text-center mt-3">
                {{ __("Already got an account?") }}
                <a href="{{ route('login') }}">
                    {{ __("Login here") }}
                </a>
            </div>

        </form>
    </div>
</div>
