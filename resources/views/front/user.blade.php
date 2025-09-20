@extends('layouts.app')

@push('head')
    <meta property="og:title" content="{{ $user->name }}"/>
    <meta property="og:type" content="profile"/>
    <meta property="og:description" content="{{ $user->about }}"/>
    <meta property="og:image" content="{{ $user->avatar_url }}"/>
    <meta property="og:url" content="{{ route('short-link', $user->short_code) }}"/>

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="{{ $user->name }}"/>
    <meta name="twitter:description" content="{{ $user->about }}"/>
    <meta name="twitter:image" content="{{ $user->avatar_url }}"/>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 mt-4">
                <div class="card rounded-4">
                    <div class="card-body p-4">
                        <div class="mb-3 text-center">
                            <img
                                class="rounded-circle"
                                width="220" height="220"
                                src="{{ $user->avatar_url }}"
                                alt="{{ $user->name }}"
                            >
                        </div>
                        <div class="text-center">
                            <h3 class="card-title mb-2">{{ $user->name }}</h3>
                            <p class="card-text mb-4 text-secondary">{{ $user->email }}</p>
                        </div>
                        <p class="card-text mb-4">{{ $user->about }}</p>
                        <div class="d-grid gap-2">
                            <div class="text-center">
                                Your short link: <a href="{{ route('short-link', $user->short_code) }}">
                                    {{ route('short-link', $user->short_code) }}
                                </a>
                            </div>
                            <button class="btn btn-primary"
                                    onclick="navigator.clipboard.writeText('{{ route('short-link', $user->short_code) }}');alert('Copied to clipboard!')">
                                {{ __('Copy Short Link') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 mt-4">
                @guest()
                    @include('partials.register-form-card')
                @endguest
                @auth()
                    <div class="text-center py-4">
                        You are already logged in.
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
