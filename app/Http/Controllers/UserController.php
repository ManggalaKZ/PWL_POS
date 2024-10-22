<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Spreadsheet;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        $level = LevelModel::all();

        return view('user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Ambil data user dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        // Mengambil data user beserta relasi 'level' menggunakan ORM Eloquent
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id', 'avatar')
            ->with('level');

        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            // Menambahkan kolom aksi (tombol-tombol edit, detail, hapus)
            ->addColumn('aksi', function ($user) {
                // Tombol detail
                /*$btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a>';
                // Tombol edit
                $btn .= ' <a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
                // Tombol hapus (menggunakan form POST dengan metode DELETE)
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';*/
                $btn  = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/show_ajax') . '\')" class="btn btn-info btn-sm" title="Detail User">Detail</button>';
                $btn .= ' <button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm" title="Edit User">Edit</button>';
                $btn .= ' <button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm" title="Hapus User">Hapus</button>';
                return $btn;
            })
            // Memberitahu bahwa kolom aksi adalah HTML
            ->rawColumns(['aksi'])
            // Membuat data dalam bentuk JSON yang digunakan oleh DataTables
            ->make(true);
    }

    // Menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); // Ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // Set menu yang sedang aktif

        return view('user.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'username' => 'required|string|min:3|unique:m_user,username',
            // nama harus diisi, berupa string, dan maksimal 100 karakter
            'nama' => 'required|string|max:100',
            // password harus diisi dan minimal 5 karakter
            'password' => 'required|min:5',
            // level_id harus diisi dan berupa angka
            'level_id' => 'required|integer',
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    // Menampilkan detail user
    public function show(string $id)
    {
        // Mengambil data user beserta level-nya menggunakan relasi 'level'
        $user = UserModel::with('level')->find($id);

        // Membuat breadcrumb
        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        // Menentukan judul halaman
        $page = (object) [
            'title' => 'Detail user'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Mengarahkan ke view dengan data yang dibutuhkan
        return view('user.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        // Ambil data user berdasarkan ID
        $user = UserModel::find($id);

        // Ambil semua data level untuk dropdown pilihan
        $level = LevelModel::all();

        // Membuat breadcrumb untuk navigasi
        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        // Menentukan judul halaman
        $page = (object) [
            'title' => 'Edit user'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Mengarahkan ke view 'user.edit' dengan data yang dibutuhkan
        return view('user.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        // Validasi input form
        $request->validate([
            // username harus unik kecuali user yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            // nama harus diisi, maksimal 100 karakter
            'nama' => 'required|string|max:100',
            // password bisa diisi (minimal 5 karakter) atau bisa dikosongkan
            'password' => 'nullable|min:5',
            // level_id harus diisi dan berupa angka
            'level_id' => 'required|integer'
        ]);

        // Update data user
        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        // Redirect kembali ke halaman daftar user dengan pesan sukses
        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id)
    {
        // Mengecek apakah data user dengan id yang dimaksud ada atau tidak
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            // Hapus data user
            UserModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
            ->with('level', $level);
    }

    public function show_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();
        return view('user.show_ajax', ['user' => $user, 'level' => $level]);
    }

    public function store_ajax(Request $request)
    {
        // Cek apakah request berupa Ajax
        if ($request->ajax() || $request->wantsJson()) {
            // Aturan validasi
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ];

            // Menggunakan Validator untuk memvalidasi input
            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal, kembalikan respon JSON dengan pesan error
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            // Simpan file gambar jika ada
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                // Simpan ke folder 'profile' dalam disk 'public'
                $avatarPath = $request->file('avatar')->store('profile', 'public');
            }

            // Jika validasi berhasil, simpan data user
            UserModel::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => bcrypt($request->password), // pastikan password dienkripsi
                'level_id' => $request->level_id,
                'avatar' => $avatarPath,
            ]);

            // Kembalikan respon JSON berhasil
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan',
                'avatar' => $avatarPath,
            ]);
        }

        // Jika bukan request Ajax, redirect ke halaman utama
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        // Retrieve the user by ID, or return a 404 if not found
        $user = UserModel::findOrFail($id);

        // Retrieve all levels for the dropdown selection
        $levels = LevelModel::select('level_id', 'level_nama')->get();

        // Return the edit view with user and levels data
        return view('user.edit_ajax', [
            'user' => $user,
            'levels' => $levels
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // Check if the request is from Ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer', // Fixed typo and formatting
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id', // Fixed formatting
                'nama' => 'required|max:100', // Fixed formatting
                'password' => 'nullable|min:5|max:20', // Fixed formatting
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ];

            // Use the Validator facade
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // JSON response: true for success, false for failure
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Show which fields have errors
                ]);
            }

            $user = UserModel::find($id);
            if ($user) {
                // If password is not filled, remove it from the request
                if (!$request->filled('password')) {
                    $request->request->remove('password');
                }
            } else {
                // Enkripsi password jika diisi
                $request['password'] = bcrypt($request->password);
            }

            // Simpan file gambar jika ada
            // Simpan file gambar jika ada
            $avatarPath = $user->avatar; // tetap gunakan avatar lama jika tidak diupload yang baru
            if ($request->hasFile('avatar')) {
                // Hapus avatar lama jika ada
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                // Simpan avatar baru ke folder 'profile' dalam disk 'public'
                $avatarPath = $request->file('avatar')->store('profile', 'public');
            }
            // Update user data
            $user->update([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => $request->password ? bcrypt($request->password) : $user->password, // Enkripsi jika password diisi
                'level_id' => $request->level_id,
                'avatar' => $avatarPath,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate',
                'avatar' => $user->avatar
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return redirect('/'); // Redirect if not an AJAX request
    }

    public function confirm_ajax(string $id)
    {
        $user = UserModel::find($id); // Fixed syntax error with the assignment operator
        return view('user.confirm_ajax', ['user' => $user]); // Clean and clear return statement
    }

    public function delete_ajax(Request $request, $id)
    {
        // Check if the request is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);

            if ($user) {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

    public function create_register()
    {
        $levels = LevelModel::all(); // Retrieve levels for the dropdown
        return view('user.create_register', ['levels' => $levels]);
    }

    public function store_register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'redirect' => url('/user')
        ]);
    }

    public function import()
    {
        return view('user.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_user' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_user'); // ambil file dari request
            $reader = IOFactory::createReader('Xlsx'); // load reader file excel
            $reader->setReadDataOnly(true); // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
            $data = $sheet->toArray(null, false, true, true); // ambil data excel
            $insert = [];
            if (count($data) > 1) { // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'level_id' => $value['A'],
                            'username' => $value['B'],
                            'nama' => $value['C'],
                            'password' => bcrypt('default_password'), // Adjust the password if necessary
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    UserModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        // ambil data user yang akan di export
        $users = UserModel::select('level_id', 'username', 'nama', 'password')
            ->orderBy('level_id')
            ->with('level')
            ->get();

        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Username');
        $sheet->setCellValue('C1', 'Nama user');
        $sheet->setCellValue('D1', 'Password');
        $sheet->setCellValue('E1', 'Level');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // bold header

        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $user->username);
            $sheet->setCellValue('C' . $baris, $user->nama);
            $sheet->setCellValue('D' . $baris, $user->password);
            $sheet->setCellValue('E' . $baris, $user->level->level_nama); // ambil nama kategori
            $baris++;
            $no++;
        }

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }

        $sheet->setTitle('Data User');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data_user_' . date('Y-m-d_H-i-s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        // ambil data user yang akan di export
        $users = UserModel::select('level_id', 'username', 'nama', 'password')
            ->orderBy('level_id')
            ->with('level')
            ->get();

        // load library Dompdf
        $dompdf = new \Dompdf\Dompdf();

        // Create HTML content for the PDF
        $html = '<h1>Data User</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>Username</th>';
        $html .= '<th>Nama User</th>';
        $html .= '<th>Password</th>';
        $html .= '<th>Level</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1; // nomor data dimulai dari 1
        foreach ($users as $user) {
            $html .= '<tr>';
            $html .= '<td>' . $no . '</td>';
            $html .= '<td>' . htmlspecialchars($user->username) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($user->nama) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($user->password) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($user->level->level_nama) . '</td>'; // escape untuk keamanan
            $html .= '</tr>';
            $no++;
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $filename = 'Data_user_' . date('Y-m-d_H-i-s') . '.pdf';
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        echo $dompdf->output();
        exit;
    }
}
