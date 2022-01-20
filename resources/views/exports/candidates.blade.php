<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.name') }} </th>
        <th>{{ __('messages.common.email') }} </th>
        <th>{{ __('messages.candidate.phone') }} </th>
        <th>{{ __('messages.candidate.experience') }} </th>
        <th>{{ __('messages.candidate.birth_date') }} </th>
        <th>{{ __('messages.candidate.gender') }} </th>
        <th>{{ __('messages.job.country') }} </th>
        <th>{{ __('messages.company.state') }} </th>
        <th>{{ __('messages.company.city') }} </th>
        <th>{{ __('messages.candidate.immediate_available') }} </th>
        <th>{{ __('messages.skills') }} </th>
        <th>{{ __('messages.languages') }} </th>
        <th>{{ __('messages.candidate.current_salary') }} </th>
        <th>{{ __('messages.candidate.expected_salary') }} </th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($candidates as $candidate)
        <tr>
            <td>{{ $candidate->user->full_name }}</td>
            <td>{{ $candidate->user->email }}</td>
            <td>{{ !empty($candidate->user->phone)?$candidate->user->phone:__('messages.common.n/a') }}</td>
            <td>{{ !empty($candidate->experience)?$candidate->experience.'  Year':__('messages.common.n/a') }}
            </td>
            <td>{{ \Carbon\Carbon::parse($candidate->user->dob)->format('d-m-y') }}</td>
            <td>{{ $candidate->user->gender == 0 ? __('messages.common.male') : __('messages.common.female') }}</td>
            <td>{{ !empty($candidate->user->country_id) ?$candidate->user->country_name:__('messages.common.n/a') }}</td>
            <td>{{ !empty($candidate->user->state_id)?$candidate->user->state_name:__('messages.common.n/a') }}</td>
            <td>{{ !empty($candidate->user->city_id)?$candidate->user->city_name:__('messages.common.n/a') }}</td>
            <td>{{ $candidate->immediate_available == 1 ? __('messages.candidate.immediate_available'):__('messages.candidate.not_immediate_available') }}</td>
            <td>@if($candidate->user->candidateSkill->count())
                    @foreach($candidate->user->candidateSkill->pluck('name') as $key => $skill)  {{$loop->first?'':', '}} {{$skill}}  @endforeach
                @else
                    <p>No skills</p>
                @endif
            </td>
            <td>
                @if($candidate->user->candidateLanguage->count())
                    @foreach($candidate->user->candidateLanguage->pluck('language') as $key => $lang)  {{$loop->first?'':', '}} {{$lang}}  @endforeach
                @else
                    <p>No languages</p>
                @endif
            </td>
            <td>{{ !empty($candidate->current_salary)?number_format($candidate->current_salary):__('messages.common.n/a') }}</td>
            <td>{{ !empty($candidate->expected_salary)?number_format($candidate->expected_salary):__('messages.common.n/a') }}</td>
            <td>{{ $candidate->user->is_active == 1 ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
