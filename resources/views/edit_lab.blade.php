<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Data Lab</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        <form action="{{url('save_edit_lab')}}" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="form-group row">
                
                <label for="">Nama Laboratorium</label>
                <input type="text" name="nama_lab" id="nama_lab"
                    placeholder="Masukkan Nama Lab" class="form-control" value="{{$data_lab->nama_lab}}">
                <br>
            </div>
            <input type="text" name="id_lab" value="{{$data_lab->id}}" hidden>
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
        // var nama_lab = $("#nama_lab").val();
        // var nik_pegawai = $("#nik_pegawai").val();
        // var token = '{{ csrf_token() }}';
        // var my_url = "{{url('/cek_edit_nik')}}";
        // var formData = {
        //     '_token': token,
        //     'nama_lab': nama_lab,
        //     'nik_pegawai': nik_pegawai
        // };
        // $.ajax({
        //     method: 'POST',
        //     url: my_url,
        //     data: formData,
        //     success: function (resp) {
        //         if(resp.flag_status == 1){
        //             alert(resp.message);
        //         }
        //         else {
        //             alert(resp.message);
                alert('Data Lab Berhasil Diedit!');
                    $('#edit-btn-submit').click();
        //         }
        //     },
        //     error: function (resp) {
        //         console.log(resp);
        //     }
        // });
    }

</script>
