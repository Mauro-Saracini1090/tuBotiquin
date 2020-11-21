@extends('welcome')

@section('contenido')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-md-8 col-12">
                <div class="p-3 mb-5 shadow  rounded"> 
                    <div class="card-body mb-2">
                        <h3 class="masthead-subheading  mb-0 text-center"> {{ "Verifique su Dirección de E-mail" }}</h3>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
