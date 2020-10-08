<?php

namespace App\Exports;

use App\Sebaran;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;




class SebaranExport implements FromView,WithEvents
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
        $no = 1;
        $sebaran =  DB::table('sebaran')
                             ->leftJoin('prodi','sebaran.prodi', '=', 'prodi.id')
                             ->leftJoin('kelas','sebaran.kd_kelas','=','kelas.id')
                             ->leftJoin('matkul','sebaran.mata_kuliah','=','matkul.id')
                             ->leftJoin('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                             ->leftJoin('table_dosen','sebaran.dosen_pdpt','=','table_dosen.nidn')
                             ->select('table_dosen.id','table_dosen.name as dosen_pdpt','dosen.nidn','dosen.id','dosen.name','sebaran.id as id_sebaran','kelas.id','kelas.kode','kelas.keterangan','prodi.kode as kode_prodi','sebaran.tahun_akademik','matkul.semester','kelas.mhs','matkul.matkul','matkul.sks',
                             'matkul.teori','matkul.kode_matkul','matkul.praktek','matkul.jam_minggu','sebaran.dosen_mengajar','sebaran.approved','prodi.id','sebaran.tahun_akademik','matkul.kurikulum')->orderBy('semester');
        if($pilih_prodi){$sebaran = $sebaran->where('sebaran.prodi',$pilih_prodi);} 
        if($pilih_tahun){$sebaran = $sebaran->where('sebaran.tahun_akademik',$pilih_tahun);} 
        if($pilih_semester){$sebaran = $sebaran->whereIn('sebaran.semester',$pilih_semester);} 
        $data['sebaran'] = $sebaran->get();
        $data['no'] = $no;
        return view('exports.sebaran',$data);
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
                

                $event->sheet->setCellValue('A1', 'Sebaran Mata Kuliah dan Dosen Mengajar');
                $event->sheet->setCellValue('A2', 'Program Studi ' . $prodi->nama);
                $event->sheet->setCellValue('A4', 'Semester ' . $semester );
                $event->sheet->setCellValue('A3', 'Tahun Akademik ' . $tahun );
                // $event->sheet->setCellValue('A3', 'TAHUN AKADEMIK' );
                $event->sheet->mergeCells('A1:O1');
                $event->sheet->mergeCells('A2:O2');
                $event->sheet->mergeCells('A3:O3');
                $event->sheet->mergeCells('A4:O4');
                // $event->sheet->getStyle('A1:O1')->setValignment('center');
                $event->sheet->getStyle('A6:O6')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A4:O300')->applyFromArray($styleTextLeft);
                $event->sheet->getStyle('A3:O3')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A1:O1')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A2:O2')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A4:O4')->applyFromArray($styleTextCenter);
                $event->sheet->getStyle('A6:O6')->applyFromArray($styleTextCenter);
                // $event->sheet->setAllBorders('thin');
                // $event->sheet->setBorder('A3:010', 'thin');
                
            }
        ];
    }
}
