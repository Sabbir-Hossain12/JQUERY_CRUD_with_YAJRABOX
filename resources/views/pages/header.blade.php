<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">--}}
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Employee Registation</h4>
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-database-add"></i> ADD
                    </button>
                </div>
                <div class="card-body">
                    <table class="table" id="headerTable">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">TITLE 1</th>
                            <th scope="col">Short Description</th>
                            <th scope="col">Button Link</th>
                            <th scope="col">Button Text</th>
                            <th scope="col">Action</th>
                          
                        </tr>
                        </thead>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="form" id="headerAddForm">
                            @csrf
                            <div class="row">
                                <div class="col-lg">
                                    <label>Title 1</label>
                                    <input type="text" name="title1" id="name" class="form-control">
                                </div>
                                <div class="col-lg">
                                    <label>Short Description</label>
                                    <textarea name="Short_desc" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <label>Button Link</label>
                                    <input type="text" name="btn_link"  class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <label>Button Text</label>
                                    <input type="text" name="btn_text"  class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="headerFormUpdate" >
                    @csrf
                    @method("PUT")
                    <input type="text" id="edit-id" name="id">
                    <div class="row">
                        <div class="col-lg">
                            <label>Title 1</label>
                            <input type="text" name="title1" id="title1" class="form-control">
                        </div>
                        <div class="col-lg">
                            <label>Short Description</label>
                            <textarea name="Short_desc" id="Short_desc" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Button Link</label>
                            <input type="text" name="btn_link" id="btn_link" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label>Button Text</label>
                            <input type="text" name="btn_text" id="btn_text"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script>
    


//Render Datatables
        let headerTable = $('#headerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('get-header-data')}}",
     

        columns: [
            {
                data: 'id',


            },
            {
                data: 'title1',

            },
            {
                data: 'Short_desc',

            },
            {
                data:'btn_link'
            },
            {
                data:'btn_text'
            },
          

            {
                data: 'action',
                name: 'Action',
                orderable: false,
                searchable: false
            },

        ]})
        
    //Add Header
    
        $('#headerAddForm').submit(function (e)
        { 
            
            e.preventDefault();

            $.ajax(
                {
                    url: "{{route('header.store')}}",
                    type:'POST',
                    data: new FormData(this),
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res)
                    {
                        console.log('success')

                        $('#exampleModal').modal('hide');
                        $('#headerAddForm')[0].reset();
                       
                        headerTable.ajax().reload();
                        
                    },
                    error: function (err)
                    
                    {
                        console.log(err);
                    }
                    
                    
                }
            )

            
        })





//Read Header
$(document).on('click', '.edit-btn', function () {
    let id = $(this).data('id');
    $('#id').val(id);

    $.ajax(
        {
            type: "GET",
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            url: "{{ url('headers') }}/" + id + "/edit",
            {{--url: "{{ route('header.edit',) }},--}}
            // data: {
            //     id: id
            // },

            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {

                $('#title1').val(res.data.title1);
                $('#Short_desc').val(res.data.Short_desc);
                $('#btn_link').val(res.data.btn_link);
                $('#btn_text').val(res.data.btn_text);
                $('#edit-id').val(res.data.id);
                
            },
            error: function (err) {
                console.log('failed')
            }
        }
    )
})

//update Header

$('#headerFormUpdate').submit(function (e)
{

    e.preventDefault();
    console.log('works')

    let id = $('#edit-id').val();
    $.ajax(
        {
            url: "{{ url('headers') }}/" + id,
            {{--url: "{{route('header.update',)}}",--}}
            type:'POST',
            data: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res)
            {
                console.log('success')

                $('#editModal').modal('hide');
                $('#headerFormUpdate')[0].reset();

                headerTable.ajax.reload();

            },
            error: function (err)

            {
                console.log(err);
            }


        }
    )


})
     
//Delete Header




   
    
    
</script>

</body>
</html>