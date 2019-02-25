<!DOCTYPE html>
<html>
<head>
    <title>New Reply</title>
</head>
 
<body>
<h2>You have received a reply on one of your listing</h2>
<p>{{$data['comment']}}
</p>
<a href="{{url('/listing/' . $data['listing']->id)}}">Listing</a>

</body>
 
</html>