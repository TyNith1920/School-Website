<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Contact;
use App\Models\Banner;
use App\Models\Career;
use App\Models\EnrollmentPage; 

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Contacts', Contact::count())
                ->description('New messages received')
                ->descriptionIcon('heroicon-m-envelope-open')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Active Banners', Banner::count())
                ->description('Displayed on website')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info')
                ->chart([2, 3, 2, 4, 3, 5, 4]),

            Stat::make('Job Openings', Career::count())
                ->description('Available positions')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning')
                ->chart([1, 2, 1, 3, 2, 4, 2]),

            // 📍 បានប្តូរឈ្មោះ និង Icon ដើម្បីបញ្ជាក់ថាវាជាទំព័រ Setting
            Stat::make('Enrollment Setting', EnrollmentPage::count())
                ->description('Manage PDF form & content')
                ->descriptionIcon('heroicon-m-cog-6-tooth') // ប្រើរូបកងចក្របញ្ជាក់ពីការកំណត់
                ->color('primary')
                ->chart([1, 1, 1, 2, 2, 2, 2]),
        ];
    }
}