<x-filament-panels::page.simple>

    <style>
        /* =========================================================
           LIFE INTERNATIONAL SCHOOL
           ADMIN LOGIN - FULL CUSTOM DESIGN
        ========================================================= */

        /* 1. RESET FILAMENT DEFAULT LAYOUT */
        html,
        body,
        .fi-simple-layout {
            width: 100% !important;
            min-width: 100% !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden !important;
        }

        .fi-simple-layout {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(125, 211, 252, 0.35),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(56, 189, 248, 0.30),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #075985 0%,
                    #0284c7 45%,
                    #38bdf8 100%
                ) !important;
        }

        /* Hide default Filament header */
        .fi-simple-header,
        .fi-simple-header-heading,
        .fi-logo {
            display: none !important;
        }

        /* Remove Filament container */
        .fi-simple-layout > div,
        .fi-simple-main-ctn,
        .fi-simple-main {
            width: 100% !important;
            max-width: none !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* 2. BACKGROUND DECORATION */
        .fi-simple-layout::before {
            content: "";
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            top: -230px;
            left: -180px;
            background: rgba(255,255,255,0.08);
            filter: blur(5px);
            pointer-events: none;
        }

        .fi-simple-layout::after {
            content: "";
            position: fixed;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            bottom: -350px;
            right: -250px;
            background: rgba(255,255,255,0.08);
            filter: blur(5px);
            pointer-events: none;
        }

        /* 3. LOGIN CARD */
        .lis-login-card {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            width: min(1180px, 92vw) !important;
            min-height: 650px !important;
            overflow: hidden;
            border-radius: 30px;
            background: #ffffff !important;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow:
                0 35px 80px rgba(2, 80, 120, 0.30),
                0 10px 30px rgba(0,0,0,0.08);
        }

        /* 4. LEFT LOGIN SIDE */
        .lis-login-left {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 4.5rem;
            background: #ffffff !important;
            color: #0f172a !important;
        }

        .lis-login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 4.5rem;
            width: 80px;
            height: 5px;
            border-radius: 0 0 10px 10px;
            background: linear-gradient(90deg, #38bdf8, #0284c7);
        }

        /* 5. LOGO */
        .lis-logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 120px;
            margin-bottom: 2rem;
            background: transparent !important;
        }

        .lis-logo {
            display: block;
            width: auto !important;
            height: 105px !important;
            max-width: 90% !important;
            object-fit: contain !important;
            margin: 0 auto;
            background: transparent !important;
        }

        /* 6. FORM */
        .lis-login-left form {
            width: 100% !important;
            max-width: 100% !important;
        }

        .lis-login-left .fi-fo-field-wrp {
            position: relative !important;
            margin-top: 1.7rem !important;
            color: #0f172a !important;
        }

        /* 7. FIELD LABELS (FLOATING LABELS FIX) */
        .lis-login-left .fi-fo-field-wrp-label {
            position: absolute !important;
            top: -10px !important;
            left: 18px !important;
            z-index: 999 !important;
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
            width: auto !important;
            height: auto !important;
            padding: 0 6px !important;
            margin: 0 !important;
            background: #ffffff !important;
            pointer-events: none;
        }

        .lis-login-left .fi-fo-field-wrp-label label,
        .lis-login-left .fi-fo-field-wrp-label label *,
        .lis-login-left .fi-fo-field-wrp-label span {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            color: #0369a1 !important;
            background: #ffffff !important;
            font-size: 0.72rem !important;
            font-weight: 800 !important;
            line-height: 1 !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
        }

        .lis-login-left .fi-fo-field-wrp-label .fi-fo-field-wrp-required-indicator,
        .lis-login-left .fi-fo-field-wrp-label [class*="text-danger"] {
            color: #ef4444 !important;
            font-size: 0.85rem !important;
            font-weight: 800 !important;
        }

        /* 8. INPUT WRAPPER & ICONS */
        .lis-login-left .fi-input-wrp {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
            min-height: 58px !important;
            padding: 0 1rem !important;
            border: 2px solid #bae6fd !important;
            border-radius: 16px !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .lis-login-left .fi-input-wrp .fi-input-prefix,
        .lis-login-left .fi-input-wrp .fi-input-suffix {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #0284c7 !important;
        }

        .lis-login-left .fi-input-wrp .fi-input-prefix svg {
            width: 22px !important;
            height: 22px !important;
            color: #0284c7 !important;
        }

        /* 9. ACTUAL INPUT FIELD */
        .lis-login-left .fi-input-wrp input {
            width: 100% !important;
            height: 48px !important;
            min-height: 48px !important;
            padding: 0 0.5rem !important;
            border: none !important;
            outline: none !important;
            background-color: transparent !important;
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important;
            font-size: 0.95rem !important;
            font-weight: 600 !important;
            box-shadow: none !important;
        }

        .lis-login-left .fi-input-wrp input::placeholder {
            color: #94a3b8 !important;
            -webkit-text-fill-color: #94a3b8 !important;
            opacity: 1 !important;
        }

        /* 10. FIX AUTOFILL GREY BACKGROUND */
        .lis-login-left input:-webkit-autofill,
        .lis-login-left input:-webkit-autofill:hover,
        .lis-login-left input:-webkit-autofill:focus,
        .lis-login-left input:-webkit-autofill:active {
            -webkit-text-fill-color: #0f172a !important;
            caret-color: #0f172a !important;
            -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
            box-shadow: 0 0 0px 1000px #ffffff inset !important;
            transition: background-color 50000s ease-in-out 0s !important;
            background-color: #ffffff !important;
        }

        /* 11. FORCE HIDE DUPLICATE EYE ICONS & EXTRA BUTTONS */
        .lis-login-left input::-ms-reveal,
        .lis-login-left input::-ms-clear,
        .lis-login-left input::-webkit-contacts-auto-fill-button,
        .lis-login-left input::-webkit-credentials-auto-fill-button {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        .lis-login-left .fi-input-wrp .fi-input-suffix {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .lis-login-left .fi-input-wrp .fi-input-suffix button ~ button,
        .lis-login-left .fi-input-wrp .fi-input-suffix button ~ svg,
        .lis-login-left .fi-input-wrp .fi-input-suffix svg ~ svg,
        .lis-login-left .fi-input-wrp .fi-input-suffix .fi-icon-btn ~ .fi-icon-btn {
            display: none !important;
        }

        .lis-login-left .fi-input-wrp .fi-input-suffix button,
        .lis-login-left .fi-input-wrp .fi-input-suffix .fi-icon-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            color: #64748b !important;
            cursor: pointer !important;
            padding: 2px !important;
        }

        .lis-login-left .fi-input-wrp .fi-input-suffix button:hover {
            color: #0284c7 !important;
        }

        /* 12. CHECKBOX (REMEMBER ME CLICKABLE FIX) */
        .lis-login-left .fi-fo-checkbox-wrp,
        .lis-login-left .fi-checkbox-label,
        .lis-login-left label[for*="remember"] {
            pointer-events: auto !important;
            cursor: pointer !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
        }

        .lis-login-left input[type="checkbox"],
        .lis-login-left .fi-checkbox-input {
            appearance: checkbox !important;
            -webkit-appearance: checkbox !important;
            width: 18px !important;
            height: 18px !important;
            min-width: 18px !important;
            min-height: 18px !important;
            accent-color: #0ea5e9 !important;
            cursor: pointer !important;
            opacity: 1 !important;
            visibility: visible !important;
            position: relative !important;
            z-index: 10 !important;
            pointer-events: auto !important;
        }

        .lis-login-left .fi-checkbox-label span,
        .lis-login-left label[for*="remember"] span {
            color: #0369a1 !important;
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
            cursor: pointer !important;
            user-select: none !important;
            pointer-events: auto !important;
        }

        /* 13. FORM ACTION & BUTTON */
        .lis-login-left .fi-fo-actions {
            width: 100% !important;
            margin-top: 2rem !important;
        }

        .lis-login-left .fi-btn-primary,
        .lis-login-left button[type="submit"] {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            min-height: 58px !important;
            padding: 0 1.5rem !important;
            border: none !important;
            border-radius: 16px !important;
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 45%, #0284c7 100%) !important;
            color: #ffffff !important;
            font-size: 0.95rem !important;
            font-weight: 800 !important;
            box-shadow: 0 12px 25px rgba(2,132,199,0.30) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease !important;
        }

        .lis-login-left .fi-btn-primary:hover,
        .lis-login-left button[type="submit"]:hover {
            transform: translateY(-2px) !important;
            filter: brightness(1.05) !important;
            box-shadow: 0 18px 32px rgba(2,132,199,0.40) !important;
        }

        .lis-login-left .fi-btn-primary:active,
        .lis-login-left button[type="submit"]:active {
            transform: translateY(0) !important;
        }

        /* 14. RIGHT SIDE */
        .lis-login-right {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4.5rem !important;
            color: #ffffff !important;
            background: linear-gradient(145deg, #0369a1 0%, #0284c7 50%, #0ea5e9 100%) !important;
        }

        .lis-login-right::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            top: -230px;
            right: -180px;
            background: radial-gradient(circle, rgba(255,255,255,0.22), rgba(255,255,255,0.03), transparent 70%);
        }

        .lis-login-right::after {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            bottom: -220px;
            left: -170px;
            background: radial-gradient(circle, rgba(255,255,255,0.15), transparent 70%);
        }

        .lis-welcome-content {
            position: relative;
            z-index: 5;
            max-width: 430px;
        }

        .lis-welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255,255,255,0.20);
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .lis-welcome-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ffffff;
            box-shadow: 0 0 12px rgba(255,255,255,0.8);
        }

        .lis-login-right h1 {
            margin: 0 0 1rem 0;
            color: #ffffff !important;
            font-size: clamp(3rem, 5vw, 4.4rem);
            line-height: 0.95;
            font-weight: 900;
            letter-spacing: -0.05em;
            text-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .lis-school-name {
            margin: 0;
            color: #ffffff !important;
            font-size: 1.15rem;
            font-weight: 800;
        }

        .lis-portal-name {
            margin-top: 5px;
            color: #ffffff !important;
            font-size: 0.92rem;
            opacity: 0.82;
        }

        .lis-description {
            margin-top: 2rem;
            max-width: 380px;
            color: #ffffff !important;
            font-size: 0.94rem;
            line-height: 1.7;
            opacity: 0.88;
        }

        .lis-features {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 2rem;
        }

        .lis-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff !important;
            font-size: 0.84rem;
            font-weight: 500;
        }

        .lis-feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 10px;
            background: rgba(255,255,255,0.12);
            color: #ffffff !important;
        }

        .lis-login-footer {
            position: absolute;
            z-index: 5;
            bottom: 1.8rem;
            left: 4.5rem;
            right: 4.5rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.16);
            color: #ffffff !important;
            font-size: 0.7rem;
            opacity: 0.65;
        }

        @media (max-width: 950px) {
            .lis-login-card {
                grid-template-columns: 1fr !important;
                width: min(700px, 92vw) !important;
                min-height: auto !important;
            }
            .lis-login-right { display: none !important; }
            .lis-login-left { padding: 4rem !important; }
            .lis-login-left::before { left: 4rem; }
        }

        @media (max-width: 600px) {
            .fi-simple-layout { padding: 20px !important; }
            .lis-login-card { width: 100% !important; border-radius: 24px !important; }
            .lis-login-left { padding: 2.5rem 1.5rem !important; }
            .lis-login-left::before { left: 1.5rem; width: 60px; }
            .lis-logo { height: 80px !important; }
            .lis-logo-wrapper { min-height: 90px; margin-bottom: 1.5rem !important; }
            .lis-login-left .fi-input-wrp { min-height: 55px !important; border-radius: 14px !important; }
            .lis-login-left .fi-btn-primary, .lis-login-left button[type="submit"] { min-height: 55px !important; border-radius: 14px !important; }
        }

        @media (max-width: 400px) {
            .lis-login-left { padding: 2rem 1.15rem !important; }
            .lis-logo { height: 70px !important; }
        }
    </style>

    <!-- MAIN LOGIN CARD -->
    <div class="lis-login-card">

        <!-- LEFT SIDE — LOGIN FORM -->
        <div class="lis-login-left">

            <!-- LOGO -->
            <div class="lis-logo-wrapper">
                <img src="{{ asset('images/lis.png') }}" alt="Life International School" class="lis-logo">
            </div>

            <!-- LOGIN FORM -->
            <x-filament-panels::form wire:submit="authenticate">
                {{ $this->form }}

                <!-- FORM ACTION -->
                <x-filament-panels::form.actions
                    :actions="$this->getCachedFormActions()"
                    :full-width="$this->hasFullWidthFormActions()"
                />
            </x-filament-panels::form>

        </div>

        <!-- RIGHT SIDE — WELCOME -->
        <div class="lis-login-right">
            <div class="lis-welcome-content">
                <div class="lis-welcome-badge">
                    <span class="lis-welcome-dot"></span>
                    Secure Admin Portal
                </div>

                <h1>Welcome.</h1>

                <p class="lis-school-name">Life International School</p>
                <p class="lis-portal-name">Administration Portal</p>

                <p class="lis-description">
                    Manage admissions, academics, students, staff, and website content from one secure platform.
                </p>

                <div class="lis-features">
                    <div class="lis-feature">
                        <span class="lis-feature-icon">✓</span>
                        Secure administration
                    </div>
                    <div class="lis-feature">
                        <span class="lis-feature-icon">✓</span>
                        Manage school content
                    </div>
                    <div class="lis-feature">
                        <span class="lis-feature-icon">✓</span>
                        Simple &amp; efficient workflow
                    </div>
                </div>
            </div>

            <div class="lis-login-footer">
                © {{ date('Y') }} Life International School. All rights reserved.
            </div>
        </div>

    </div>

</x-filament-panels::page.simple>