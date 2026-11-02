@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.edit_customer') }}</h2>
            <a class="btn btn-primary" href="{{ route('customers.index') }}">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>{{ __('messages.whoops') }}</strong> {{ __('messages.input_errors') }}<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.name') }}:</strong></label>
                        <input type="text" name="name" value="{{ $customer->name }}" class="form-control" placeholder="{{ __('messages.name') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.mobile') }}:</strong></label>
                        <input type="text" name="mobile" value="{{ $customer->mobile }}" class="form-control" placeholder="{{ __('messages.mobile') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.address') }}:</strong></label>
                        <textarea class="form-control" style="height:100px" name="address" placeholder="{{ __('messages.address') }}">{{ $customer->address }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.distance_store') }}:</strong></label>
                        <input type="text" name="distance" value="{{ $customer->distance }}" class="form-control" placeholder="{{ __('messages.distance') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.profile_picture') }}:</strong></label>
                        <input type="file" name="profile_pic" class="form-control mb-2">
                        @if($customer->profile_pic)
                            <img src="{{ asset('storage/'.$customer->profile_pic) }}" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.id_card_front') }}:</strong></label>
                        <input type="file" name="id_card_front" class="form-control mb-2">
                        @if($customer->id_card_front)
                            <img src="{{ asset('storage/'.$customer->id_card_front) }}" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.id_card_back') }}:</strong></label>
                        <input type="file" name="id_card_back" class="form-control mb-2">
                        @if($customer->id_card_back)
                            <img src="{{ asset('storage/'.$customer->id_card_back) }}" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
