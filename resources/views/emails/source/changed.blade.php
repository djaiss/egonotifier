@component('mail::message')
The following repository:

***********
<a href="https:/github.com/{{ $source->username }}/{{ $source->repository }}">https:/github.com/{{ $source->username }}/{{ $source->repository }}</a>
  ***********

  {{ $sentence }}

  @endcomponent
