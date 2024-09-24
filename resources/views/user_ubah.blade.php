<!DOCTYPE html>
<html>

<head>
    <title>Ubah Data User</title>
</head>

<body>
    <h1>Form Ubah Data User</h1>
    <a href="/user">kembali</a>
    <br><br>
    <form method="post" action="/user/tambah/simpan//{{$data->user_id}}">

        {{csrf_field()}}
        {{method_field('PUT')}}

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username">
        <br>
        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama">
        <br>
        <label>Password</label>
        <input type="text" name="password" placeholder="Masukkan Password">
        <br>
        <label>Level ID</label>
        <input type="text" name="level_id" placeholder="Masukkan Level ID">
        <br><br>
        <input type="submit" class="btn btn-success" value="Ubah">
    </form>
</body>

</html>