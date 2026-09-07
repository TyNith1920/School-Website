<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Contact;
use Carbon\Carbon;

class ContactChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Contact Statistics (This Year)';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = [];
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M');
            
            $data[] = Contact::whereMonth('created_at', $i)
                           ->whereYear('created_at', date('Y'))
                           ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Messages Received',
                    'data' => $data,
                    'borderColor' => '#f59e0b', // ពណ៌លឿង Amber 
                    'backgroundColor' => 'rgba(245, 158, 11, 0.15)', // ពណ៌លាបពីក្រោមស្រាលស្អាត
                    'fill' => true, // បើកមុខងារលាបពណ៌ពីក្រោមបន្ទាត់ (Area Chart)
                    'tension' => 0.3, // ធ្វើឱ្យខ្សែកោងរលូនស្អាត (Smooth Curve)
                    'pointBackgroundColor' => '#f59e0b',
                    'pointBorderColor' => '#ffffff',
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}