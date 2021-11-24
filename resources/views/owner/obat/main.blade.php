<x-app-layout title="Katalog Obat">
   
   {{-- @slot('header')
   <div class="container-fluid mx-2  p-2">
      <h1>Data Obat</h1>
   </div>
   @endslot --}}
   
   {{-- <button class="btn btn-success" id="btnModal">Tambah</button> --}}
   <div class="container-fluid mx-2  p-2">
   </div>

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header text-center">
            <h1 class="card-title font-weight-bold">Data Obat</h1>
         </div> 
         <div class="card-body">
            <button class="btn btn-success" id="btnModal">Tambah</button>
            <table id="table" class="table table-bordered table-hover">
               <thead>
               <tr>
                  <th>Nama</th>
                  <th>Kode</th>
                  <th>Dosis</th>
                  <th>Indikasi</th>
                  <th>Kategori</th>
                  <th>Satuan</th>
                  <th>Aksi</th>
               </tr>
               </thead>
               <tfoot>
               <tr>
                  <th>Nama</th>
                  <th>Kode</th>
                  <th>Dosis</th>
                  <th>Indikasi</th>
                  <th>Kategori</th>
                  <th>Satuan</th>
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
         <form action="{{route('storeObat')}}" method="post" id="form">
               @csrf
               <div class="form-group">
               <label for="id">id</label>
               <input type="text" class="form-control"  placeholder="Kode" name="id" id="id" readonly="re">
               </div>
               <div class="form-group">
               <label for="nama">Nama</label>
               <input type="text" class="form-control"  placeholder="Masukkan Nama" name="nama" id="nama">
               </div>
               <div class="form-group">
               <label for="telepon">Kode</label>
               <input type="text" name="kode" maxlength="8" class="form-control" id="kode" placeholder="Masukkan No Kode">
               </div>
               <div class="form-group">
               <label for="dosis">Dosis</label>
               <input type="text" name="dosis" class="form-control" id="dosis" placeholder="Masukkan dosis">
               </div>
               <div class="form-group">
               <label for="indikasi">Indikasi</label>
               <input type="text" name="indikasi" class="form-control"  id="indikasi" placeholder="Masukkan no indikasi">
               </div>
               <div class="form-row">
               <div class="form-group col-6">
               <label for="Satuan">Satuan</label>
               <select name="satuan" id="satuan" class="form-control">
                  <option value="">Pilih Satuan</option>
                  @foreach ($satuan as $a )
                     <option value="{{$a->id}}">{{$a->satuan}}</option>
                  @endforeach
               </select>
               </div>
               <div class="form-group col-6">
               <label for="kategori">Kategori</label>
               <select name="kategori" id="kategori" class="form-control">
                  <option value="">Pilih kategori</option>
                  @foreach ($kategori as $a )
                     <option value="{{$a->id}}">{{$a->kategori}}</option>
                  @endforeach
               </select>
               </div>
               </div>
               
         </div>
         <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
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
            ajax: "{{route('getObat')}}",
            columns:[
               // {data : 'DT_RowIndex', name: 'DT_RowIndex'},
               {data : 'nama', name: 'nama'},
               {data : 'kode', name: 'kode'},
               {data : 'dosis', name: 'dosis'},
               {data : 'indikasi', name: 'indikasi'},
               {data : 'kategori', name: 'kategoris'},
               {data : 'satuan', name: 'satuans'},
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
      $('#judulModal').html('Tambah Obat');
      e.preventDefault()
      $('#form')[0].reset()
      $('#modal').modal('show');
      
   });


   $(document).on('submit','form',function (e) {
      e.preventDefault();
      var data = new FormData(this)
      $.ajax({
         type: "post",
         url: $(this).attr('action'),
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

   
   $(document).on('click', '.edit',function () {
      
      // $('#form').attr('action',"{{route('updateSupplier')}}") 
      let id = $(this).attr('id')
      $.ajax({
         type: "POST",
         url: "{{route('editObat')}}",
         data: {
            id : id,
            _token : "{{csrf_token()}}",
         },
         dataType: "json",
         success: function (res) {
            console.log(res)
            $('#modal').modal('show')
            $('#judulModal').html('Edit Obat')
            $('#id').val(res.data.id)
            $('#nama').val(res.data.nama)
            $('#kode').val(res.data.kode)
            $('#dosis').val(res.data.dosis)
            $('#indikasi').val(res.data.indikasi)
            $('#satuan').val(res.data.satuan)
            $('#kategori').val(res.data.kategori)
            $('#form').attr('action',"{{route('updateObat')}}") 
            
         // console.log(res) ;
         },error:function(xhr){
            console.log(xhr)
         },
      });
   });



$(document).on('click', '.hapus',function () {
      let c = confirm('Yakin untuk menghapus ?')
      // $('#form').attr('action',"{{route('updateSupplier')}}") 
      let id = $(this).attr('id')
      if (c){
      $.ajax({
         type: "POST",
         url: "{{route('deleteObat')}}",
         data: {
            id : id,
            _token : "{{csrf_token()}}",
         },
         dataType: "json",
         success: function (res) {
         console.log(res);
         loaddata()
         },error:function(xhr){
            console.log(xhr)
         },
      });
      }
   });
</script>

      
   @endpush
</x-app-layout>