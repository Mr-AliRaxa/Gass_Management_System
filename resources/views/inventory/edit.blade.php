@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.edit_stock') }}</h2>
            <a class="btn btn-primary" href="{{ route('inventory.index') }}">{{ __('messages.back') }}</a>
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
        <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PUT')
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.cylinder_type') }}:</strong></label>
                        <select name="type" class="form-control">
                            <option value="11kg_full" {{ $inventory->type == '11kg_full' ? 'selected' : '' }}>{{ __('messages.cylinder_11kg_full') }}</option>
                            <option value="11kg_empty" {{ $inventory->type == '11kg_empty' ? 'selected' : '' }}>{{ __('messages.cylinder_11kg_empty') }}</option>
                            <option value="22kg_full" {{ $inventory->type == '22kg_full' ? 'selected' : '' }}>{{ __('messages.cylinder_22kg_full') }}</option>
                            <option value="22kg_empty" {{ $inventory->type == '22kg_empty' ? 'selected' : '' }}>{{ __('messages.cylinder_22kg_empty') }}</option>
                            <option value="44kg_full" {{ $inventory->type == '44kg_full' ? 'selected' : '' }}>{{ __('messages.cylinder_44kg_full') }}</option>
                            <option value="44kg_empty" {{ $inventory->type == '44kg_empty' ? 'selected' : '' }}>{{ __('messages.cylinder_44kg_empty') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.quantity') }}:</strong></label>
                        <input type="number" name="quantity" value="{{ $inventory->quantity }}" class="form-control" placeholder="{{ __('messages.quantity') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.note') }}:</strong></label>
                        <textarea class="form-control" style="height:100px" name="note" placeholder="{{ __('messages.reason') }}">{{ $inventory->note }}</textarea>
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
