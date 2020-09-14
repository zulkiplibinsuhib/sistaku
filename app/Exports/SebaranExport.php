<?php

namespace App\Exports;

use App\Sebaran;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;




class SebaranExport implements FromView,WithEvents
{
  
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $pilih_prodi;

    public function __construct($pilih_prodi = null)
    {
        $this->pilih_prodi = $pilih_prodi;
        $sebaran = new Sebaran();
        $prodi = DB::table('sebaran')
                ->join('prodi','sebaran.prodi','=','prodi.id')
                ->select('prodi.nama')
                ->where('prodi.id',$pilih_prodi)->first();
                
        $tahun_akademik = Sebaran::select('tahun_akademik')->where('prodi',$prodi);
       
      
        $tahun_akademik = Sebaran::select('tahun_akademik')->where('prodi',$prodi);
        $this->sebaran = $sebaran;
        $this->prodi = $prodi;
        $this->tahun_akademik = $tahun_akademik;
     
    }

    public function view(): View
    {
        $pilih_prodi =  $this->pilih_prodi;
        $no = 1;
        $id =  Auth::user()->prodi;
        $sebaran =  DB::table('sebaran')
                             ->leftJoin('prodi','sebaran.prodi', '=', 'prodi.id')
                             ->leftJoin('kelas','sebaran.kd_kelas','=','kelas.id')
                             ->leftJoin('matkul','sebaran.mata_kuliah','=','matkul.id')
                             ->leftJoin('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                             ->leftJoin('table_dosen','sebaran.dosen_pdpt','=','table_dosen.nidn')
                             ->select('table_dosen.id','table_dosen.name as dosen_pdpt','dosen.nidn','dosen.id','dosen.name','sebaran.id as id_sebaran','kelas.id','kelas.kode','kelas.keterangan','prodi.kode as kode_prodi','sebaran.tahun_akademik','matkul.semester','kelas.mhs','matkul.matkul','matkul.sks',
                             'matkul.teori','matkul.kode_matkul','matkul.praktek','matkul.jam_minggu','sebaran.dosen_mengajar','sebaran.approved','prodi.id')->orderBy('semester');
        if($pilih_prodi){$sebaran = $sebaran->where('sebaran.prodi',$pilih_prodi);} 
        $data['sebaran'] = $sebaran->get();
        $data['no'] = $no;
        return view('exports.sebaran',$data);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                


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

                $styleTextRight = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT
                    ],
                    'font' => [
                        'bold' => true
                    ]
                ];

                $event->sheet->insertNewRowBefore(1, 2);
                

                $event->sheet->setCellValue('A1', 'SEBARAN MATA KULIAH DAN DOSEN MENGAJAR');
                // $event->sheet->setCellValue('A2', 'PROGRAM STUDI' . $this->prodi);
                // $event->sheet->setCellValue('A3', 'TAHUN AKADEMIK' );
                $event->sheet->mergeCells('A1:O1');
                // $event->sheet->getStyle('A1:O1')->setValignment('center');
                $event->sheet->getStyle('A3:O3')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A4:O300')->applyFromArray($styleTextLeft);
                $event->sheet->getStyle('A3:O3')->applyFromArray($styleTextCenter);
                // $event->sheet->setAllBorders('thin');
                // $event->sheet->setBorder('A3:010', 'thin');
                
            }
        ];
    }
}
