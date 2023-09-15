<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Laravel Yajara Datatable Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/datepicker.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
   
    {{-- <script src="{{asset('js/jquery.min.js')}}"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    {{-- <script src="{{asset('js/datepicker.js')}}"></script> --}}
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
  </head>
  <body>
    <nav class="navbar navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{route('users')}}">Laravel Yajara Datatable Example</a>
      </div>
    </nav>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-lg-2"></div>
        <div class="col-md-8 col-sm-12 col-lg-8">
            <div class="card p-3">
                <div class="card-header">
                    <div class="row">
                        
                        <div class="col-lg-12 mt-3">
                            <div class="pull-left mb-2">
                                <h2>Laravel Yajara Datatable Example</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" id="search-date" class="form-control m-3"
                    value="" name="date"
                    placeholder="search by date" readonly><button id="search-datebtn" class="btn btn-info">Search</button>
                    <table class="table table-bordered table-striped" id="datacustom">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Registered At</th>
                            <th>Action</th>
                        </thead>

                      
                        
                    </table>

                   
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-12 col-lg-2"></div>
    </div>
    
<script>
      $(function () {
      var table = $('#datacustom').DataTable({
          processing: true,
          serverSide: true,
       
          "ajax":{
            "url":"{{ route('users') }}",
            "type": "GET",         
        //   success:function(data)
        //   {
        //  console.log(data);
        //   },
            error:function(msg)
            {
                var errors = msg.responseJSON;
                console.log(errors);
            },
            },
          columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
             }],    
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
              {data: 'name', name: 'name',orderable: true,searchable : true},
              {data: 'email', name: 'email',orderable: true,searchable : true},             
              {data: 'date', name: 'created_at',orderable: true,searchable : true},
              {data: 'action', name: 'action',orderable: false,searchable : false},
           
             
          ],
       
      });
      $('#search-datebtn').click(function(e)
      {
       e.preventDefault();
       var date = $('#search-date').val();
       table.ajax.url("{{ route('users') }}?date="+date).load();
      })
    });
</script>

<script>
    $(function () {
           //Date range picker
           $('#search-date').daterangepicker({
               autoUpdateInput: false,
               locale: {
                   cancelLabel: 'Clear',
                   format: 'YYYY-MM-DD'
               },
               onSelect: function (dateText, inst) {
                   // console.log($('#search-date').val()); // <-- SUBMIT LIKE THIS

               },
               maxDate: new Date(),
           })
       });
       $('#search-date').on('apply.daterangepicker', function (ev, picker) {
               $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
           });

       $('#search-date').on('cancel.daterangepicker', function (ev, picker) {
           $(this).val('');
       });
//$("#kt_datatable_example_1").DataTable();

</script>
</body>
</html>