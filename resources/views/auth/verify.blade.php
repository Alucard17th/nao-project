@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header-pills my-4">
                        <h3 class="text-center">
                            <strong>{{ __('Verify Your Email Address') }}</strong>
                        </h3>
                    </div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p class="m-0 text-center">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                        <p class="m-0 text-center">{{ __('If you did not receive the email') }},</p>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link d-block mx-auto">{{ __('click here to request another') }}.</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
