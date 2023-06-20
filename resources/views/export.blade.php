@extends('layouts.app')
@section('title', 'Export / Import')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Export / Import</h1>

            <p>
                All of the data from your interactions, such as the list of owned tracks and your schedule picks is saved locally in your browser, which is why you don't have to sign up for an account to use the website.
            </p>
            <p>
                If you need to preserve this data (if you are switching to a different browser, or when planning to reinstall the OS, or changing PCs entirely) you can use this feature to save your data to a text file and then import it in your new browser.
            </p>

            <h4>Export</h4>
            <p>
                If you wish to save your data, save the following to a text file somewhere you can access it later.
            </p>
            <div class="card">
                <div class="card-body" id="json-contents">

                </div>
            </div>

            <h4 class="mt-4">Import</h4>

            <p>
                When you are ready to import your data, paste the text you saved earlier into the field below, and click "Import".
            </p>
            <p>
                <span class="text-warning">Note:</span> this will erase any existing selections!
            </p>

            <div class="row justify-content-center my-5">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <textarea class="form-control" id="import-data" name="import-data" rows="3"></textarea>
                                <button type="submit" id="import" class="btn btn-primary my-3">Import</button>
                            </div>
                            <div class="text-center">
                                <div id="result-success" class="text-success" style="display: none">Data imported successfully</div>
                                <div id="result-error" class="text-danger" style="display: none">Something went wrong, please check the data is correct</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showExportData() {
            var favorites = loadFavorites();
            var owned = loadOwnedTracks();
            var data = {
                favorites: favorites,
                owned: owned
            }
            $('#json-contents').html(JSON.stringify(data, null, ' '));
        }

        $(function() {
            showExportData();

            $('#import').unbind('click').on('click', function(e) {
                e.preventDefault();

                $('#result-error').hide();
                $('#result-success').hide();

                var $el = $('#import-data');

                try {
                    var json = JSON.parse($el.val());
                }
                catch(err) {
                    $('#result-error').show();
                    console.log(err);
                    return;
                }

                if(json.favorites === undefined) json.favorites = [];
                if(json.owned === undefined) json.owned = [];

                saveFavorites(json.favorites);
                saveOwnedTracks(json.owned);

                showExportData();

                $('#result-success').show();
            });
        });
    </script>
@endpush
