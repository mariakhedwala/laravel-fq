@extends('layouts.app')

@section('content')
<section class="create">
    <div class="wrapper">
        <h2>
            {{ $h2value = $user->id ? 'Update' : 'Register' }}
        </h2>
        <form method="POST" action="{{ $action = $user->id ? "/users/$user->id" : "/users" }}" id="login" novalidate
            autocomplete="off">
            @csrf
            @method($method = $user->id ? 'PATCH' : 'POST')
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <div class="form-group__name">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        name="name" value="{{ $name = $user->id ? $user->name : old('name') }}" autofocus="true">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <div class="form-group__email">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ $email = $user->id ? $user->email : old('email') }}" autofocus="true">

                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="job">{{ __('Job Title') }}</label>
                <div class="form-group__job">
                    <select name="job_title" id="job" class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}"
                        autofocus="true">
                        <option selected value="{{ $job_title = $user->id ? $user->job_title : old('job_title') }}">
                            {{ $job_title = $user->job_title ? $user->job_title : 'Select job_title' }}</option>
                        @foreach ($job_titles as $job_title)
                        <option value="{{ $job_title->job_title }}">{{ $job_title->job_title }}</option>
                        @endforeach
                    </select>
                    @error('job_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="city">{{ __('City') }}</label>
                <div class="form-group__city">
                    <select name="city" id="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                        autofocus="true">
                        <option selected value="{{ $city = $user->id ? $user->city : old('city') }}">
                            {{ $city = $user->city ? $user->city : 'Select city' }}</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->city }}">{{ $city->city }}</option>
                        @endforeach
                    </select>
                    @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="country">{{ __('Country') }}</label>
                <div class="form-group__country">
                    <select name="country" id="country"
                        class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" autofocus="true">
                        <option selected value="{{ $country = $user->id ? $user->country : old('country') }}">
                            {{ $country = $user->country ? $user->country : 'Select country' }}</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->country }}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                    @error('country')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>

                <div class="form-group__password">
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        autofocus="true">

                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="confirmPassword">{{ __('Confirm Password') }}</label>

                <div class="form-group__password">
                    <input id="confirmPassword" type="password"
                        class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                        name="password_confirmation" autofocus="true">
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="submit">
                <button id="create-user" type="submit" class="btn btn-primary">
                    {{ $valuebtn = $user->id ? 'Update' : 'Submit' }}
                </button>
            </div>
            <div class="go-back">
                <a href="{{ url('/users') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
</section>
@endsection