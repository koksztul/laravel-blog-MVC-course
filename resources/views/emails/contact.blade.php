@component('mail::message')
# Hi {{config('app.name') }}!

From: {{ $data['email'] }} <br>
Subject: {{ $data['subject'] }} <br>
Message: {{ $data['message'] }}

@endcomponent
