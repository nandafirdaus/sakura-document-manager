<?php namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Company;
use App\Models\Employee;

use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;
use Response;
use File;
use Excel;
use Zipper;

class ReportController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getDocumentReport() 
	{
		$companies = Company::all();

		return view('report/document')
			->with('companies', $companies);
	}

	public function getGenerateDocument($id)
	{	
		$company = Company::find($id);
		$excel = Excel::create($company->name . ' Document Report', function($excel) use($company) {

		    $excel->sheet('Sheet1', function($sheet) use($company) {
				
				$employees = $company->employee;

				// Set width for multiple cells
				$sheet->setWidth(array(
					'A'	=>	23,
					'B'	=>	23,
					'C' =>	15,
					'D' =>	25,
					'E'	=>	15
				));

				$sheet->mergeCells('A1:E1');
				$sheet->row(1, array(
				     'Stay Permit & Working Permit - ' . $company->name
				));

				$sheet->cells('A1:E1', function($cells) {
					$cells->setAlignment('left');
					$cells->setFontWeight('bold');
				});

				$sheet->row(3, array(
				     'Nama', 'Jabatan', 'Nama Dokumen', 'No.', 'Masa Berlaku'
				));

				$sheet->setBorder('A3:E3', 'thin');

				$sheet->cells('A3:E3', function($cells) {
					$cells->setAlignment('center');
					$cells->setFontWeight('bold');
				});

				$row = 4;

				foreach ($employees as $employee) {
					if ($employee->kitas != null && $employee->kitas->expired != null) {
						$sheet->appendRow(array(
							$employee->name, $employee->position, 'KITAS-' . $employee->kitas->sequence, $employee->kitas->doc_number, date('d-M-Y', strtotime($employee->kitas->expired))
						));
					} else {
						$sheet->appendRow(array(
							$employee->name, $employee->position, 'KITAS', '', ''
						));
					}

					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 4)->first() != null) {
						$poa = $employee->kitas->documents()->where('document_type_id', '=', 4)->first();
						$sheet->appendRow(array(
							'', '', 'POA', $poa->doc_number, date('d-M-Y', strtotime($poa->expired))
						));
					} else {
						$sheet->appendRow(array(
							'', '', 'POA', '', ''
						));
					}

					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 5)->first() != null) {
						$stm = $employee->kitas->documents()->where('document_type_id', '=', 5)->first();
						$sheet->appendRow(array(
							'Passport No.', '', 'STM', $stm->doc_number, date('d-M-Y', strtotime($stm->expired))
						));
					} else {
						$sheet->appendRow(array(
							'Passport No.', '', 'STM', '', ''
						));
					}

					$passport_number = $employee->passport_number != null ? $employee->passport_number : '-';
					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 6)->first() != null) {
						$skttt = $employee->kitas->documents()->where('document_type_id', '=', 6)->first();
						$sheet->appendRow(array(
							$passport_number, '', 'CARD SKTTT', $skttt->doc_number, date('d-M-Y', strtotime($skttt->expired))
						));
					} else {
						$sheet->appendRow(array(
							$passport_number, '', 'CARD SKTTT', '', ''
						));
					}

					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 7)->first() != null) {
						$skskp = $employee->kitas->documents()->where('document_type_id', '=', 7)->first();
						$sheet->appendRow(array(
							'', '', 'SKSKP', $skskp->doc_number, date('d-M-Y', strtotime($skskp->expired))
						));
					} else {
						$sheet->appendRow(array(
							'', '', 'SKSKP', '', ''
						));
					}

					$issue = $employee->passport_issued != null ? date('d-M-Y', strtotime($employee->passport_issued)) : '-';
					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 8)->first() != null) {
						$biodata = $employee->kitas->documents()->where('document_type_id', '=', 8)->first();
						$sheet->appendRow(array(
							'Issue:     ' . $issue, '', 'BIODATA', $biodata->doc_number, date('d-M-Y', strtotime($biodata->expired))
						));
					} else {
						$sheet->appendRow(array(
							'Issue:     ' . $issue, '', 'BIODATA', '', ''
						));
					}

					$expired = $employee->passport_expired != null ? date('d-M-Y', strtotime($employee->passport_expired)) : '-';
					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 9)->first() != null) {
						$imta = $employee->kitas->documents()->where('document_type_id', '=', 9)->first();
						$sheet->appendRow(array(
							'Expired:     ' . $expired, '', 'IMTA', $imta->doc_number, date('d-M-Y', strtotime($imta->expired))
						));
					} else {
						$sheet->appendRow(array(
							'Expired:     ' . $expired, '', 'IMTA', '', ''
						));
					}

					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 10)->first() != null) {
						$lakeb = $employee->kitas->documents()->where('document_type_id', '=', 10)->first();
						$sheet->appendRow(array(
							'', '', 'LAKEB', $lakeb->doc_number, date('d-M-Y', strtotime($lakeb->expired))
						));
					} else {
						$sheet->appendRow(array(
							'', '', 'LAKEB', '', ''
						));
					}

					if ($employee->kitas != null && $employee->kitas->documents()->where('document_type_id', '=', 11)->first() != null) {
						$merp = $employee->kitas->documents()->where('document_type_id', '=', 11)->first();
						$sheet->appendRow(array(
							'', '', 'MERP', $merp->doc_number, date('d-M-Y', strtotime($merp->expired))
						));
					} else {
						$sheet->appendRow(array(
						'', '', 'MERP', '', ''
					));
					}
					

					$sheet->appendRow(array(
						'', '', '(1 tahun)', '', ''
					));

					/**
					* Document Styling
					*/

					// Merge position column
					$sheet->mergeCells('B' . $row . ':B' . ($row+3));

					// Set position column's alignment to top left
					$sheet->cell('B' . $row, function($cell) {
						$cell->setAlignment('left');
						$cell->setValignment('top');
						$cell->setFontWeight('bold');
					});

					$sheet->getStyle('B' . $row)->getAlignment()->setWrapText(true);

					// Set name to be bold
					$sheet->cell('A' . $row, function($cell) {
						$cell->setFontWeight('bold');
					});

					// Set passport no. to be bold
					$sheet->cell('A' . ($row+3), function($cell) {
						$cell->setFontWeight('bold');
					});

					$sheet->cells('A' . $row . ':A' . ($row+9), function($cells) {
						$cells->setBorder('thin', 'thin', 'thin', 'thin');
						$cells->setAlignment('left');
					});

					$sheet->cells('B' . $row . ':B' . ($row+9), function($cells) {
						$cells->setBorder('thin', 'thin', 'thin', 'thin');
					});

					$sheet->cells('C' . $row . ':C' . ($row+9), function($cells) {
						$cells->setBorder('thin', 'thin', 'thin', 'thin');
					});

					$sheet->cells('D' . $row . ':D' . ($row+9), function($cells) {
						$cells->setBorder('thin', 'thin', 'thin', 'thin');
						$cells->setAlignment('left');
					});

					$sheet->cells('E' . $row . ':E' . ($row+9), function($cells) {
						$cells->setBorder('thin', 'thin', 'thin', 'thin');
						$cells->setFontWeight('bold');
					});

					$row+=10;
				}

		    });

		})->download('xlsx');
	}
	
	public function getEmployeeDocument() 
	{
		$employees = Employee::all();

		return view('report/employee-documents')
			->with('employees', $employees);
	}

	public function getDownloadEmployeeDocument($id)
	{
		$employee = Employee::find($id);
		$employeeName = str_replace(' ', '-', $employee->name);
		$fileName = rand(0, 9999) . '.zip';
		$zipper = Zipper::make($fileName);
		
		$count = 0;
		$files;
		
		if ($employee->passport_file_url != '' && File::exists($employee->passport_file_url)) {
			$files[] = $employee->passport_file_url;
			$count++;
		}
		if ($employee->rptka != null && $employee->rptka->file_url != '' && File::exists($employee->rptka->file_url)) {
			$files[] = $employee->rptka->file_url;
			$count++;
		}
		if ($employee->kitas != null && $employee->kitas->file_url != '' && File::exists($employee->kitas->file_url)) {
			$files[] = $employee->kitas->file_url;
			$count++;
		}
		
		if ($employee->kitas != null) {
			$documents = $employee->kitas->documents()->get();
		
			foreach ($documents as $document) {
				if ($document->file_url != '' && File::exists($document->file_url)) {
					$files[] = $document->file_url;
					$count++;
				}
			}
		}
		
		if ($count == 0) {
			return $employee->name . ' tidak belum memiliki dokumen. <input type="button" value="Tutup" onclick="self.close()">';
		}

		$zipper->add($files);
		
		$zipper->close();
		$headers = array(
			'Content-Type' => 'application/octet-stream',
		);
		
		return response()->download(public_path() . '/' . $fileName, $employeeName . '-Documents.zip', $headers)->deleteFileAfterSend(true);
	}

}
?>