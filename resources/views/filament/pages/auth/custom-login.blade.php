<x-filament-panels::page.simple>

    <style>
        /* =========================================================
           LIS ADMIN LOGIN — MODERN PREMIUM DESIGN
        ========================================================= */

        /* ---------------------------------------------------------
           1. HIDE DEFAULT FILAMENT HEADER
        --------------------------------------------------------- */
        .fi-simple-header,
        .fi-simple-header-heading,
        .fi-logo {
            display: none !important;
        }


        /* ---------------------------------------------------------
           2. FULL PAGE BACKGROUND
        --------------------------------------------------------- */
        html,
        body,
        .fi-simple-layout {
            width: 100% !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .fi-simple-layout {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;

            overflow: hidden !important;

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(125, 211, 252, 0.45),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 85% 80%,
                    rgba(14, 165, 233, 0.45),
                    transparent 40%
                ),
                linear-gradient(
                    135deg,
                    #075985 0%,
                    #0284c7 45%,
                    #38bdf8 100%
                ) !important;
        }


        /* ---------------------------------------------------------
           3. BACKGROUND LIGHT EFFECTS
        --------------------------------------------------------- */

        .fi-simple-layout::before {
            content: "";
            position: absolute;

            width: 500px;
            height: 500px;

            border-radius: 50%;

            background: rgba(255,255,255,0.08);

            filter: blur(5px);

            top: -180px;
            left: -150px;

            pointer-events: none;
        }

        .fi-simple-layout::after {
            content: "";

            position: absolute;

            width: 600px;
            height: 600px;

            border-radius: 50%;

            background: rgba(255,255,255,0.06);

            filter: blur(10px);

            bottom: -280px;
            right: -180px;

            pointer-events: none;
        }


        /* ---------------------------------------------------------
           4. FILAMENT CONTAINER RESET
        --------------------------------------------------------- */

        .fi-simple-layout > div,
        .fi-simple-main-ctn,
        .fi-simple-main {

            width: 100% !important;

            max-width: none !important;

            min-height: 100vh !important;

            padding: 0 !important;

            margin: 0 !important;

            background: transparent !important;

            box-shadow: none !important;

            border: none !important;

            display: flex !important;

            align-items: center !important;

            justify-content: center !important;
        }


        /* ---------------------------------------------------------
           5. LOGIN CARD
        --------------------------------------------------------- */

        .lis-login-card {

            position: relative;

            z-index: 5;

            display: grid;

            grid-template-columns: 1.05fr 0.95fr;

            width: min(1120px, 92vw);

            min-height: 650px;

            overflow: hidden;

            border-radius: 32px;

            background: rgba(255,255,255,0.96);

            border: 1px solid rgba(255,255,255,0.8);

            box-shadow:
                0 35px 80px rgba(2, 80, 120, 0.30),
                0 10px 30px rgba(0,0,0,0.08);

            backdrop-filter: blur(20px);

            animation: lisCardEnter 0.7s ease-out;
        }


        @keyframes lisCardEnter {

            from {
                opacity: 0;
                transform: translateY(25px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

        }


        /* =========================================================
           LEFT SIDE
        ========================================================= */

        .lis-login-left {

            position: relative;

            display: flex;

            flex-direction: column;

            justify-content: center;

            padding: 4rem 4.5rem;

            background:
                linear-gradient(
                    180deg,
                    #ffffff 0%,
                    #f8fcff 100%
                );
        }


        /* Small decorative line */

        .lis-login-left::before {

            content: "";

            position: absolute;

            width: 80px;
            height: 5px;

            top: 0;
            left: 4.5rem;

            border-radius: 999px;

            background:
                linear-gradient(
                    90deg,
                    #38bdf8,
                    #0284c7
                );
        }


        /* ---------------------------------------------------------
           LOGO
        --------------------------------------------------------- */

        .lis-logo-wrapper {

            text-align: center;

            margin-bottom: 2.8rem;
        }


        .lis-logo {

            height: 95px;

            max-width: 100%;

            width: auto;

            object-fit: contain;

            display: block;

            margin: 0 auto;

            filter:
                drop-shadow(
                    0 8px 12px
                    rgba(2,132,199,0.12)
                );

            transition: transform 0.3s ease;
        }


        .lis-logo:hover {

            transform: scale(1.03);
        }


        /* ---------------------------------------------------------
           FORM
        --------------------------------------------------------- */

        .lis-login-left form {

            width: 100%;
        }


        /* ---------------------------------------------------------
           FORM FIELD SPACING
        --------------------------------------------------------- */

        .fi-fo-field-wrp {

            position: relative !important;

            margin-top: 1.6rem !important;
        }


        /* ---------------------------------------------------------
           LABEL
        --------------------------------------------------------- */

        .fi-fo-field-wrp-label {

            position: absolute !important;

            top: -0.62rem !important;

            left: 1.35rem !important;

            z-index: 20 !important;

            padding: 0 0.5rem !important;

            margin: 0 !important;

            background: #ffffff !important;
        }


        .fi-fo-field-wrp-label label {

            margin: 0 !important;
        }


        .fi-fo-field-wrp-label label span {

            color: #0369a1 !important;

            font-size: 0.72rem !important;

            font-weight: 800 !important;

            letter-spacing: 0.08em !important;

            text-transform: uppercase !important;
        }


        /* ---------------------------------------------------------
           INPUT
        --------------------------------------------------------- */

        .fi-input-wrp {

            min-height: 58px !important;

            padding: 0.35rem 1rem !important;

            border: 1.8px solid #bae6fd !important;

            border-radius: 16px !important;

            background: #ffffff !important;

            box-shadow:
                0 4px 12px rgba(14,165,233,0.04) !important;

            transition:
                border-color 0.25s ease,
                box-shadow 0.25s ease,
                transform 0.25s ease !important;
        }


        .fi-input-wrp > div,
        .fi-input-wrp input {

            background: transparent !important;
        }


        .fi-input-wrp input {

            color: #0f172a !important;

            font-size: 0.95rem !important;

            font-weight: 500 !important;
        }


        .fi-input-wrp input::placeholder {

            color: #94a3b8 !important;
        }


        /* Focus */

        .fi-input-wrp:focus-within {

            border-color: #0ea5e9 !important;

            box-shadow:
                0 0 0 4px rgba(14,165,233,0.12),
                0 8px 20px rgba(14,165,233,0.08)
                !important;

            transform: translateY(-1px);
        }


        /* ---------------------------------------------------------
           PASSWORD EYE
        --------------------------------------------------------- */

        .fi-input-wrp button {

            color: #64748b !important;

            transition: color 0.2s ease !important;
        }

        .fi-input-wrp button:hover {

            color: #0284c7 !important;
        }


        /* ---------------------------------------------------------
           CHECKBOX
        --------------------------------------------------------- */

        .fi-checkbox-input {

            border-color: #bae6fd !important;
        }


        /* ---------------------------------------------------------
           FORM ACTION AREA
        --------------------------------------------------------- */

        .fi-fo-actions {

            margin-top: 2rem !important;
        }


        /* ---------------------------------------------------------
           SIGN IN BUTTON
        --------------------------------------------------------- */

        .fi-btn-primary,
        button[type="submit"] {

            width: 100% !important;

            min-height: 56px !important;

            border: none !important;

            border-radius: 16px !important;

            color: #ffffff !important;

            font-size: 0.95rem !important;

            font-weight: 800 !important;

            letter-spacing: 0.02em !important;

            background:
                linear-gradient(
                    135deg,
                    #38bdf8 0%,
                    #0ea5e9 45%,
                    #0284c7 100%
                ) !important;

            box-shadow:
                0 12px 25px
                rgba(2,132,199,0.30) !important;

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                filter 0.25s ease !important;
        }


        .fi-btn-primary:hover,
        button[type="submit"]:hover {

            transform: translateY(-2px) !important;

            filter: brightness(1.04);

            box-shadow:
                0 18px 30px
                rgba(2,132,199,0.38) !important;
        }


        .fi-btn-primary:active,
        button[type="submit"]:active {

            transform: translateY(0) !important;
        }


        /* =========================================================
           RIGHT SIDE
        ========================================================= */

        .lis-login-right {

            position: relative;

            overflow: hidden;

            display: flex;

            flex-direction: column;

            justify-content: center;

            padding: 4.5rem;

            color: #ffffff;

            background:
                linear-gradient(
                    145deg,
                    #0369a1 0%,
                    #0284c7 45%,
                    #0ea5e9 100%
                );
        }


        /* ---------------------------------------------------------
           Decorative circles
        --------------------------------------------------------- */

        .lis-login-right::before {

            content: "";

            position: absolute;

            width: 420px;
            height: 420px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,0.22) 0%,
                    rgba(255,255,255,0.04) 50%,
                    transparent 70%
                );

            top: -180px;
            right: -150px;
        }


        .lis-login-right::after {

            content: "";

            position: absolute;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,0.15),
                    transparent 68%
                );

            bottom: -160px;
            left: -130px;
        }


        /* ---------------------------------------------------------
           RIGHT CONTENT
        --------------------------------------------------------- */

        .lis-welcome-content {

            position: relative;

            z-index: 2;

            max-width: 420px;
        }


        .lis-welcome-badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 8px 14px;

            margin-bottom: 1.5rem;

            border-radius: 999px;

            background: rgba(255,255,255,0.14);

            border: 1px solid rgba(255,255,255,0.20);

            backdrop-filter: blur(10px);

            font-size: 0.75rem;

            font-weight: 700;

            letter-spacing: 0.08em;

            text-transform: uppercase;
        }


        .lis-welcome-dot {

            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: #ffffff;

            box-shadow:
                0 0 12px
                rgba(255,255,255,0.8);
        }


        .lis-login-right h1 {

            margin: 0 0 1rem 0;

            font-size: clamp(3rem, 5vw, 4.3rem);

            line-height: 0.95;

            font-weight: 900;

            letter-spacing: -0.05em;

            text-shadow:
                0 10px 30px
                rgba(0,0,0,0.15);
        }


        .lis-school-name {

            margin: 0;

            font-size: 1.2rem;

            line-height: 1.5;

            font-weight: 700;
        }


        .lis-portal-name {

            margin-top: 4px;

            font-size: 0.95rem;

            font-weight: 500;

            opacity: 0.82;
        }


        .lis-description {

            margin-top: 2rem;

            max-width: 360px;

            font-size: 0.95rem;

            line-height: 1.7;

            opacity: 0.86;
        }


        /* ---------------------------------------------------------
           FEATURES
        --------------------------------------------------------- */

        .lis-features {

            display: flex;

            flex-direction: column;

            gap: 12px;

            margin-top: 2.2rem;
        }


        .lis-feature {

            display: flex;

            align-items: center;

            gap: 12px;

            font-size: 0.85rem;

            font-weight: 500;

            opacity: 0.9;
        }


        .lis-feature-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 34px;
            height: 34px;

            flex-shrink: 0;

            border-radius: 10px;

            background: rgba(255,255,255,0.14);

            border: 1px solid
                rgba(255,255,255,0.16);

            backdrop-filter: blur(8px);
        }


        /* ---------------------------------------------------------
           FOOTER
        --------------------------------------------------------- */

        .lis-login-footer {

            position: absolute;

            bottom: 2rem;

            left: 4.5rem;

            right: 4.5rem;

            z-index: 2;

            padding-top: 1rem;

            border-top:
                1px solid
                rgba(255,255,255,0.16);

            font-size: 0.72rem;

            opacity: 0.65;
        }


        /* =========================================================
           RESPONSIVE — TABLET
        ========================================================= */

        @media (max-width: 950px) {

            .lis-login-card {

                width: min(850px, 94vw);

                grid-template-columns: 1fr;

                min-height: auto;
            }


            .lis-login-right {

                display: none;
            }


            .lis-login-left {

                padding: 4rem 3rem;
            }


            .lis-login-left::before {

                left: 3rem;
            }
        }


        /* =========================================================
           RESPONSIVE — MOBILE
        ========================================================= */

        @media (max-width: 600px) {

            .fi-simple-layout {

                padding: 20px !important;
            }


            .lis-login-card {

                width: 100%;

                border-radius: 24px;

                min-height: auto;
            }


            .lis-login-left {

                padding: 2.5rem 1.5rem;
            }


            .lis-login-left::before {

                left: 1.5rem;

                width: 60px;
            }


            .lis-logo-wrapper {

                margin-bottom: 2rem;
            }


            .lis-logo {

                height: 75px;
            }


            .fi-input-wrp {

                min-height: 54px !important;

                border-radius: 14px !important;
            }


            .fi-btn-primary,
            button[type="submit"] {

                min-height: 54px !important;

                border-radius: 14px !important;
            }
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 400px) {

            .lis-login-left {

                padding: 2rem 1.2rem;
            }


            .lis-logo {

                height: 65px;
            }
        }


        /* =========================================================
           REDUCE MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                animation-duration: 0.01ms !important;

                animation-iteration-count: 1 !important;

                transition-duration: 0.01ms !important;
            }
        }

    </style>


    <!-- =========================================================
         LOGIN CARD
    ========================================================= -->

    <div class="lis-login-card">


        <!-- =====================================================
             LEFT — LOGIN FORM
        ====================================================== -->

        <div class="lis-login-left">

            <div class="lis-logo-wrapper">

                <img
                    src="{{ asset('images/lis-2.png') }}"
                    alt="Life International School"
                    class="lis-logo"
                >

            </div>


            <x-filament-panels::form wire:submit="authenticate">

                {{ $this->form }}


                <x-filament-panels::form.actions
                    :actions="$this->getCachedFormActions()"
                    :full-width="$this->hasFullWidthFormActions()"
                />

            </x-filament-panels::form>

        </div>



        <!-- =====================================================
             RIGHT — WELCOME PANEL
        ====================================================== -->

        <div class="lis-login-right">

            <div class="lis-welcome-content">


                <!-- Badge -->

                <div class="lis-welcome-badge">

                    <span class="lis-welcome-dot"></span>

                    Secure Admin Portal

                </div>


                <!-- Heading -->

                <h1>
                    Welcome.
                </h1>


                <!-- School -->

                <p class="lis-school-name">
                    Life International School
                </p>

                <p class="lis-portal-name">
                    Administration Portal
                </p>


                <!-- Description -->

                <p class="lis-description">

                    Manage admissions, academics,
                    students, staff, and website content
                    from one secure platform.

                </p>


                <!-- Features -->

                <div class="lis-features">

                    <div class="lis-feature">

                        <span class="lis-feature-icon">
                            ✓
                        </span>

                        Secure administration

                    </div>


                    <div class="lis-feature">

                        <span class="lis-feature-icon">
                            ✓
                        </span>

                        Manage school content

                    </div>


                    <div class="lis-feature">

                        <span class="lis-feature-icon">
                            ✓
                        </span>

                        Simple &amp; efficient workflow

                    </div>

                </div>

            </div>


            <!-- Footer -->

            <div class="lis-login-footer">

                © {{ date('Y') }} Life International School.
                All rights reserved.

            </div>

        </div>

    </div>

</x-filament-panels::page.simple>