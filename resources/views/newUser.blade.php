<form action="{{url('auth/newUser')}}" method="post">
    Phone Number :<br>
    <input type="text" name="phone">
    <input type="submit" value="submit" name="submit">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
