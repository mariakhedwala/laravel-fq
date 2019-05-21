@extends('layouts.app')

@section('content')
<section class="contacts">
	<div class="wrapper">
        <h2>{{ __('Contacts') }}</h2>
        <div class="create-new">
            <a class="btn btn-primary" href="{{ url('/users/create') }}">{{ __('new contact') }}</a>
        </div>
                <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" id="listing_table">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Job Title') }}</th>
                        <th>{{ __('City') }}</th>
                        <th>{{ __('Country') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td class="count">{{ $count }}</td>
                        <td class="name">{{ $user->name }}</td>
                        <td class="email">{{ $user->email }}</td>
                        <td class="job">
                            @if ($user->job_title !== NULL)
                            {{ $user->job_title }}
                            @else
                            {{ __('-') }}
                            @endif
                        </td>
                        <td class="city">
                            @if ($user->city !== NULL)
                            {{ $user->city }}
                            @else
                            {{ __('-') }}
                            @endif
                        </td>
                        <td class="country">
                            @if ($user->country !== NULL)
                            {{ $user->country }}
                            @else
                            {{ __('-') }}
                            @endif
                        </td>
                        <td class="action">
                            <a class="btn btn-primary edit" href="/users/{{ $user->id }}/edit"
                                title="Edit">{{ __('edit') }}</a>
                            <form action="/users/{{ $user->id }}" method="POST" class="delete">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-danger" type="submit">{{ __('delete') }}</button>
                            </form>
                        </td>
                    </tr>
                    @php $count++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</section>
@endsection