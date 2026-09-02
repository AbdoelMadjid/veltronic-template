@extends('layouts.index', ['CreativeLayout' => true])
@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url("{{ \App\Support\ThemeAsset::url('media/auth/bg4.jpg', $theme_asset_pack ?? null) }}");
                min-height: 100vh;
                overflow: hidden;
            }

            [data-bs-theme="dark"] body {
                background-image: url("{{ \App\Support\ThemeAsset::url('media/auth/bg4-dark.jpg', $theme_asset_pack ?? null) }}");
            }

            #kt_app_root {
                min-height: 100vh;
            }

            @media (max-width: 991.98px), (max-height: 760px) {
                body {
                    overflow-y: auto;
                }

                #kt_app_root {
                    min-height: auto;
                }
            }
        </style>

        <div class="d-flex flex-column flex-column-fluid flex-lg-row min-vh-100">
            @include('auth.partials._branding')

            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        @php
                            $emailHasError = $errors->has('email');
                            $passwordHasError = $errors->has('password');
                        @endphp
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="/dashboard"
                            action="{{ route('login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="locale" value="{{ app()->getLocale() }}">

                            @if (session('status'))
                                <div class="alert alert-success mb-8" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger mb-8" role="alert">
                                    <div class="fw-bold mb-2">{{ __('auth.login_failed') }}</div>
                                    <ul class="mb-0 ps-4">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">{{ __('auth.title') }}</h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{ __('auth.subtitle') }}
                                </div>
                            </div>

                            <div class="row g-3 mb-9">
                                <div class="col-md-6">
                                    <a href="javascript:void(0)"
                                        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo"
                                            src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/google-icon.svg', $theme_asset_pack ?? null) }}"
                                            class="h-15px me-3" />{{ __('auth.sign_in_with_google') }}</a>
                                </div>

                                <div class="col-md-6">
                                    <a href="javascript:void(0)"
                                        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo"
                                            src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/apple-black.svg', $theme_asset_pack ?? null) }}"
                                            class="theme-light-show h-15px me-3" />
                                        <img alt="Logo"
                                            src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/apple-black-dark.svg', $theme_asset_pack ?? null) }}"
                                            class="theme-dark-show h-15px me-3" />{{ __('auth.sign_in_with_apple') }}</a>
                                </div>
                            </div>

                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">{{ __('auth.or_with_email') }}</span>
                            </div>

                            <div class="fv-row mb-8">
                                <div class="position-relative">
                                    <input id="emailInput" type="text" placeholder="{{ __('auth.email') }}" name="email"
                                        autocomplete="off" value="{{-- {{ old('email') }} --}}test@example.com"
                                        class="form-control bg-transparent @if ($emailHasError) is-invalid border-danger pe-12 @endif" />
                                    <span id="emailErrorIcon"
                                        class="position-absolute top-50 end-0 translate-middle-y me-4 text-danger d-flex align-items-center @if (! $emailHasError) d-none @endif">
                                        <i class="bi bi-exclamation-circle-fill fs-4"></i>
                                    </span>
                                </div>
                                <div id="emailFieldError" class="invalid-feedback @if ($emailHasError) d-block @endif">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>

                            <div class="fv-row mb-3">
                                <div class="position-relative">
                                    <input type="password" placeholder="{{ __('auth.password_label') }}" name="password"
                                        autocomplete="off" id="passwordInput" value="password"
                                        class="form-control bg-transparent @if ($passwordHasError) is-invalid border-danger pe-15 @endif" />
                                    <span id="passwordErrorIcon"
                                        class="position-absolute top-50 end-0 translate-middle-y me-12 text-danger d-flex align-items-center @if (! $passwordHasError) d-none @endif">
                                        <i class="bi bi-exclamation-circle-fill fs-4"></i>
                                    </span>
                                    <button type="button" id="togglePassword"
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2">
                                        <i id="toggleIcon" class="bi bi-eye-slash fs-2"></i>
                                    </button>
                                </div>
                                <div id="passwordFieldError" class="invalid-feedback @if ($passwordHasError) d-block @endif">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const toggleBtn = document.getElementById("togglePassword");
                                    const emailInput = document.getElementById("emailInput");
                                    const passwordInput = document.getElementById("passwordInput");
                                    const form = document.getElementById("kt_sign_in_form");
                                    const toggleIcon = document.getElementById("toggleIcon");
                                    const emailFieldError = document.getElementById("emailFieldError");
                                    const passwordFieldError = document.getElementById("passwordFieldError");
                                    const emailErrorIcon = document.getElementById("emailErrorIcon");
                                    const passwordErrorIcon = document.getElementById("passwordErrorIcon");

                                    toggleBtn.addEventListener("click", function() {
                                        const isPassword = passwordInput.getAttribute("type") === "password";
                                        passwordInput.setAttribute("type", isPassword ? "text" : "password");
                                        toggleIcon.classList.toggle("bi-eye", isPassword);
                                        toggleIcon.classList.toggle("bi-eye-slash", !isPassword);
                                    });

                                    function setFieldError(input, feedback, icon, message) {
                                        input.classList.add("is-invalid", "border-danger");
                                        feedback.textContent = message;
                                        feedback.classList.add("d-block");
                                        icon.classList.remove("d-none");
                                    }

                                    function clearFieldError(input, feedback, icon) {
                                        input.classList.remove("is-invalid", "border-danger");
                                        feedback.classList.remove("d-block");
                                        icon.classList.add("d-none");
                                    }

                                    function validateEmailInline() {
                                        const value = emailInput.value.trim();
                                        if (value.length === 0) {
                                            setFieldError(emailInput, emailFieldError, emailErrorIcon, @json(__('auth.js.email_required')));
                                            return false;
                                        }

                                        const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                                        if (!isValid) {
                                            setFieldError(emailInput, emailFieldError, emailErrorIcon, @json(__('auth.js.invalid_email')));
                                            return false;
                                        }

                                        clearFieldError(emailInput, emailFieldError, emailErrorIcon);
                                        return true;
                                    }

                                    function validatePasswordInline() {
                                        if (passwordInput.value.length === 0) {
                                            setFieldError(passwordInput, passwordFieldError, passwordErrorIcon, @json(__('auth.js.password_required')));
                                            return false;
                                        }

                                        clearFieldError(passwordInput, passwordFieldError, passwordErrorIcon);
                                        return true;
                                    }

                                    emailInput.addEventListener("input", validateEmailInline);
                                    emailInput.addEventListener("blur", validateEmailInline);
                                    passwordInput.addEventListener("input", validatePasswordInline);
                                    passwordInput.addEventListener("blur", validatePasswordInline);

                                    form.addEventListener("submit", function(e) {
                                        const validEmail = validateEmailInline();
                                        const validPassword = validatePasswordInline();
                                        if (!validEmail || !validPassword) {
                                            e.preventDefault();
                                        }
                                    });
                                });
                            </script>

                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="{{ route('password.request') }}"
                                    class="link-primary">{{ __('auth.forgot_password') }}</a>
                            </div>

                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ __('auth.submit') }}</span>
                                    <span class="indicator-progress">{{ __('auth.please_wait') }}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                {{ __('auth.not_member_yet') }}
                                <a href="{{ route('register') }}" class="link-primary">{{ __('auth.sign_up') }}</a>
                            </div>
                        </form>
                    </div>

                    @include('auth.partials._language-footer', ['menuId' => 'kt_auth_lang_menu'])
                </div>
            </div>
        </div>
    </div>
@endsection
