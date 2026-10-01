<x-filament-panels::page.simple>
    <style>
        /* លាក់ Header Logo / Heading ដើម */
        .fi-simple-header, 
        .fi-simple-header-heading, 
        .fi-logo {
            display: none !important;
        }

        /* Background Sky Blue Gradient */
        html, body, .fi-simple-layout {
            background: radial-gradient(circle at 50% 50%, #38bdf8 0%, #0284c7 60%, #0369a1 100%) !important;
            min-height: 100vh !important;
            width: 100vw !important;
            margin: 0 !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        /* Parent Container Reset */
        .fi-simple-layout > div,
        .fi-simple-main-ctn,
        .fi-simple-main {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            max-width: 980px !important;
            width: 90% !important;
            margin: 0 auto !important;
        }

        /* Split Card Container */
        .lis-login-card {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            background-color: #ffffff;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(2, 132, 199, 0.4);
            min-height: 520px;
            width: 100%;
        }

        /* ផ្នែក Form ខាងឆ្វេង */
        .lis-login-left {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        /* ផ្នែក Banner Sky Blue ខាងស្តាំ */
        .lis-login-right {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #075985 100%);
            background-image: 
                radial-gradient(at 80% 20%, rgba(56, 189, 248, 0.7) 0px, transparent 50%),
                radial-gradient(at 20% 80%, rgba(14, 165, 233, 0.6) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(3, 105, 161, 0.8) 0px, transparent 50%);
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #ffffff;
        }

        .lis-login-right h1 {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1rem;
            text-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .lis-login-right p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.5;
        }

        /* កែរចនា Input Field */
        .fi-fo-field-wrp {
            position: relative !important;
            margin-top: 1.25rem !important;
        }

        /* រុញ Label ទៅលើបន្ទាត់ព្រំ (Box Outline Line) */
        .fi-fo-field-wrp-label {
            position: absolute !important;
            top: -0.65rem !important;
            left: 1.2rem !important;
            z-index: 10 !important;
            background-color: #ffffff !important;
            padding: 0 0.4rem !important;
            margin: 0 !important;
        }

        .fi-fo-field-wrp-label label span {
            color: #0284c7 !important;
            font-weight: 700 !important;
            font-size: 0.78rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
        }

        /* Input Container Box Line - បំបាត់ Background ប្រផេះដើម */
        .fi-input-wrp, 
        .fi-input-wrp > div, 
        .fi-input-wrp input {
            background-color: #ffffff !important;
        }

        .fi-input-wrp {
            border: 2px solid #38bdf8 !important;
            border-radius: 9999px !important;
            box-shadow: none !important;
            padding: 0.35rem 0.75rem !important;
            overflow: hidden !important;
        }

        .fi-input-wrp input {
            color: #0f172a !important;
        }

        /* ពេល Focus លើ Input */
        .fi-input-wrp:focus-within {
            border-color: #0284c7 !important;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.25) !important;
        }

        /* Button Sign in */
        .fi-btn-primary, button[type="submit"] {
            background: linear-gradient(90deg, #38bdf8 0%, #0284c7 100%) !important;
            border-radius: 9999px !important;
            font-weight: 700 !important;
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            width: 100% !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(2, 132, 199, 0.5) !important;
            border: none !important;
            transition: all 0.3s ease !important;
            margin-top: 0.5rem !important;
        }

        .fi-btn-primary:hover, button[type="submit"]:hover {
            opacity: 0.95 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 15px 25px -5px rgba(2, 132, 199, 0.7) !important;
        }

        @media (max-width: 820px) {
            .lis-login-card {
                grid-template-columns: 1fr;
            }
            .lis-login-right {
                display: none;
            }
        }
    </style>

    <div class="lis-login-card">
        <!-- Form Left Side -->
        <div class="lis-login-left">
            <div style="text-align: center; margin-bottom: 2rem;">
                <!-- បង្កើនទំហំ Logo ឱ្យធំច្បាស់ (height: 6rem) -->
                <img src="{{ asset('images/lis-2.png') }}" alt="LIS Logo" style="height: 6rem; max-width: 100%; width: auto; margin: 0 auto; object-fit: contain;">
            </div>

            <x-filament-panels::form wire:submit="authenticate">
                {{ $this->form }}

                <x-filament-panels::form.actions
                    :actions="$this->getCachedFormActions()"
                    :full-width="$this->hasFullWidthFormActions()"
                />
            </x-filament-panels::form>
        </div>

        <!-- Banner Right Side -->
        <div class="lis-login-right">
            <h1>Welcome.</h1>
            <p><strong>Life International School</strong><br>Admin Portal</p>
            <p style="font-size: 0.9rem; margin-top: 1rem; opacity: 0.85;">
                Manage admissions, academics, and website content seamlessly.
            </p>
        </div>
    </div>
</x-filament-panels::page.simple>