<x-mail::message>
Hello {{$fullnames}},

You have successfully registered to Sacco Managemnt Portal. <br>
Your Username is <b>{{$username}}</b> <br>
Your Password is <b>{{$pass}} </b><br>

You can now login and access the system

<x-mail::button :url="'#'">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
