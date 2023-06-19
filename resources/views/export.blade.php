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
                When you are ready to import your data, choose the file you saved earlier, and click "Upload".
            </p>
            <p>
                <span class="text-warning">Note:</span> this will erase any existing selections!
            </p>

            <div class="row justify-content-center my-5">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center mt-3">
                                <div class="col-6">
                                    <input class="form-control" type="file" id="file">
                                </div>
                                <div class="col-2">
                                    <button type="submit" id="upload" class="btn btn-primary mb-3">Upload</button>
                                </div>
                            </div>
                            <div class="text-center">
                                <div id="result-success" class="text-success" style="display: none">Data imported successfully</div>
                                <div id="result-error" class="text-danger" style="display: none">Something went wrong</div>
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

            $('#upload').unbind('click').on('click', function(e) {
                e.preventDefault();

                $('#result-success').hide();
                $('#result-error').hide();

                var formData = new FormData();
                formData.append('import', $('#file')[0].files[0]);

                $.ajax({
                    url: '{{ route('import') }}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        if(result.status !== 'success') {
                            $('#result-error').show();
                            return;
                        }

                        saveFavorites(result.data.favorites);
                        saveOwnedTracks(result.data.owned);

                        $('#result-success').show();
                    }
                });
            });
        });
    </script>
@endpush
