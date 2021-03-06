 <!DOCTYPE html>
 <html lang="en">

<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Thank You!</title>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
     <!--[if lt IE 9]>
       <script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
     <![endif]-->

     <style>
        {!! $survey->css !!}
     </style>
 </head>

 <body>
  <div class='jumbotron'>
    <div class='container'>
      <h1>{{$survey->name}}</h1>
      <p>{{$survey->description or ''}}</p>
    </div>
  </div>
  <div class='container'>
    <div class='row'>
      <div class='col-md-8 col-md-offset-2'>
        <div class='panel panel-default'>
          <div class='panel-heading thank-you-heading'>
            <h1 class='panel-title thank-you-title'>Thank You!</h1>
          </div>
          <div class='panel-body thank-you-panel'>
            @if ( !$survey->active )
              @if ($survey->thank_you_message)
                {!! nl2br(e($survey->thank_you_message)) !!}
              @else
                This form is not currently active
              @endif
            @else
              @if ($survey->thank_you_message)
                {!! nl2br(e($survey->thank_you_message)) !!}
              @else
                Thank you for your submission!
              @endif
            @endif

            @if ($survey->kiosk_mode)
              <p>This page will be redirected in 5 seconds.</p>
              <script>
              window.setTimeout(function(){

                  // Move to a new location or you can do something else
                  window.location.href = "{{$survey->return_url}}";

              }, 5000);
              </script>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </body>

 </html>
