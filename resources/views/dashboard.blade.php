@extends('layouts.app')
@section('title', 'Planner')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="filters mt-1 mb-2 text-center">
                <input type="radio" class="btn-check" name="filter-category" id="filter-category-0" value="0" autocomplete="off" checked>
                <label class="btn btn-sm btn-outline-secondary" for="filter-category-0">All</label>
                @foreach(\App\iRacing\Constants::CATEGORIES as $categoryId=>$categoryName)
                    <input type="radio" class="btn-check" name="filter-category" id="filter-category-{{ $categoryId }}" value="{{ $categoryId }}" autocomplete="off">
                    <label class="btn btn-sm btn-outline-secondary" for="filter-category-{{ $categoryId }}"><span class="iracing-icons">{!! \App\iRacing\Constants::CAT_ICONS[$categoryId] !!}</span> {{ $categoryName }}</label>
                @endforeach
            </div>
            <div class="calendar">
                <div id="nothing-here" class="text-center my-3" style="display: none;">Nothing here, select what you are interested in on the <a href="{{ route('planner') }}">Planner</a> page</div>
                <div id="content-container">
                    <div class="calendar-logos-container">
                        @foreach($series as $categoryId=>$categorySeries)
                            @foreach($categorySeries as $s)
                                <div class="calendar-series calendar-logos" data-series-id="{{ $s->series_id }}" data-category-id="{{ $s->category_id }}" style="display: none;">
                                    <div class="series-logo-large series-logo calendar-series-logo" data-bs-toggle="tooltip" data-bs-html="true" title="{{ $s->tooltipText() }}">
                                        <img src="{{ $s->logo_url }}"/>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="calendar-outer inner-shadow">
                        <div class="calendar-container inner-shadow" data-simplebar>
                            @foreach($series as $categoryId=>$categorySeries)
                                @foreach($categorySeries as $s)
                                    <div class="calendar-series" data-series-id="{{ $s->series_id }}" data-category-id="{{ $s->category_id }}" style="display: none;">
                                        @foreach($raceWeeks as $startDate)
                                            @php
                                                $startOfRaceWeek = $startDate;
                                                $endOfRaceWeek = $startOfRaceWeek->copy()->addWeek();
                                                $weekSchedule = $s->currentSeason->schedules
                                                    ->where('start_date', '>=', $startOfRaceWeek)
                                                    ->where('start_date', '<', $endOfRaceWeek)
                                                    ->first();
                                                $currentWeek = $weekSchedule && $weekSchedule->start_date >= $startOfWeek && $weekSchedule->start_date < $endOfWeek;
                                            @endphp

                                            @if($weekSchedule)
                                                <div class="calendar-week active-week {{ $currentWeek ? 'calendar-current-week' : '' }}" data-series-id="{{ $s->series_id }}">
                                                    @include('layouts.track', [
                                                        'inactive' => true,
                                                        'disabled' => true,
                                                        'schedule' => $weekSchedule,
                                                    ])
                                                </div>
                                                @if($currentWeek)
                                                    <div class="iracing-icons text-secondary no-select mr-2" data-bs-toggle="tooltip" title="Upcoming weeks">&#xE123;</div>
                                                @endif
                                            @else
                                                <div class="calendar-week {{ ($startDate == $startOfWeek) ? 'calendar-current-week' : '' }}">
                                                    @include('layouts.blank-track', [
                                                        'seriesId' => $s->series_id,
                                                    ])
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @endforeach
                            <div class="mb-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            showDashboardFavorites();

            $('input[name="filter-category"]').on('change', function() {
                var filter = $('input[name="filter-category"]:checked').val();
                filterDashboardFavorites(filter);
            });
        });
    </script>
@endpush
