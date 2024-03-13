@extends('layouts.admin.master')
@section('content')
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <a href="{{route('admin.questions.create')}}" class="btn btn-primary">Add Questionnaire</a>
              </h4>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Questionnaire</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="questions-datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>S.No</th>
                        <th>Question</th>
                        <th>User Type</th>
                      <th>Created By</th>
                        <th>Created At</th>
                        {{--<th>Updated By</th>
                        <th>Updated At</th> --}}
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function(){

        if ($("#questions-datatable").length > 0) {
            /*Checkbox Add*/
            var tdCnt=0;
            var targetDt = $('#questions-datatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: "{{route('admin.questions')}}",

                columns: [

                        //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'check', name: 'check'},

                        {data: 'q_id', name: 'q_id'},

                        {data: 'question', name: 'question'},

                        {data: 'user_type', name: 'user_type'},

                        {data: 'created_by', name: 'created_by'},

                        {data: 'created_at', name: 'created_at'},

                        // {data: 'updated_by', name: 'updated_by'},

                        // {data: 'updated_at', name: 'updated_at'},

                        {data: 'action', name: 'action'},

                    ],
                    // dom: 'Bfrtip',
                    // buttons: [
                    //       'copy', 'csv', 'excel', 'pdf', 'print'
                    // ],


                "ordering": true,

                "columnDefs": [ {
                    "searchable": false,
                    "orderable": true,
                    "targets": [0,3]
                } ],

            });
        }
        $(document).on('click', '.statusBtn', function (event) {

var id = $(this).attr('data-id');
var type =$(this).attr('data-type');
//  alert(user_id);
var table = 'questions';
swal({
    // icon: "warning",
    type: "warning",
    title: " Are You Sure Want to change the Status?",
    text: "",
    dangerMode: true,
    showCancelButton: true,
    confirmButtonColor: "#007358",
    confirmButtonText: "YES",
    cancelButtonText: "CANCEL",
    closeOnConfirm: false,
    closeOnCancel: false
},
function(e){
    if(e==true)
    {
        $.ajax({
            type:'POST',
            url: "{{route('admin.status-action')}}",
            data: {"_token" : "{{ csrf_token() }}",'id':id,'table_name':table,'type':type},
            success: function (response) {

                //console.log(response);
                if (response.success) {
                    // window.setTimeout(function(){
                    //    location.reload();
                    // },2000);
                    // toastr.success("Status Changed Successfully");

                    if(response.type=='enable')
                    {
                        $('table.categoryTable tr').find("[data-ac='" + id + "']").fadeIn("slow");
                        $('table.categoryTable tr').find("[data-ac='" + id + "']").removeClass("d-none");

                        $('table.categoryTable tr').find("[data-dc='" + id + "']").fadeOut("slow");

                        $('table.categoryTable tr').find("[data-dc='" + id + "']").addClass("d-none");

                    }
                    else if(response.type=='disable')
                    {
                        $('table.categoryTable tr').find("[data-dc='" + id + "']").fadeIn("slow");
                        $('table.categoryTable tr').find("[data-dc='" + id + "']").removeClass("d-none");

                        $('table.categoryTable tr').find("[data-ac='" + id + "']").fadeOut("slow");

                        $('table.categoryTable tr').find("[data-ac='" + id + "']").addClass("d-none");
                    }

                    toastr.success(response.message);

                    window.setTimeout(()=>{
                        window.location.reload();
                    },2000);
                }
                else {

                }

                swal.close();

            },
            error: function (xhr, textStatus, errorThrown) {
                // alert("Error: " + errorThrown);
            }

        });
    }
    else
    {
        swal.close();
    }
});

});
        $(document).on('click','.deleteBtn',function(){

            var _this=$(this);
            // var result=confirm("Are You Sure You Want to Delete?");
            var id = $(this).data('id');
            var table = 'questions';
            swal({
                    // icon: "warning",
                    type: "warning",
                    title: "Are You Sure You Want to Delete?",
                    text: "",
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonColor: "#007358",
                    confirmButtonText: "YES",
                    cancelButtonText: "CANCEL",
                    closeOnConfirm: false,
                    closeOnCancel: false
                    },
                    function(e){
                        if(e==true)
                        {
                            _this.addClass('disabled-link');
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "{{route('admin.delete-action')}}",
                                data: {"_token": "{{ csrf_token() }}",'id': id,'table_name':table},
                                success: function(data){
                                    console.log(data);
                                    window.setTimeout(function(){
                                    _this.removeClass('disabled-link');
                                    },2000);

                                    if(data.code==200)
                                    {
                                        window.setTimeout(function(){
                                            window.location.reload();
                                        },2000);
                                    }
                                },
                                error : function(response)
                                {
                                    console.log(response);
                                }
                            });
                            swal.close();
                        }
                        else
                        {
                            swal.close();
                        }
                    }
            );
        });
    });
    </script>
@endpush
