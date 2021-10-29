@component('mail::message')
# you have a new contact message

<p><b>name :</b> {{$req->name}}</p>
<p><b>email :</b> {{$req->email}}</p>
<p><b>Subject :</b> {{$req->subject}}</p>
<p><b>Message :</b> {{$req->message}}</p>

This message is from your contact form in {{ config('app.name') }}<br>
@endcomponent
