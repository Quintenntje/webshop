<!DOCTYPE html>
<html>
  <body>
    <h1>{{ $subjectLine }}</h1>
    <div>
      {!! nl2br(e($content)) !!}
    </div>

    <p>Thank you for subscribing to our newsletter.</p>


    <a href="{{ route('newsletter.unsubscribe', $email) }}">Unsubscribe</a>
  </body>
</html>
