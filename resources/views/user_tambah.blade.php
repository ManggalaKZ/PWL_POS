<!DOCTYPE html>
<html>

<head>
    <title>Data User</title>
</head>

<body>
    <h1>Form Tambah Data User</h1>
    <form method="post" action="/user/tambah/simpan">
        {{csrf_field()}}

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
        <input type="submit" class="btn btn-success" value="Simpah">
    </form>
</body>

</html>