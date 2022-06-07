<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Election;
use App\Models\Candidate;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class ResultChart extends BaseChart
{

    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'results';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'results.view';

    /**
     * Determines the prefix that will be used by the chart
     * endpoint.
     */
    public ?string $prefix = 'some_prefix';

    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $candidates = Candidate::all();
        $labels = [];
        $count = [];

        foreach ($candidates as $candidate){
            array_push($labels, $candidate->name);
        }

        $values = Candidate::with('votes')->get();

        foreach ($values as $item) {
            array_push($count, $item->votes->count());
        }

        // return Chartisan::build()
        //     ->labels($labels)
        //     ->dataset('Sample', $count);
    }
}
