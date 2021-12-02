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
            <h4 id="judulModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
         <form id="form">
               @csrf
               <div class="form-group">
               {{-- <label for="nama">Kode</label> --}}
               <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
               <input type="hidden" class="form-control"  placeholder="Masukkan Nama" name="id" id="id">
               </div>
               <div class="form-group">
               <label for="nama">Nama</label>
               <input type="text" class="form-control"  placeholder="Masukkan Nama" name="nama" id="nama">
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
               <input type="text" name="rekening" class="form-control" onkeypress="return inputAngka(event)"  id="rekening" placeholder="Masukkan no Rekening">
               </div>
               <div class="form-group">
               <label for="alamat">Alamat</label>
               <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat">
               </div>
         </div>
         <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" id="btnSave">Save changes</button>
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

   var status = null
   let id = $(this).attr('id')
   var value = $('.edit').val()
   // new $.fn.dataTable.FixedHeader(table);
   
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
            // responsive:true,
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
      $('#form')[0].reset()
      $('#judulModal').html('Tambah Supplier');
      $('#modal').modal('show');
      status = 'c'
   });

   // $('.edit').click(function (e) { 
   //    e.preventDefault();
   //    status = 'u'
      
   //    $.ajax({
   //       type: "get",
   //       url: "apotik.test/api/supplier/" + btn,
   //       data: "data",
   //       dataType: "json",
   //       success: function (response) {
            
   //       }
   //    });
   // });

   $(document).on('click', '.edit',function () {
      status = 'u'
      let id = $(this).attr('id')
      var value = $('.edit').val()
      $.ajax({
         type: "get",
         url: "http://apotik.test/api/supplier/" + value,
         data: {},
         dataType: "json",
         success: function (res) {
            console.log(res)
            $('#modal').modal('show')
            $('#judulModal').html('Edit Supplier')
            $('#id').val(res.data.id)
            $('#nama').val(res.data.nama)
            $('#telp').val(res.data.telp)
            $('#alamat').val(res.data.alamat)
            $('#rekening').val(res.data.rekening)
            $('#email').val(res.data.email)
            console.log(value)
         // console.log(res) ;
         },error:function(xhr){
            console.log(xhr)
         },
      });
   });



      $(document).on('click', '.hapus',function () {
      let id = $(this).attr('id')
      var value = $('.edit').val()

      Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               type: "delete",
               url: "http://apotik.test/api/deleteSupplier/" + value,
               data: {
                     _token : "{{csrf_token()}}",
                     },
               dataType: "json",
               success: function (res) {
                  Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                  )
                  loaddata();
               }
            });
         };
         });
      });












            




            

   $('#btnSave').click(function (e) { 
      
      e.preventDefault();
      var value = $('.edit').val()
      if(status == 'c'){
         $.ajax({
            type: "post",
            url: "{{route('addSupplier')}}",
            data: {
               nama : $('#nama').val(),
               telp : $('#telp').val(),
               email : $('#email').val(),
               rekening : $('#rekening').val(),
               alamat : $('#alamat').val(),
               _token : "{{csrf_token()}}",

            },
            dataType: "json",
            success: function (response) {
               $('#modal').modal('hide');
               loaddata()
               Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Data berhasil ditambah',
               showConfirmButton: false,
               timer: 1500
               })
            }
         });
      } else if (status == 'u'){
         $.ajax({
            type: "post",
            url: "http://apotik.test/api/updateSupplier/" + value,
            data: {
               nama : $('#nama').val(),
               telp : $('#telp').val(),
               email : $('#email').val(),
               rekening : $('#rekening').val(),
               alamat : $('#alamat').val(),
               _token : "{{csrf_token()}}",
            },
            dataType: "json",
            success: function (response) {
               $('#modal').modal('hide')
               loaddata()
               Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Data berhasil diupdate ',
               showConfirmButton: false,
               timer: 1500
               })
            }
         });
      }
      
   });
   // $(document).on('submit','form',function (e) {
   //    e.preventDefault();
   //    var data = new FormData(this)
   //    $.ajax({
   //       type: "post",
   //       url: $(this).attr('action'),
   //       data: data,
   //       dataType: "json",
   //       processData : false,
   //       contentType : false,
   //       success: function (response) {
   //             $('#modal').modal('hide');
   //             loaddata();
   //       },
   //       error : function (xhr) {  
   //             console.log(xhr)
   //       }
   //    });
   // });

   
   
</script>

      
   @endpush
</x-app-layout>