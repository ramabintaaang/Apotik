
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
               </select>
               </div>
               <div class="form-group col-6">
               <label for="kategori">Kategori</label>
               <select name="kategori" id="kategori" class="form-control">
                  <option value="">Pilih kategori</option>
                  {{-- @foreach ($kategori as $a )
                     <option value="{{$a->id}}">{{$a->kategori}}</option>
                  @endforeach --}}
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