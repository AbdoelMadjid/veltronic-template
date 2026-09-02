@extends('layouts.index', ['CreativeLayout' => true])
@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url("{{ \App\Support\ThemeAsset::url('media/auth/bg4.jpg', $theme_asset_pack ?? null) }}");
            }

            [data-bs-theme="dark"] body {
                background-image: url("{{ \App\Support\ThemeAsset::url('media/auth/bg4-dark.jpg', $theme_asset_pack ?? null) }}");
            }
        </style>

        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            @include('auth.partials._branding')

            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        <form class="form w-100" method="POST" action="{{ route('password.email') }}" id="kt_forgot_password_form">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success mb-8" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger mb-8" role="alert">
                                    <ul class="mb-0 ps-4">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">{{ __('auth.forgot_password_title') }}</h1>
                                <div class="text-gray-500 fw-semibold fs-6">{{ __('auth.forgot_password_subtitle') }}</div>
                            </div>

                            <div class="text-gray-500 fw-semibold fs-6 mb-8 text-center">
                                {{ __('auth.forgot_password_description') }}
                            </div>

                            <div class="fv-row mb-8">
                                <input id="email" type="email" placeholder="{{ __('auth.email') }}" name="email"
                                    value="{{ old('email') }}" required autofocus class="form-control bg-transparent" />
                                <div id="emailError" class="invalid-feedback">{{ __('auth.js.invalid_email') }}</div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const forgotPasswordForm = document.getElementById("kt_forgot_password_form");
                                    const emailInput = document.getElementById("email");
                                    const emailError = document.getElementById("emailError");

                                    function validateEmailField() {
                                        const hasValue = emailInput.value.trim().length > 0;
                                        const isValid = emailInput.validity.valid;

                                        if (hasValue && !isValid) {
                                            emailInput.classList.add("is-invalid");
                                            emailError.textContent = @json(__('auth.js.invalid_email'));
                                            return false;
                                        }

                                        emailInput.classList.remove("is-invalid");
                                        return true;
                                    }

                                    emailInput.addEventListener("input", validateEmailField);
                                    emailInput.addEventListener("blur", validateEmailField);

                                    forgotPasswordForm.addEventListener("submit", function(e) {
                                        if (!validateEmailField()) {
                                            e.preventDefault();
                                            emailInput.focus();
                                        }
                                    });
                                });
                            </script>

                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ __('auth.send_reset_link') }}</span>
                                    <span class="indicator-progress">{{ __('auth.please_wait') }}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                            <div class="text-center text-gray-500 fw-semibold fs-6">
                                <a href="{{ route('login') }}" class="link-primary">{{ __('auth.back_to_login') }}</a>
                            </div>
                        </form>
                    </div>

                    @include('auth.partials._language-footer')
                </div>
            </div>
        </div>
    </div>
@endsection
