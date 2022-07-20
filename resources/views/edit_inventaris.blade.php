<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Data Inventaris</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        <form action="{{url('save_edit_inventaris')}}" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="form-group row">
                
                <label for="">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang"
                    placeholder="Masukkan Nama Lab" class="form-control" value="{{$inventory->nama_barang}}">
                <br>
            </div>
            <div class="form-group row">
                
                <label for="">Jumlah Barang</label>
                <input type="text" name="jumlah_barang" id="jumlah_barang"
                    placeholder="Masukkan jumlah Lab" class="form-control" value="{{$inventory->jumlah_barang}}">
                <br>
            </div>
            <input type="text" name="id" value="{{$inventory->id}}" hidden>
            <input type="submit" value="" hidden id="edit-btn-submit">
        </form>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-success" onclick="saveForm()">Save</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<script>
    function saveForm(){
        alert('Data Inventaris Berhasil Diedit!');
        $('#edit-btn-submit').click();
    }

</script>
