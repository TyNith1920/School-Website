<x-filament-panels::page.simple>
    <style>
        body, .fi-simple-layout {
            background: #8b2fc9 !important;
            background: radial-gradient(circle at 50% 50%, #b862fe 0%, #8b2fc9 60%, #581c87 100%) !important;
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
        }

        .fi-simple-main {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            max-width: 900px !important;
            width: 100% !important;
        }

        .lis-login-card {
            display: grid;
            grid-template-columns: 380px 1fr;
            background-color: #ffffff;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
            min-height: 520px;
            width: 100%;
        }

        .lis-login-left {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        .lis-login-right {
            background: linear-gradient(135deg, #7e22ce 0%, #3b0764 50%, #1e1b4b 100%);
            background-image: 
                radial-gradient(at 80% 20%, rgba(236, 72, 153, 0.6) 0px, transparent 50%),
                radial-gradient(at 20% 80%, rgba(56, 189, 248, 0.5) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(147, 51, 234, 0.7) 0px, transparent 50%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #ffffff;
            position: relative;
        }

        .lis-login-right h1 {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1rem;
            text-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .lis-login-right p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.5;
        }

        .fi-input-wrp {
            background-color: #ffffff !important;
            border: 1.5px solid #ec4899 !important;
            border-radius: 9999px !important;
            box-shadow: none !important;
            padding: 0.2rem 0.5rem !important;
        }
        .fi-input-wrp input {
            color: #1e293b !important;
        }
        .fi-input-wrp:focus-within {
            border-color: #d946ef !important;
            box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.2) !important;
        }

        .fi-btn-primary, button[type="submit"] {
            background: linear-gradient(90deg, #ec4899 0%, #d946ef 100%) !important;
            border-radius: 9999px !important;
            font-weight: 700 !important;
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            width: 100% !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(236, 72, 153, 0.5) !important;
            border: none !important;
            transition: all 0.3s ease !important;
        }
        .fi-btn-primary:hover, button[type="submit"]:hover {
            opacity: 0.95 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 15px 25px -5px rgba(236, 72, 153, 0.7) !important;
        }

        .fi-fo-field-wrp-label label span {
            color: #ec4899 !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            text-transform: uppercase !important;
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
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <img src="{{ asset('images/lis.png') }}" alt="LIS Logo" style="height: 4rem; margin: 0 auto;">
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
            <p style="font-size: 0.9rem; margin-top: 1rem; opacity: 0.75;">
                Manage admissions, academics, and website content seamlessly.
            </p>
        </div>
    </div>
</x-filament-panels::page.simple>