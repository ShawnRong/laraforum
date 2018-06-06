@component('profiles.activities.activity')
  @slot('heading')
    {{ $profileUser->name }} published a
    <a href="{{ $activity->subject->path() }}" target="_blank">
      "{{ $activity->subject->title }}"
    </a>
  @endslot

  @slot('body')
    {{ $activity->subject->body }}
  @endslot
@endcomponent
