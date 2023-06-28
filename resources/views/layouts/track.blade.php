<div class="track-container track-front shadow
    @if($inactive ?? false) track-container-inactive @endif
    @if($disabled ?? false) track-past-week @endif"
     data-unique-id="{{ $schedule->unique_id }}" data-series-id="{{ $schedule->series_id }}"
     data-bs-toggle="tooltip" data-bs-html="true" title="{{ $schedule->tooltipText() }}"
     style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7) ), url('{{ $schedule->track->image_url }}')">
    <span class="track-name no-select"><b>{{ $schedule->track->name }}</b> {{ $schedule->track->config_name }}</span>
    <div class="track-week track-ownership no-select {{ (!$schedule->track->free) ? 'track-ownership-red' : 'track-ownership-green' }}" data-track-id="{{ $schedule->track->package_id }}">{{ $schedule->week_number }}</div>
    <div class="track-logo" style="background: url({{ $schedule->track->logo_url }}) no-repeat;"></div>
    <div class="track-map" style="background: url({{ $schedule->track->map_url }}) no-repeat;"></div>
    @if(!$schedule->track->free)
        <div class="track-buy bg-warning" data-track-id="{{ $schedule->track->package_id }}">
            <a class="iracing-icons track-buy-link" href="#" data-unique-id="{{ $schedule->unique_id }}">&#xE030;</a>
        </div>
    @endif
</div>
<div class="track-container track-container-inactive track-back" style="display: none;"
     data-unique-id="{{ $schedule->unique_id }}"
     style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7) ), url('{{ $schedule->track->image_url }}')">
    <div class="position-absolute absolute-center">
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-sm btn-success track-ownership-btn" data-track-id="{{ $schedule->track->package_id }}">Mark owned</button>
            <a
                href="https://members.iracing.com/membersite/member/TrackDetail.do?trkid={{ $schedule->track->track_id }}"
                target="_blank"
                type="button"
                class="btn btn-sm btn-warning">
                    <span class="iracing-icons">&#xE030;</span>&nbsp;&nbsp;Buy track
            </a>
        </div>
    </div>
</div>
