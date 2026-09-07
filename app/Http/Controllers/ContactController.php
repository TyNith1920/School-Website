<?php

namespace App\Http\Controllers;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact-us');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
            ],

            'email' => [
                'nullable',
                'email:rfc,dns',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (blank($value)) {
                        return;
                    }

                    $email = strtolower($value);

                    if (
                        ! str_ends_with($email, '@gmail.com') &&
                        ! str_ends_with($email, '.kh')
                    ) {
                        $fail(
                            'សូមបញ្ចូល Email ដែលមានកន្ទុយ @gmail.com ឬបញ្ចប់ដោយ .kh ប៉ុណ្ណោះ។'
                        );
                    }
                },
            ],
        ]);

        // រក្សាទុក Contact
        $contact = Contact::create($validated);

        // ផ្ញើ Notification ទៅ Admin ទាំងអស់
        foreach (User::all() as $admin) {
            Notification::make()
                ->title('មានសារថ្មីពីអតិថិជន')
                ->body(
                    "ឈ្មោះ: {$contact->name} | ទូរស័ព្ទ: {$contact->phone}"
                )
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->iconColor('success')
                ->actions([
                    Action::make('view')
                        ->label('View')
                        ->icon('heroicon-o-eye')
                        ->button()
                        ->url(
                            ContactResource::getUrl(
                                'edit',
                                ['record' => $contact],
                                isAbsolute: false,
                            )
                        )
                        ->markAsRead(),
                ])
                ->sendToDatabase($admin);
        }

        return back()->with(
            'success',
            'Your message has been sent successfully! We\'ll get back to you shortly.'
        );
    }
}