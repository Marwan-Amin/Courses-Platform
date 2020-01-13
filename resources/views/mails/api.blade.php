@component('mail::message')
Hello **{{$user->name}}**,  {{-- use double space for line break --}}
Thank you for choosing our Site!

Click below to start working right now
@component('mail::button', ['url' => "{{route('api.mail',[$user->verify_token])}}"])
<a href="{{route('api.mail',$user->verify_token)}}">Go to your inbox</a>
@endcomponent
Sincerely,  
Course Platform team.
@endcomponent
