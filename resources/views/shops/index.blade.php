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
    <h1 align="center">Deemples Task</h1>
    <br/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success mb-2"  href="{{ route('shops.download') }}">Export Shops
                </a>
            </div>
            <div class="pull-right">
                <a class="btn btn-success mb-2"  href="{{ route('shops.import') }}">Import Shops
                </a>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" data-target="#test" class="btn btn-primary" data-toggle="modal">
        Create Shop
        </button>
    </div>

        <!-- Modal -->
    <div class="modal" id="test" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Shop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">

                <form id="send-form" method="POST" action="{{route('shops.store')}}">
                        @csrf
                        <label for="name">Name</label><br>
                        <input id="shop_name" name="name" type="text">
                        <br/>

                        <label for="floor">Floor</label><br>
                        <input id="shop_floor" name="floor" type="number">
                        <br/>

                        <label for="shoplot">Lot number</label><br>
                        <input id="shop_lotnumber" name="shoplot" type="number">
                        <br/>

                        <br/>
                        <button type="submit" class="btn btn-primary submit"> Submit
                        </button>
                        <br/>

                        </div>
                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

          <!-- Modal -->
          <div class="modal" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Shop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">

                <form id="edit-form" method="POST" action="{{route('shops.update')}}">
                        @csrf
                        <input id="edit-id" type="hidden">
                        <label for="name">Name</label><br>
                        <input id="edit_shop_name" name="name" type="text">
                        <br/>

                        <label for="floor">Floor</label><br>
                        <input id="edit_shop_floor" name="floor" type="number">
                        <br/>

                        <label for="shoplot">Lot number</label><br>
                        <input id="edit_shop_lotnumber" name="shoplot" type="number">
                        <br/>

                        <br/>
                        <button type="submit" class="btn btn-primary submit"> Submit
                        </button>
                        <br/>

                        </div>
                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Floor</th>
                <th>Shoplot</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>
   
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('shops.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'floor', name: 'floor'},
            {data: 'shoplot', name: 'shoplot'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });

  $("#send-form").submit(function(e){

    e.preventDefault();

    let url = $(this).attr('action');

        $.ajax({
            type:'POST',
            url: url,
            datatype:'json',
            data:
            {
            '_token': '{{csrf_token()}}',
            name : $("#shop_name").val(),
            floor: $("#shop_floor").val(),
            shoplot : $("#shop_lotnumber").val(),
            },
            success: function(res){
                    alert( res.message );
                    $("#test").modal("hide");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                let errors;
                errors = JSON.parse(XMLHttpRequest.responseText).errors;

                console.log(errors)

                Object.keys(errors).forEach(key => {
                    alert(errors[key])
                })
            }
        });
    });


    $("#edit-form").submit(function(e){

        e.preventDefault();

        let id =$("#edit-id").val();

        let url = $(this).attr('action');


        $.ajax({
            type:'POST',
            url: url,
            datatype:'json',
            data:
            {
            '_token': '{{csrf_token()}}',
            id : id,
            name : $("#edit_shop_name").val(),
            floor: $("#edit_shop_floor").val(),
            shoplot : $("#edit_shop_lotnumber").val(),
            },
            success: function(res){
                    alert( res.message );
                    $("#edit-modal").modal("hide");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                let errors;
                errors = JSON.parse(XMLHttpRequest.responseText).errors;

                console.log(errors)

                // Object.keys(errors).forEach(key => {
                //     alert(errors[key])
                // })
            }
        });
    });

    $('body').on('click', '#edit', function () {
        $("#edit-id").val($("#edit").val()) ;
    });



    //Delete Shop
    $('body').on('click', '#delete', function () {

        confirm("Are you sure want to delete !");

        $.ajax({
            type:'Delete',
            url: 'shops/' + $(this).attr('value') ,
            datatype:'json',
            data:
            {
            '_token': '{{csrf_token()}}',
            id : $(this).attr('value')
            },
            success: function(res){
                    alert( res.message );
                    $("#test").modal("hide");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                let errors;
                errors = JSON.parse(XMLHttpRequest.responseText).errors;

                console.log(errors)

                Object.keys(errors).forEach(key => {
                    alert(errors[key])
                })
            }
        });
    });

</script>
</html>