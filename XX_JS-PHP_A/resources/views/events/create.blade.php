@extends('layouts.app')

@section('main')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Events</h1>
    </div>

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new event</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('events.store')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputName">Name</label>
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName"
                       name="name" placeholder="" value="{{old('name', '')}}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputSlug">Slug</label>
                <input type="text" class="form-control @if($errors->has('slug')) is-invalid @endif" id="inputSlug"
                       name="slug" placeholder="" value="{{old('slug', '')}}">
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{$errors->first('slug')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputDate">Date</label>
                <input type="text"
                       class="form-control @if($errors->has('date')) is-invalid @endif"
                       id="inputDate"
                       name="date"
                       placeholder="yyyy-mm-dd"
                       value="{{old('date', '')}}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{$errors->first('date')}}
                    </div>
                @endif
            </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save event</button>
        <a href="{{route('events.index')}}" class="btn btn-link">Cancel</a>
    </form>
@endsection
