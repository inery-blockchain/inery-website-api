@component('mail::message')

# {{ $data['first_name']}}  {{ $data['last_name']}} sent application for job <i>{{ $data['job_title'] }} in location @if (!empty($data['location'])) {{ $data['location'] }} @else {{__ ('Remote')}}</i> @endif <br><br>
 <h2> Job application details: </h2>
 
@component('mail::panel') <br>
    First Name: {{ $data['first_name'] }} <br>
    Last Name: {{ $data['last_name'] }} <br>
    Email: {{ $data['email'] }} <br>
    @if (!empty($data['phone'])) Phone: {{ $data['phone'] }} <br> @endif
    @if (!empty($data['location']))Location: {{ $data['location'] }} <br> @endif
    @if (!empty($data['company'])) Company: {{ $data['company'] }} <br> @endif
    @if (!empty($data['linkedin_url']))<a href="{{ $data['linkedin_url'] }}">Linkedin URL</a> <br> @endif
    @if (!empty($data['github_url'])) <a href="{{ $data['github_url'] }}">Github URL</a> <br> @endif
    @if (!empty($data['twitter_url'])) <a href="{{ $data['twitter_url'] }}">Twitter URL</a> <br> @endif
    @if (!empty($data['instagram_url'])) <a href="{{ $data['instagram_url'] }}">Instagram URL</a> <br> @endif
    @if (!empty($data['website_url'])) <a href="{{ $data['website_url'] }}">Website</a> <br> @endif
    @if (!empty($data['other_url'])) <a href="{{ $data['other_url'] }}">Other URL</a> <br> @endif
    @if (!empty($data['general_question'])) General: {{ $data['general_question'] }} <br> @endif
    {{-- Referred By: {{ $data['referred_by'] }} <br> --}}
    {{-- English level: {{ $data['english_level'] }} <br> --}}
    {{-- @if (!empty($data['banking_sector_expirience']))Banking sector exp: {{ $data['banking_sector_expirience'] }} <br> @endif --}}
    {{-- Motivational Answer: {{ $data['motivation_answer'] }} <br> --}}
    {{-- Previous Work: {{ $data['previous_work'] }} <br> --}}
    {{-- Blockchain companies named: {{ $data['list_blockchain_companies'] }} <br> --}}
    {{-- Teams experience: {{ $data['teams_spread'] }} <br> --}}
    {{-- Blockchain experience: {{ $data['blockchain_exp'] }} <br> --}}
    {{-- When can You start working: {{ \Carbon\Carbon::parse($data['start_working_date'])->format('d.m.Y') }} <br> --}}
    {{-- Benefits: {{ $data['three_examples_benefits'] }} <br> --}}
    {{-- @if (!empty($data['additional_info'])) Additional info: {{ $data['additional_info'] }} @endif --}}
@endcomponent


@endcomponent
