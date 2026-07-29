@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="alert alert-warning mb-0" role="alert">
                        <h4 class="alert-heading">Purchase Return is temporarily unavailable</h4>
                        <p class="mb-0">
                            This feature is being rebuilt. The previous version incorrectly
                            processed supplier returns through the customer sales-return flow,
                            which could corrupt stock and sales records. It has been disabled to
                            protect your data.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
