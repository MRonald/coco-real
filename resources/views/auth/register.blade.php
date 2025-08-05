@extends('layouts.front-without-footer')

@section('content')
    <!-- Main Content Start -->

    <!-- Login form Start -->
    <div class="contact p-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="form-block bg-lightest-gray p-24 br-20">
                        <h5 class="light-black mb-24">REALIZE SEU CADASTRO</h5>
                        <form method="POST" action="{{ route('register') }}" class="form-group">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="icon-block">
                                        <input type="text" class="form-control check-form mb-24" id="first-name"
                                            name="name" required placeholder="Nome">
                                        <i class="fal fa-user"></i>
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-sm-12">
                                    <div class="icon-block">
                                        <input type="email" class="form-control check-form mb-24" id="e-mai"
                                            name="email" required placeholder="Email">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="col-sm-12">
                                    <div class="icon-block">
                                        <input type="password" class="form-control check-form mb-24" id="pass-word"
                                            name="password" required placeholder="Senha">
                                        <i class="fal fa-eye-slash fa-flip-horizontal"></i>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="col-sm-12">
                                    <div class="icon-block">
                                        <input type="password" class="form-control check-form mb-24" id="pass-word-confirm"
                                            name="password_confirmation" required placeholder="Confirmação de senha">
                                        <i class="fal fa-eye-slash fa-flip-horizontal"></i>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <h6 class="mb-32">Já tem uma conta? <a href="{{ route('login') }}"
                                        class="color-primary">Entrar</a>
                                </h6>
                            </div>
                            <button type="submit" class="b-unstyle cus-btn active w-100 mb-24 d-grid">
                                CADASTRAR
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login form End -->


    <!-- Main Content End -->
@endsection
