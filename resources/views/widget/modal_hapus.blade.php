<form action="{{url('delete_inventaris')}}" method="post" enctype='multipart/form-data'>
    @csrf
    <div class="form-group row">
        <label for="status_barang" class="col-sm-2 col-form-label">Status Barang</label>
        <div class="col-sm-10">
            <select class="form-control" id="status_barang" name="status_barang">
                <option value="">-- Pilih Status Barang --</option>
                @foreach($status_barang as $data)
                <option value="{{$data->id}}">{{$data->deskripsi}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="text" name="id_barang" id="id_barang" value="{{$inventory->id}}" hidden>
    <button type="submit" id="hapus-btn-submit" hidden></button>
</form>
