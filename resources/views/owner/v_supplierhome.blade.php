<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-striped" id="table" style="width: 100%">
                    <button class="btn btn-success" id="btnModal">Tambah Supplier</button>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Rekening</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="judulModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('storeSupplier')}}" method="POST">
                @csrf
                <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama">
                </div>
                <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" name="telp" class="form-control" onkeypress="return inputAngka(event)" id="telp" placeholder="Masukkan No Telp">
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email">
                </div>
                <div class="form-group">
                <label for="Rekening">Rekening</label>
                <input type="text" name="rekening" class="form-control" onkeypress="return inputAngka(event)"  id="Rekening" placeholder="Masukkan no Rekening">
                </div>
                <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
</x-app-layout>
@stack('js')
<script src={{asset("plugins/datatables/jquery.dataTables.js")}}></script>
<script>
    $(document).ready(function () {

        loaddata()
    });
    
    function responsiveDatatable(){
        var table = $('#table').DataTable( {
            responsive: true
        } );
        
        new $.fn.dataTable.FixedHeader( table );
    }

    function loaddata()
    {
        $('#table').DataTable({
            serverside:true,
            processing:true,
            destroy:true,
            responsive:true,
            ajax: "{{route('getSupplier')}}",
            columns:[
                {data : 'DT_RowIndex', name: 'DT_RowIndex'},
                {data : 'nama', name: 'nama'},
                {data : 'telp', name: 'telp'},
                {data : 'email', name: 'email'},
                {data : 'rekening', name: 'rekening'},
                {data : 'alamat', name: 'alamat'},
                {data : 'aksi', name: 'aksi',orderable:false}
            ],
        });
    }

    function inputAngka(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
            if(charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
    }

    $('#btnModal').click(function (e) { 
        e.preventDefault();
        $('#modal').modal('show');
        
    });


    $(document).on('submit','form',function (e) {
        e.preventDefault();
        var data = new FormData(this)
        $.ajax({
            type: "post",
            url: "{{route('addSupplier')}}",
            data: data,
            dataType: "json",
            processData : false,
            contentType : false,
            success: function (response) {
                $('#modal').modal('hide');
                loaddata();
            },
            error : function (xhr) {  
                console.log(xhr)
            }
        });
    });



    // $(document).on('click', '.edit',function () {
      
   //    // $('#form').attr('action',"{{route('updateSupplier')}}") 
   //    let id = $(this).attr('id')
   //    $.ajax({
   //       type: "POST",
   //       url: "{{route('updateSupplier',['id' => $data->id])}}",
   //       data: {
   //          id : id,
   //          _token : "{{csrf_token()}}",
   //       },
   //       dataType: "json",
   //       success: function (res) {
   //          console.log(res)
   //          $('#modal').modal('show')
   //          $('#judulModal').html('Edit Supplier')
   //          $('#id').val(res.data.id)
   //          $('#nama').val(res.data.nama)
   //          $('#telp').val(res.data.telp)
   //          $('#alamat').val(res.data.alamat)
   //          $('#rekening').val(res.data.rekening)
   //          $('#email').val(res.data.email)
   //          $('#form').attr('action',"{{route('updateSupplier')}}") 
            
   //       // console.log(res) ;
   //       },error:function(xhr){
   //          console.log(xhr)
   //       },
   //    });
   // });



// $(document).on('click', '.hapus',function () {
//       let c = confirm('Yakin untuk menghapus ?')
//       // $('#form').attr('action',"{{route('updateSupplier')}}") 
//       let id = $(this).attr('id')
//       if (c){
//       $.ajax({
//          type: "POST",
//          url: "{{route('deleteSupplier')}}",
//          data: {
//             id : id,
//             _token : "{{csrf_token()}}",
//          },
//          dataType: "json",
//          success: function (res) {
//          console.log(res);
//          loaddata()
//          },error:function(xhr){
//             console.log(xhr)
//          },
//       });
//       }
//    });

</script>
