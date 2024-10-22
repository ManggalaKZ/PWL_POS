<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $activeMenu = 'barang';
        $breadcrumb = (object) [
            'title' => 'Data Barang',
            'list' => ['Home', 'Barang']
        ];
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        return view('barang.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'kategori' => $kategori
        ]);
    }
    public function list(Request $request)
    {
        $barang = BarangModel::select(
            'barang_id',
            'barang_kode',
            'barang_nama',
            'harga_beli',
            'harga_jual',
            'kategori_id'
        )->with('kategori');
        $kategori_id = $request->input('filter_kategori');
        if (!empty($kategori_id)) {
            $barang->where('kategori_id', $kategori_id);
        }
        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id
                    . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // ada teks html
            ->make(true);
    }
    public function create_ajax()
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        return view('barang.create_ajax')->with('kategori', $kategori);
    }
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => ['required', 'integer', 'exists:m_kategori,kategori_id'],
                'barang_kode' => [
                    'required',
                    'min:3',
                    'max:20',
                    'unique:m_barang,barang_kode'
                ],
                'barang_nama' => ['required', 'string', 'max:100'],
                'harga_beli' => ['required', 'numeric'],
                'harga_jual' => ['required', 'numeric'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            BarangModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function show_ajax(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);
        return view('barang.show_ajax', ['barang' => $barang]);
    }

    public function edit_ajax($id)
    {
        $barang = BarangModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('barang.edit_ajax', ['barang' => $barang, 'level' => $level]);
    }
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => ['required', 'integer', 'exists:m_kategori,kategori_id'],
                'barang_kode' => [
                    'required',
                    'min:3',
                    'max:20',
                    'unique:m_barang,barang_kode, ' . $id . ',barang_id'
                ],
                'barang_nama' => ['required', 'string', 'max:100'],
                'harga_beli' => ['required', 'numeric'],
                'harga_jual' => ['required', 'numeric'],
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = BarangModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
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
    public function confirm_ajax($id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', ['barang' => $barang]);
    }
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) { // jika sudah ditemuikan
                $barang->delete(); // barang di hapus
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
    public function import()
    {
        return view('barang.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_barang' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_barang'); // ambil file dari request
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
                            'kategori_id' => $value['A'],
                            'barang_kode' => $value['B'],
                            'barang_nama' => $value['C'],
                            'harga_beli' => $value['D'],
                            'harga_jual' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    BarangModel::insertOrIgnore($insert);
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
        // ambil data barang yang akan di export
        $barang = BarangModel::select('kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
            ->orderBy('kategori_id')
            ->with('kategori')
            ->get();

            // Load library PhpSpreadsheet
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet(); // Ambil sheet yang aktif

            // Set header kolom
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Kode Barang');
            $sheet->setCellValue('C1', 'Nama Barang');
            $sheet->setCellValue('D1', 'Harga Beli');
            $sheet->setCellValue('E1', 'Harga Jual');
            $sheet->setCellValue('F1', 'Kategori');
            $sheet->getStyle('A1:F1')->getFont()->setBold(true); // Bold header

            $no = 1; // Nomor data dimulai dari 1
            $baris = 2; // Baris data dimulai dari baris ke 2

            // Loop data barang dan masukkan ke dalam sheet
            foreach ($barang as $key => $value) {
                $sheet->setCellValue('A' . $baris, $no);
                $sheet->setCellValue('B' . $baris, $value->barang_kode);
                $sheet->setCellValue('C' . $baris, $value->barang_nama);
                $sheet->setCellValue('D' . $baris, $value->harga_beli);
                $sheet->setCellValue('E' . $baris, $value->harga_jual);
                $sheet->setCellValue('F' . $baris, $value->kategori->kategori_nama); // Ambil nama kategori
                $baris++;
                $no++;
            }

            // Set auto size untuk kolom A sampai F
            foreach (range('A', 'F') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            // Set judul sheet
            $sheet->setTitle('Data Barang');

            // Membuat writer untuk menulis file Excel
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filename = 'Data_Barang_' . date('Y-m-d_H-i-s') . '.xlsx';

            // Set header untuk download file Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1'); // Bypass cache IE
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Expired date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // Always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            // Simpan file ke output
            $writer->save('php://output');
            exit;
    }

    public function export_pdf()
    {
        // ambil data user yang akan di export
        $barang = BarangModel::select('barang_id', 'kategori_id', 'barang_kode','barang_nama','harga_beli','harga_jual',)
            ->orderBy('barang_id')
            ->get();

        // load library Dompdf
        $dompdf = new \Dompdf\Dompdf();

        // Create HTML content for the PDF
        $html = '<h1>Data Barang</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>barang_id</th>';
        $html .= '<th>kategori_id</th>';
        $html .= '<th>barang_kode</th>';
        $html .= '<th>barang_nama</th>';
        $html .= '<th>harga_beli</th>';
        $html .= '<th>harga_jual</th>';
        

        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1; // nomor data dimulai dari 1
        foreach ($barang as $barang) {
            $html .= '<tr>';
            $html .= '<td>' . $no . '</td>';
            $html .= '<td>' . htmlspecialchars($barang->barang_id) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($barang->kategori_id) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($barang->barang_kode) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($barang->barang_nama) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($barang->harga_beli) . '</td>'; // escape untuk keamanan
            $html .= '<td>' . htmlspecialchars($barang->harga_jual) . '</td>'; // escape untuk keamanan
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
        $filename = 'Data_Supplier_' . date('Y-m-d_H-i-s') . '.pdf';
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        echo $dompdf->output();
        exit;
    }
}