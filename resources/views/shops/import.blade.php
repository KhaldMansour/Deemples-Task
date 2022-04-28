<!DOCTYPE html>
<html>
<head>
    <title>Deemples</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
<h1>Hiii</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



        <div class="row">

      <!--Grid column-->
      <div class="col-md-6 mb-4">
  
        <!--Title-->
        <h2 class="">
          Import excel file to sync database
        </h2>
  
        <!--Description-->
        <p>The file must be in a xslx format</p>
        <p>The ID field is the unique identifier , if you want to add a record add any unique number with your data</p>
        <p>Any change in the ID field will create a new record , deleting the old one</p>
        <p>Don't leave any missing data</p>

  
        <!--Section: Live preview-->
        <section class="section-preview">
        <form id="send-form" method="POST" action="{{route('shops.upload')}}" enctype="multipart/form-data">
        @csrf

          <div class="input-group my-3">
            <div class="input-group-prepend">
              <button type="submit" class="btn btn-primary submit"> Submit
              </button>
            </div>
            <div class="custom-file">
              <input name="file" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
          </div>
        <form>
  
        </section>
        <!--Section: Live preview-->
  
      </div>
  
    </div>

</div>
</div>

<script>
$('#inputGroupFile01').change(function() {
  var file = $('#inputGroupFile01')[0].files[0].name;
  $('#inputGroupFile01').val = file;
});
</script>
   
</body>
</html>