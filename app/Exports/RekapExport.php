<?php

namespace App\Exports;

use App\Dosen;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;




class RekapExport implements FromView,WithEvents
{
  
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $request;

    public function __construct($request)
    {
       $this->request = $request;
     
    }

    public function view(): View
    {
        $pilih_prodi = $this->request->pilih_prodi;
        $pilih_tahun = $this->request->pilih_tahun;
        $pilih_semester = $this->request->pilih_semester;
        if ($pilih_semester == 'ganjil'){
            $pilih_semester = ['1','3','5','7'];
        }else{
            $pilih_semester = ['2','4','6','8'];
        }
        $data['dosen'] = DB::table('dosen');
        $data['pilih_tahun'] = DB::table('sebaran')->orderBy('tahun_akademik')->groupBy('tahun_akademik')->get();
        $data['pilih_prodi'] = DB::table('sebaran')
                                ->join('prodi','sebaran.prodi','=','prodi.id')
                                ->select('prodi.id','prodi.nama')
                                ->orderBy('prodi.id')->groupBy('prodi.id')->get();
        $get_prodiAndDosen = DB::table('sebaran')
                            ->join('prodi','sebaran.prodi', '=', 'prodi.id')
                            ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                            ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                            ->select('dosen.name','dosen.nidn','dosen.jenis_kelamin','dosen.status','prodi.nama','dosen.id','dosen.bidang')
                            ->groupBy('nidn');
        if($pilih_prodi){$get_prodiAndDosen = $get_prodiAndDosen->where('sebaran.prodi',$pilih_prodi);} 
        if($pilih_tahun){$get_prodiAndDosen = $get_prodiAndDosen->where('sebaran.tahun_akademik',$pilih_tahun);} 
        if($pilih_semester){$get_prodiAndDosen = $get_prodiAndDosen->whereIn('sebaran.semester',$pilih_semester);}
    
        $get_prodiAndDosen = $get_prodiAndDosen->get();
       
        foreach($get_prodiAndDosen as &$dosen)
        {
        
            $dosen->jumlah_jam = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->join('kelas','sebaran.kd_kelas','=','kelas.id')
                                ->select('kelas.keterangan','dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->where('kelas.keterangan','reguler')->sum('jam_minggu'); 
            $dosen->jumlah_jam_karyawan = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->join('kelas','sebaran.kd_kelas','=','kelas.id')
                                ->select('kelas.keterangan','dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->where('kelas.keterangan','karyawan')->sum('jam_minggu');
            $dosen->total_jam = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->select('dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->sum('jam_minggu');

            $dosen->tahun_akademik = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->select('tahun_akademik')->groupBy('tahun_akademik')->get();
            $dosen->jumlah_sks = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->join('kelas','sebaran.kd_kelas','=','kelas.id')
                                ->select('kelas.keterangan','dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->where('kelas.keterangan','reguler')->sum('sks');
            $dosen->jumlah_sks_karyawan = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->join('kelas','sebaran.kd_kelas','=','kelas.id')
                                ->select('kelas.keterangan','dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->where('kelas.keterangan','karyawan')->sum('sks');
            $dosen->total_sks = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->select('kelas.keterangan','dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->sum('sks');
            $dosen->matkul_diambil = DB::table('sebaran')
                                    ->join('prodi','prodi.id','=','sebaran.prodi')
                                    ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                    ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                    ->select('sebaran.prodi','prodi.nama','matkul.matkul','sebaran.dosen_mengajar')->get()
                                    ->where('dosen_mengajar',$dosen->nidn);
            $dosen->prodi_diambil = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->select('prodi')->get();
            $dosen->no = 1 ;
            }
        $data['get_prodiAndDosen'] = $get_prodiAndDosen;
        return view('exports.rekap',$data);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                $pilih_prodi = $this->request->pilih_prodi;
                $prodi = DB::table('sebaran')
                        ->join('prodi','sebaran.prodi','=','prodi.id')
                        ->select('prodi.nama')
                        ->where('prodi.id',$pilih_prodi)
                        ->first();
                $semester = $this->request->pilih_semester;
                $tahun = $this->request->pilih_tahun;

                $styleTextCenter = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ],
                    'font' => [
                        'bold' => true
                    ]
                ];

                $styleTextLeft = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT
                    ]
                ];
               
                
                $event->sheet->insertNewRowBefore(1, 5);
                

                $event->sheet->setCellValue('A1', 'Rekapitulasi Jam Mengajar Dosen ');
                $event->sheet->setCellValue('A2', 'Program Studi ' . $prodi->nama);
                $event->sheet->setCellValue('A4', 'Semester ' . $semester );
                $event->sheet->setCellValue('A3', 'Tahun Akademik ' . $tahun );
                $event->sheet->mergeCells('A1:K1');
                $event->sheet->mergeCells('A2:K2');
                $event->sheet->mergeCells('A3:K3');
                $event->sheet->mergeCells('A4:K4');
                // $event->sheet->getStyle('A1:O1')->setValignment('center');
                $event->sheet->getStyle('A6:K6')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A3:O3')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A1:O1')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A2:O2')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A4:O4')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A6:O6')->applyFromArray($styleTextCenter);
                
                
            }
        ];
    }
}
