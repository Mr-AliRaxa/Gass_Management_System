@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.edit_team_member') }}</h2>
            <a class="btn btn-primary" href="{{ route('team_members.index') }}">{{ __('messages.back') }}</a>
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
        <form action="{{ route('team_members.update',$teamMember->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.name') }}:</strong></label>
                        <input type="text" name="name" value="{{ $teamMember->name }}" class="form-control" placeholder="{{ __('messages.name') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.mobile') }}:</strong></label>
                        <input type="text" name="mobile" value="{{ $teamMember->mobile }}" class="form-control" placeholder="{{ __('messages.mobile') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.address') }}:</strong></label>
                        <textarea class="form-control" style="height:100px" name="address" placeholder="{{ __('messages.address') }}">{{ $teamMember->address }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.designation') }}:</strong></label>
                        <input type="text" name="designation" value="{{ $teamMember->designation }}" class="form-control" placeholder="{{ __('messages.designation') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.basic_salary') }}:</strong></label>
                        <input type="number" step="0.001" name="basic_salary" value="{{ $teamMember->basic_salary }}" class="form-control" placeholder="0.000">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.profile_picture') }}:</strong></label>
                        <input type="file" name="profile_pic" class="form-control mb-2">
                        @if($teamMember->profile_pic)
                            <img src="{{ asset('storage/'.$teamMember->profile_pic) }}" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.id_card_front') }}:</strong></label>
                        <input type="file" name="id_card_front" class="form-control mb-2">
                        @if($teamMember->id_card_front)
                            <img src="{{ asset('storage/'.$teamMember->id_card_front) }}" width="100">
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.id_card_back') }}:</strong></label>
                        <input type="file" name="id_card_back" class="form-control mb-2">
                        @if($teamMember->id_card_back)
                            <img src="{{ asset('storage/'.$teamMember->id_card_back) }}" width="100">
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
