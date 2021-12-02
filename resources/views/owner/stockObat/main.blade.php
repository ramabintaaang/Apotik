<x-app-layout title="Katalog Obat">
   
   {{-- @slot('header')
   <div class="container-fluid mx-2  p-2">
      <h1>Data Obat</h1>
   </div>
   @endslot --}}
   
   {{-- <button class="btn btn-success" id="btnModal">Tambah</button> --}}
   <div class="container-fluid mx-2  p-2">
   </div>

   <div class="container-fluid">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h1 class="card-title">Form stock obat</h1>
            </div>
            <div class="card-body">
               <div class="input-group input-group-sm">
                  <label for="" class="col-sm-1 col-form-label-lg-sm">Nama Obat</label>
                  <input type="text" class="form-control col-sm-3" id="nama_obat" readonly>
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" id="btnModalNamaObat"><i class="fas fa-search"></i></button>
                  </span>
                </div>
               {{-- <div class="input-group input-group-sm">
                  <label for="" class="col-sm-1 col-form-label-lg-sm">Nama Obat</label>
                  <input type="text" class="form-control col-sm-3" id="nama_obat" readonly>
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" id="btnModalNamaObat"><i class="fas fa-search"></i></button>
                  </span>
                </div>
            </div> --}}
         </div>
      </div>
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
                  <th>Stock</th>
                  <th>Harga beli</th>
                  <th>Harga beli</th>
                  <th>Aksi</th>
               </tr>
               </thead>
               <tfoot>
               <tr>
                  <th>Nama</th>
                  <th>Stock</th>
                  <th>Harga beli</th>
                  <th>Harga beli</th>
                  <th>Aksi</th>
               </tr>
               </tfoot>
            </table>
         </div>
         </div>
      </div>
   </div>




 @include('owner.stockObat.modalNamaObat')
 @include('owner.stockObat.modalMain')

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
            responsive:true,
            ajax: "{{route('getStockObat')}}",
            columns:[
               // {data : 'DT_RowIndex', name: 'DT_RowIndex'},
               {data : 'nama', name: 'nama'},
               {data : 'stok', name: 'stok'},
               {data : 'harga_beli', name: 'harga_beli'},
               {data : 'harga_jual', name: 'harga_jual'},
               // {data : 'kategori', name: 'kategoris'},
               // {data : 'satuan', name: 'satuans'},
               {data : 'aksi', name: 'aksi',orderable:false}
            ],
      });
   }

   function getNamaObat()
   {
      $('#dt_namaobat').DataTable({
            paging : true,
            serverside:true,
            processing:true,
            destroy:true,
            // responsive:true,
            ajax: "{{route('getNamaObat')}}",
            columns:[
               // {data : 'DT_RowIndex', name: 'DT_RowIndex'},
               {data : 'nama', name: 'nama'},
               {data : 'kategori', name: 'kategoris'},
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

$('#btnModalNamaObat').click(function (e) { 
   $('#modalNamaObat').modal('show')
   getNamaObat()
});

$(document).on('click','.klik', function () {
   let z = $(this).attr('value')
   // let x = $(this).attr('value')
   $('#nama_obat').val(z)
   $('#modalNamaObat').modal('hide')

   console.log(z)
   // console.log(x)
});

</script>

      
   @endpush
</x-app-layout>