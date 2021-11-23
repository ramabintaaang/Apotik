<x-app-layout title="Supplier">
   
   @slot('header')
   <div class="container-fluid mx-2  p-2">
      <h1>Data Supplier</h1>
   </div>
   @endslot
   

   <div class="container-fluid mx-2  p-2">
      <button class="btn btn-success" id="btnModal">Tambah Supplier</button>
   </div>

   <div class="row">
      <div class="col-12">
         <div class="card">
         {{-- <div class="card-header">
            <h3 class="card-title">DataTable with minimal features & hover style</h3>
         </div> --}}
         <!-- /.card-header -->
         <div class="card-body">
            <table id="table" class="table table-bordered table-hover">
               <thead>
               <tr>
                  <th>Nama</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Rekening</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
               </tr>
               </thead>
               <tfoot>
               <tr>
                  <th>Nama</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Rekening</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
               </tr>
               </tfoot>
            </table>
         </div>
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


   @push('js')
   <script>
   $(document).ready(function () {
      loaddata()
   });

   // new $.fn.dataTable.FixedHeader( table );
   
   // function responsiveDatatable(){
      
   //    new $.fn.dataTable.FixedHeader( table );
   // }

   function loaddata()
   {
      $('#table').DataTable({
            paging : true,
            serverside:true,
            processing:true,
            destroy:true,
            responsive:true,
            ajax: "{{route('getSupplier')}}",
            columns:[
               // {data : 'DT_RowIndex', name: 'DT_RowIndex'},
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
         url: "{{route('storeSupplier')}}",
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

</script>

      
   @endpush
</x-app-layout>