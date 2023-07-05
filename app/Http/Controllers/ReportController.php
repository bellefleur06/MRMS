<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Prenatal;
use App\Models\Immunization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function prenatalReport()
    {
        // Get the current year
        $current_year = Carbon::now()->year;

        // Create a collection of month names for the year
        $months = collect(range(1, 12))
            ->map(function ($month) {
                return Carbon::create()->month($month)->monthName;
            });

        // Query the prenatal records and select the month names and their counts
        $query = Prenatal::query()
            ->selectRaw('MONTHNAME(created_at) AS month, COUNT(*) AS count')
            ->whereYear('created_at', $current_year)
            ->groupBy('month')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        // Convert the query result into an associative array with month names as keys and counts as values
        $records_by_month = $query->pluck('count', 'month')->all();

        // Map the month names with their respective counts, setting a count of 0 for months without records
        $prenatal_records = $months->map(function ($month) use ($records_by_month) {
            return (object) [
                'month' => $month,
                'count' => $records_by_month[$month] ?? 0,
            ];
        });

        // Set the active variable for the view
        $active = 'prenatalReport';

        // Pass the active variable and prenatal records to the view and render it
        return view('admin.prenatalReport', compact('active', 'prenatal_records'));
    }

    public function vaccineReport() {

        $immunization_types = ['Hepa A', 'Hepa B', 'Influenza', 'Measles', 'Inactivated Poliovirus'];

        // Retrieve the immunization records with counts for the specified immunization types
        $immunization_records = Immunization::query()
            ->selectRaw('types.immunization_type, COUNT(immunization.id) as count')
            ->rightJoinSub(
                // Subquery to generate rows for the specified immunization types
                DB::query()
                    ->select(DB::raw('"' . implode('" AS immunization_type UNION SELECT "', $immunization_types) . '" AS immunization_type')),
                'types',
                'types.immunization_type',
                '=',
                'immunization.immunization_type'
            )
            ->whereIn('types.immunization_type', $immunization_types)
            ->groupBy('types.immunization_type')
            ->orderByRaw('FIELD(types.immunization_type, "' . implode('", "', $immunization_types) . '")')
            ->get();

        $immunization_records = $immunization_records->map(function ($record) {
            $record->count = (int) $record->count; // Convert count to integer
            return $record;
        });

        // Fill in missing immunization types with count 0
        $missing_types = collect($immunization_types)->diff($immunization_records->pluck('immunization_type'));
        $missing_records = $missing_types->map(function ($missingType) {
            return (object) [
                'immunization_type' => $missingType,
                'count' => 0,
            ];
        });

        // Combine the existing records with the missing records and sort based on the order of immunization types
        $immunization_records = $immunization_records->concat($missing_records)
            ->sortBy(function ($record) use ($immunization_types) {
                return array_search($record->immunization_type, $immunization_types);
            });

        $active = 'vaccineReport';
        return view('admin.vaccineReport', compact('active', 'immunization_records'));
    }
}
