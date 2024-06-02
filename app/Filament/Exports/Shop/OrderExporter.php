<?php

namespace App\Filament\Exports\Shop;

use App\Models\Shop\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('shop_customer_id'),
            ExportColumn::make('number'),
            ExportColumn::make('total_price'),
            ExportColumn::make('status')
                // ->state(function (Order $record) {
                //     dd($record->status->name);
                // }),
                ->state(function (Order $record): string {
                    return $record->status->name;
                }),
            ExportColumn::make('currency'),
            ExportColumn::make('shipping_price'),
            ExportColumn::make('shipping_method'),
            ExportColumn::make('notes'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('deleted_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
