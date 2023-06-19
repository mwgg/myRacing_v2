@extends('layouts.app')
@section('title', 'Help')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Help</h1>

            <h4>What is this and why do I need it?</h4>
            <p>
                myRacing is a race planner and schedule guide for iRacing official series.
            </p>
            <p>
                Once you mark the race weeks that you would like to race for every series you are interested in on the <a href="{{ route('planner') }}">Planner</a> page, the <a href="{{ route('dashboard') }}">Dashboard</a> page serves as a quick and easy visual guide for the series and tracks for the current and upcoming weeks.
            </p>

            <h4>Basic usage</h4>
            <p>
                Look for the series you would like to race on the <a href="{{ route('planner') }}">Planner</a> page, click on the series name to expand the current season's schedule.
                You will be presented with the upcoming season schedule, starting with the current week.
                Tracks you don't yet own will have a red band on the left side, and a shopping cart icon, and owned tracks will have a checkmark icon.
                Clicking on this icon will allow you to mark the track as owned, as well as open the track page.
                Choose the weeks that interest you, and click on those tracks, which will highlight them in green.
            </p>
            <p>
                Once you've chosen all the tracks you would like to race for all the series that interest you, feel free to navigate to the <a href="{{ route('dashboard') }}">Dashboard</a> page.
                There you will see a list of all the series that you are interested in, with their season schedules starting with the current race week.
            </p>
            <p>
                Hovering over the series logo shows the series name, license class, setup type, whether the race is official or not, as well as the race schedule.
                Hovering over a particular track will show the start type and race duration.
            </p>
            <p>
                Whether you want to choose from one of the series to race on any given day, or practice for the upcoming weeks, the information you need is available at a glance.
            </p>

            <h4>How are my schedule picks saved?</h4>
            <p>
                All of the data from your interactions, such as the list of owned tracks and your schedule picks is saved locally in your browser, which is why you don't have to sign up for an account to use the website.
            </p>
            <p>
                If you need to preserve this data (if you are switching to a different browser, or when planning to reinstall the OS, or changing PCs entirely) you can use the <a href="{{ route('export') }}">Export / Import</a> feature.
            </p>
        </div>
    </div>
@endsection
