<x-filament-panels::page.simple>
    <style>
        /* លាក់ Header Logo / Heading ដើម */
        .fi-simple-header, 
        .fi-simple-header-heading, 
        .fi-logo {
            display: none !important;
        }

        /* Full Screen Background Sky Blue */
        html, body, .fi-simple-layout {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
            min-height: 100vh !important;
            width: 100vw !important;
            margin: 0 !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        /* Container Layout */
        .fi-simple-layout > div,
        .fi-simple-main-ctn,
        .fi-simple-main {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            max-width: 900px !important;
            width: 90% !important;
            margin: 0 auto !important;
        }

        /* Split Card Container */
        .lis-login-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background-color: #ffffff;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            min-height: 480px;
            width: 100%;
        }

        /* ផ្នែក Form ខាងឆ្វេង */
        .lis-login-left {
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        /* ផ្នែក Banner ខាងស្តាំ */
        .lis-login-right {
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #ffffff;
        }

        .lis-login-right h1 {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 0.75rem;
        }

        .lis-login-right p {
            font-size: 1rem;
            opacity: 0.95;
            line-height: 1.5;
        }

        /* Reset Form Inputs ឱ្យធម្មតាវិញស្អាត */
        .fi-input-wrp {
            border: 1.5px solid #0284c7 !important;
            border-radius: 0.5rem !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
        }

        .fi-input-wrp input {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }

        .fi-fo-field-wrp-label label span {
            color: #0284c7 !important;
            font-weight: 600 !important;
        }

        /* Button Sign in */
        .fi-btn-primary, button[type="submit"] {
            background: #0284c7 !important;
            border-radius: 0.5rem !important;
            font-weight: 700 !important;
            padding-top: 0.65rem !important;
            padding-bottom: 0.65rem !important;
            width: 100% !important;
            color: #ffffff !important;
            border: none !important;
            transition: all 0.2s ease !important;
        }

        .fi-btn-primary:hover, button[type="submit"]:hover {
            background: #0369a1 !important;
        }

        @media (max-width: 768px) {
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
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <!-- ប្រើរូប lis.png ដើម ឬ lis-2.png -->
                <img src="{{ asset('images/lis-2.png') }}" alt="LIS Logo" style="max-height: 4.5rem; max-width: 100%; margin: 0 auto; object-fit: contain;">
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
            <p style="font-size: 0.875rem; margin-top: 1rem; opacity: 0.85;">
                Manage admissions, academics, and website content seamlessly.
            </p>
        </div>
    </div>
</x-filament-panels::page.simple>