@component('mail::message')
The following repository:

***********
https:/github.com/{{ $source->username }}/{{ $source->repository }}
***********

{{ $sentence }}

@endcomponent
