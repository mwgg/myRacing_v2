@extends('layouts.app')
@section('title', 'Season stats')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Season stats</h1>

            <h4>Most common tracks by category, in non-rookie series</h4>
            <div class="row justify-content-center">
                @foreach(\App\iRacing\Constants::ACTIVE_CATEGORIES as $categoryId=>$categoryName)
                    <div class="col-lg-6 col-sm-11 my-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mt-1 mb-3 ml-1">
                                    <span class="subtitle-icon">
                                        <x-dynamic-component :component="'license-icons.' . $categoryId" />
                                    </span>
                                    {{ \App\iRacing\Constants::CATEGORIES[$categoryId] }}
                                </h5>
                                <table class="table table-dark table-sm">
                                    @foreach(array_slice($trackCounts[$categoryId] ?? [], 0, 10) as $trackName=>$trackCount)
                                        <tr>
                                            <td>{{ $trackName }}</td>
                                            <td>{{ $trackCount }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h4>Tracks not on the schedule</h4>

            <div class="row">
                <div class="col-lg-6 col-sm-11 my-3">
                    <div class="card">
                        <div class="card-body">
                            <ul>
                                @foreach($unusedTracks as $trackName)
                                    <li>
                                        {{ $trackName }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
