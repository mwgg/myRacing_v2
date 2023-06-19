@extends('layouts.app')
@section('title', 'Planner')

@section('content')
    @foreach($series as $categoryId=>$categorySeries)
        <h5 class="@if(!$loop->first) mt-4 @endif"><span class="iracing-icons subtitle-icon">{!! \App\iRacing\Constants::CAT_ICONS[$categoryId] !!}</span> {{ \App\iRacing\Constants::CATEGORIES[$categoryId] }}</h5>

        @foreach($categorySeries as $s)
            <div class="card planner-card shadow" data-target="#planner-schedule-{{ $s->series_id }}" data-series-id="{{ $s->series_id }}">
                <div class="card-body position-relative">
                    <span class="no-select position-absolute license-badge badge badge-pill pill-cat-license {{ \App\iRacing\Constants::LIC_CLASSES[$s->currentSeason->license_group] }}">
                    <span class="category-icon iracing-icons">{!! \App\iRacing\Constants::CAT_ICONS[$s->category_id] !!}</span>
                    <span class="series-license">{{ \App\iRacing\Constants::LIC_NAMES[$s->currentSeason->license_group] }}</span>
                </span>
                    <div class="series-logo series-logo-large position-absolute">
                        <img src="{{ $s->logo_url }}"/>
                    </div>
                    <div class="planner-series-name position-absolute">{{ $s->series_name }}</div>
                    <div class="planner-favorite-message position-absolute badge badge-light" style="display:none;" data-series-id="{{ $s->series_id }}">
                        <span class="planner-favorite-count"></span>
                        <span> selected</span>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap planner-calendar-container planner-hidden" id="planner-schedule-{{ $s->series_id }}" data-bs-parent="#planner-accordion">
                @foreach($s->schedules as $schedule)
                    <div class="{{ $schedule->isCurrentWeek() ? 'calendar-current-week' : '' }}">
                        @include('layouts.track', [
                            'schedule' => $schedule,
                        ])
                    </div>
                @endforeach
                <div class="d-flex justify-content-center flex-nowrap mt-2 mb-2 mx-auto">
                    <div class="form-floating">
                        <textarea class="form-control series-notes" data-series-id="{{ $s->series_id }}" placeholder="Leave your notes here" id="commentsTextarea" cols="70" rows="5"></textarea>
                        <label for="commentsTextarea">Notes for {{ $s->series_name }}</label>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection

@push('scripts')
    <script>
        $(function() {
            $(".planner-card[data-target]").each(function(){
                $(this).unbind('click').on("click", function(){
                    var target = $(this).data("target");
                    $(".planner-visible").removeClass("planner-visible").addClass("planner-hidden");
                    $(target).removeClass("planner-hidde").addClass("planner-visible");
                });
            });

            markFavorites();
            setMarkedCounts();
        });
    </script>
@endpush
