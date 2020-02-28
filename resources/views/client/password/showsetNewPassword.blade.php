<form action="{{route('setNewPassword',$user->id)}}" method="post">
    @csrf()
   <div>
       <label>كلمة السر الجديدة </label>
       <input type="password" name="password">
   </div>
    <div>
       <label> تاكيد كلمة السر الجديدة </label>
       <input type="password" name="password_confirmation">
   </div>
    <input type="submit" value="reset">
</form>
