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

            <h4 class="mt-5">Export</h4>
            <p>
                If you wish to save your data, save the following to a text file somewhere you can access it later.
            </p>
            <div class="card">
                <div class="card-body" id="json-contents">

                </div>
            </div>

            <h4 class="mt-5">Import</h4>

            <p>
                When you are ready to import your data, paste the text you saved earlier into the field below, and click "Import".
            </p>
            <p>
                <span class="text-warning">Note:</span> this will replace and/or erase all existing selections!
            </p>

            <div class="card my-3">
                <div class="card-body">
                    <div class="text-center">
                        <textarea class="form-control" id="import-data" name="import-data" rows="3"></textarea>
                        <div class="text-center mt-2">
                            <div id="result-import-success" class="text-success" data-result-msg="" style="display: none">Data imported successfully</div>
                            <div id="result-import-error" class="text-danger" data-result-msg="" style="display: none">Something went wrong, please check the data is correct</div>
                        </div>
                        <button type="submit" id="import" class="btn btn-primary mt-3 mb-2">Import</button>
                    </div>
                </div>
            </div>

            <h4 class="mt-5">Delete all local data</h4>

            <p>
                If you wish to remove all myRacing data from your browser, you can do so with the button below.
            </p>
            <p>
                <span class="text-danger">Note:</span> this will erase all existing selections!
            </p>
            <div class="text-center">
                <div class="text-center mt-2">
                    <div id="result-delete-success" class="text-success" data-result-msg="" style="display: none">Data erased successfully</div>
                    <div id="result-delete-error" class="text-danger" data-result-msg="" style="display: none">Something went wrong</div>
                </div>
                <button type="submit" id="delete" class="btn btn-danger mt-3 mb-2">Delete</button>
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

                if (!confirm('This will replace and/or erase all existing selections, are you sure you want to proceed?')) return;
                $('div[data-result-msg]').hide();

                var $el = $('#import-data');

                try {
                    var json = JSON.parse($el.val());
                }
                catch(err) {
                    $('#result-import-error').show();
                    console.log(err);
                    return;
                }

                if(json.favorites === undefined) json.favorites = [];
                if(json.owned === undefined) json.owned = [];

                saveFavorites(json.favorites);
                saveOwnedTracks(json.owned);

                showExportData();

                $el.val('');
                $('#result-import-success').show();
            });

            $('#delete').unbind('click').on('click', function(e) {
                e.preventDefault();

                if (!confirm('This will erase all existing selections, are you sure you want to proceed?')) return;
                $('div[data-result-msg]').hide();

                try {
                    localStorage.removeItem('myracing-favorites');
                    localStorage.removeItem('myracing-owned-tracks');
                }
                catch(err) {
                    $('#result-delete-error').show();
                    console.log(err);
                    return;
                }

                showExportData();
                $('#result-delete-success').show();
            })
        });
    </script>
@endpush
