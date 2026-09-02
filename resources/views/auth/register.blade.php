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
                        <form class="form w-100" method="POST" action="{{ route('register') }}" id="kt_sign_up_form">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success mb-8" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger mb-8" role="alert">
                                    <div class="fw-bold mb-2">{{ __('auth.register_failed') }}</div>
                                    <ul class="mb-0 ps-4">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">{{ __('auth.register_title') }}</h1>
                                <div class="text-gray-500 fw-semibold fs-6">{{ __('auth.register_subtitle') }}</div>
                            </div>

                            <div class="fv-row mb-8">
                                <input id="name" type="text" placeholder="{{ __('auth.name') }}" name="name"
                                    value="{{ old('name') }}" required autofocus autocomplete="name"
                                    class="form-control bg-transparent" />
                            </div>

                            <div class="fv-row mb-8">
                                <input id="email" type="email" placeholder="{{ __('auth.email') }}" name="email"
                                    value="{{ old('email') }}" required autocomplete="username"
                                    class="form-control bg-transparent" />
                                <div id="emailError" class="invalid-feedback">{{ __('auth.js.invalid_email') }}</div>
                            </div>

                            <div class="fv-row mb-8">
                                <div class="position-relative">
                                    <input id="password" type="password" placeholder="{{ __('auth.password_label') }}"
                                        name="password" required autocomplete="new-password"
                                        class="form-control bg-transparent" />
                                    <button type="button"
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 toggle-password"
                                        data-target="password">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                    </button>
                                </div>
                                <div class="mt-3 small" id="passwordChecklist">
                                    <div id="passwordRuleUppercase" class="text-muted mb-1">
                                        <i class="bi bi-circle me-2"></i>{{ __('auth.password_rule_uppercase') }}
                                    </div>
                                    <div id="passwordRuleNumber" class="text-muted mb-1">
                                        <i class="bi bi-circle me-2"></i>{{ __('auth.password_rule_number') }}
                                    </div>
                                    <div id="passwordRuleSymbol" class="text-muted mb-1">
                                        <i class="bi bi-circle me-2"></i>{{ __('auth.password_rule_symbol') }}
                                    </div>
                                    <div id="passwordRuleLength" class="text-muted">
                                        <i class="bi bi-circle me-2"></i>{{ __('auth.password_rule_length') }}
                                    </div>
                                </div>
                                <div id="passwordStrengthError" class="invalid-feedback" style="display: none;">
                                    {{ __('auth.validation.password_strength') }}
                                </div>
                            </div>

                            <div class="fv-row mb-8">
                                <div class="position-relative">
                                    <input id="password_confirmation" type="password"
                                        placeholder="{{ __('auth.confirm_password') }}" name="password_confirmation" required
                                        autocomplete="new-password" class="form-control bg-transparent" />
                                    <button type="button"
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 toggle-password"
                                        data-target="password_confirmation">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                    </button>
                                </div>
                                <div id="passwordConfirmError" class="invalid-feedback">
                                    {{ __('auth.validation.password_confirmed') }}
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const registerForm = document.getElementById("kt_sign_up_form");
                                    const nameInput = document.getElementById("name");
                                    const emailInput = document.getElementById("email");
                                    const emailError = document.getElementById("emailError");
                                    const passwordInput = document.getElementById("password");
                                    const passwordConfirmationInput = document.getElementById("password_confirmation");
                                    const passwordConfirmError = document.getElementById("passwordConfirmError");
                                    const passwordStrengthError = document.getElementById("passwordStrengthError");
                                    const passwordRuleUppercase = document.getElementById("passwordRuleUppercase");
                                    const passwordRuleNumber = document.getElementById("passwordRuleNumber");
                                    const passwordRuleSymbol = document.getElementById("passwordRuleSymbol");
                                    const passwordRuleLength = document.getElementById("passwordRuleLength");

                                    function toTitleCaseName(value) {
                                        return value
                                            .toLowerCase()
                                            .replace(/\s+/g, " ")
                                            .trimStart()
                                            .replace(/\b\w/g, function(char) {
                                                return char.toUpperCase();
                                            });
                                    }

                                    function formatNameField() {
                                        const cursorPos = nameInput.selectionStart;
                                        const originalValue = nameInput.value;
                                        const formattedValue = toTitleCaseName(originalValue);
                                        nameInput.value = formattedValue;

                                        if (cursorPos !== null) {
                                            nameInput.setSelectionRange(cursorPos, cursorPos);
                                        }
                                    }

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

                                    function setPasswordRuleState(ruleElement, isValid) {
                                        const icon = ruleElement.querySelector("i");
                                        ruleElement.classList.toggle("text-success", isValid);
                                        ruleElement.classList.toggle("text-muted", !isValid);
                                        icon.classList.toggle("bi-check-circle-fill", isValid);
                                        icon.classList.toggle("bi-circle", !isValid);
                                    }

                                    function updatePasswordChecklist() {
                                        const value = passwordInput.value;
                                        const hasUppercase = /[A-Z]/.test(value);
                                        const hasNumber = /\d/.test(value);
                                        const hasSymbol = /[^A-Za-z0-9]/.test(value);
                                        const hasLength = value.length > 8;

                                        setPasswordRuleState(passwordRuleUppercase, hasUppercase);
                                        setPasswordRuleState(passwordRuleNumber, hasNumber);
                                        setPasswordRuleState(passwordRuleSymbol, hasSymbol);
                                        setPasswordRuleState(passwordRuleLength, hasLength);

                                        return hasUppercase && hasNumber && hasSymbol && hasLength;
                                    }

                                    function validatePasswordStrengthField() {
                                        const hasValue = passwordInput.value.length > 0;
                                        const isStrong = updatePasswordChecklist();

                                        if (hasValue && !isStrong) {
                                            passwordInput.classList.add("is-invalid");
                                            passwordStrengthError.style.display = "block";
                                            return false;
                                        }

                                        passwordInput.classList.remove("is-invalid");
                                        passwordStrengthError.style.display = "none";
                                        return true;
                                    }

                                    function validatePasswordConfirmationField() {
                                        const hasValue = passwordConfirmationInput.value.length > 0;
                                        const isSame = passwordInput.value === passwordConfirmationInput.value;

                                        if (hasValue && !isSame) {
                                            passwordConfirmationInput.classList.add("is-invalid");
                                            passwordConfirmError.textContent = @json(__('auth.validation.password_confirmed'));
                                            passwordConfirmError.style.display = "block";
                                            return false;
                                        }

                                        passwordConfirmationInput.classList.remove("is-invalid");
                                        passwordConfirmError.style.display = "none";
                                        return true;
                                    }

                                    nameInput.addEventListener("input", formatNameField);
                                    nameInput.addEventListener("blur", formatNameField);
                                    emailInput.addEventListener("input", validateEmailField);
                                    emailInput.addEventListener("blur", validateEmailField);
                                    passwordInput.addEventListener("input", function() {
                                        validatePasswordStrengthField();
                                        validatePasswordConfirmationField();
                                    });
                                    passwordInput.addEventListener("blur", validatePasswordStrengthField);
                                    passwordConfirmationInput.addEventListener("input", validatePasswordConfirmationField);
                                    passwordConfirmationInput.addEventListener("blur", validatePasswordConfirmationField);
                                    updatePasswordChecklist();

                                    registerForm.addEventListener("submit", function(e) {
                                        const isEmailValid = validateEmailField();
                                        const isPasswordStrong = validatePasswordStrengthField();
                                        const isPasswordConfirmationValid = validatePasswordConfirmationField();

                                        if (!isEmailValid || !isPasswordStrong || !isPasswordConfirmationValid) {
                                            e.preventDefault();
                                            if (!isEmailValid) {
                                                emailInput.focus();
                                            } else if (!isPasswordStrong) {
                                                passwordInput.focus();
                                            } else {
                                                passwordConfirmationInput.focus();
                                            }
                                        }
                                    });

                                    document.querySelectorAll(".toggle-password").forEach(function(toggleBtn) {
                                        toggleBtn.addEventListener("click", function() {
                                            const targetId = toggleBtn.getAttribute("data-target");
                                            const passwordInput = document.getElementById(targetId);
                                            const toggleIcon = toggleBtn.querySelector("i");
                                            const isPassword = passwordInput.getAttribute("type") === "password";

                                            passwordInput.setAttribute("type", isPassword ? "text" : "password");
                                            toggleIcon.classList.toggle("bi-eye", isPassword);
                                            toggleIcon.classList.toggle("bi-eye-slash", !isPassword);
                                        });
                                    });
                                });
                            </script>

                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ __('auth.submit_register') }}</span>
                                    <span class="indicator-progress">{{ __('auth.please_wait') }}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                            <div class="text-center text-gray-500 fw-semibold fs-6">
                                {{ __('auth.already_registered') }}
                                <a href="{{ route('login') }}" class="link-primary">{{ __('auth.title') }}</a>
                            </div>
                        </form>
                    </div>

                    @include('auth.partials._language-footer')
                </div>
            </div>
        </div>
    </div>
@endsection
