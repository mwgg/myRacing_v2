<?php

namespace App\Jobs;

use App\Models\SeriesSchedule;
use App\Models\SeriesSeason;
use Carbon\Carbon;

class UpdateSeriesSeason extends UpdateData
{
    public function handle(): void
    {
        $seasons = $this->iracing->series->seasons();

        foreach($seasons as $season)
        {
            $seriesSeason = SeriesSeason::updateOrCreate(
                [
                    'series_id' => $season->series_id,
                    'season_id' => $season->season_id,
                ],
                [
                    'active' => $season->active,
                    'fixed_setup' => $season->fixed_setup,
                    'is_heat_racing' => $season->is_heat_racing,
                    'license_group' => $season->license_group,
                    'multiclass' => $season->multiclass,
                    'official' => $season->official,
                    'schedule_description' => $season->schedule_description,
                    'season_short_name' => $season->season_short_name,
                    'season_year' => $season->season_year,
                    'season_quarter' => $season->season_quarter,
                    'start_date' => Carbon::parse($season->start_date),
                ]
            );

            $seriesSeason->carClasses()->sync($season->car_class_ids);
            
            foreach($season->schedules as $week)
            {
                $schedule = SeriesSchedule::updateOrCreate(
                    [
                        'unique_id' => $week->series_id . $week->season_id . $week->race_week_num,
                    ],
                    [
                        'series_id' => $week->series_id,
                        'season_id' => $week->season_id,
                        'race_week_num' => $week->race_week_num,
                        'start_date' => Carbon::parse($week->start_date),
                        'race_lap_limit' => $week->race_lap_limit,
                        'race_time_limit' => $week->race_time_limit,
                        'start_type' => $week->start_type,
                        'restart_type' => $week->restart_type,
                        'qual_attached' => $week->qual_attached,
                        'full_course_cautions' => $week->full_course_cautions,
                        'start_zone' => $week->start_zone,
                        'track_id' => $week->track->track_id,
                    ]
                );
            }
        }
    }
}
