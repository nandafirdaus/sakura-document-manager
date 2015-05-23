<?php namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Kitas;

use Validator;
use Input;
use Session;
use Redirect;
use File;

class DocumentController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getCreate($kitasId) 
	{
		$employees = Employee::all();
		$documentTypes = DocumentType::all();

		return view('document/create')
			->with('employees', $employees)
			->with('documentTypes', $documentTypes)
			->with('kitasId', $kitasId);
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), Document::$rules);

		if ($validator->fails()) {
			return Redirect::to('document/create/' . Input::get('kitas_id'))
				->withErrors($validator)
				->withInput(Input::all());
		} else {

			$kitas = Kitas::find(Input::get('kitas_id'));
			$doc = $kitas->documents()->where('document_type_id', '=', Input::get('type_id'))->first();
			if ($doc != null) {
				return Redirect::to('document/create/' . Input::get('kitas_id'))
				->withErrors("Dokumen " . $doc->documentType->name . " sudah ada! Edit atau hapus dokumen lama.")
				->withInput(Input::all());
			}

			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('document_file')) {
				$file = Input::file('document_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('kitas_id') . '-' . str_replace(' ', '-',DocumentType::find(Input::get('type_id'))->name) . '-' . rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$document = new Document;
			$document->issued = date('Y-m-d', strtotime(Input::get('issued')));
			$document->expired = date('Y-m-d', strtotime(Input::get('expired')));
			$document->doc_number = Input::get('doc_number');
			$document->document_type_id = Input::get('type_id');
			$document->file_url = $destinationPath . $fileName;
			$document->kitas_id = Input::get('kitas_id');
			$document->save();

			Session::flash('message', 'Berhasil menambahkan dokumen!');
			return Redirect::to('kitas/' . Input::get('kitas_id') . '/view');
		}
	}

	public function getEdit($id)
	{
		$document = Document::find($id);
		$employees = Employee::all();
		$documentTypes = DocumentType::all();

		return view('document.edit')
		->with('document', $document)
		->with('employees', $employees)
		->with('documentTypes', $documentTypes);
	}

	public function postEdit($id)
	{
		$validator = Validator::make(Input::all(), Document::$rules);

		if ($validator->fails()) {
			return Redirect::to('document/' . $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('document_file')) {
				$file = Input::file('document_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('kitas_id') . '-' . str_replace(' ', '-',DocumentType::find(Input::get('type_id'))->name) . '-' .  rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$document = Document::find($id);

			$kitas = Kitas::find(Input::get('kitas_id'));
			$doc = $kitas->documents()->where('document_type_id', '=', Input::get('type_id'))->first();
			
			if ($doc != null && $document->document_type_id != Input::get('type_id')) {
				return Redirect::to('document/' . $id .'/edit')
				->withErrors("Dokumen " . $doc->documentType->name . " sudah ada! Edit atau hapus dokumen lama.")
				->withInput(Input::all());
			}

			$document->issued = date('Y-m-d', strtotime(Input::get('issued')));
			$document->expired = date('Y-m-d', strtotime(Input::get('expired')));
			$document->doc_number = Input::get('doc_number');
			$document->document_type_id = Input::get('type_id');
			if (Input::hasFile('document_file')) {
				$document->file_url = $destinationPath . $fileName;
			}
			$document->kitas_id = Input::get('kitas_id');
			$document->save();

			Session::flash('message', 'Berhasil menambahkan dokumen.');
			return Redirect::to('kitas/' . Input::get('kitas_id') . '/view');
		}
	}

	public function getView($id)
	{
		$document = Document::find($id);

		return view('document.view')
		->with('document', $document);
	}

	public function getList()
	{
		$documents = Document::all();

		return view('document.list')
		->with('documents', $documents);
	}

	public function delete($id)
	{
		$document = Document::find($id);
		$document->delete();

		Session::flash('message', 'Berhasil menghapus data.');
		return Redirect::to('document');
	}

	/**
	Document Type
	*/
	public function getCreateType() 
	{
		$companies = Company::all();
		return view('document-type/create');
	}

	public function postCreateType()
	{
		$validator = Validator::make(Input::all(), DocumentType::$rules);

		if ($validator->fails()) {
			return Redirect::to('document-type/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$documentType = new DocumentType;
			$documentType->name = Input::get('name');
			$documentType->save();

			Session::flash('message', 'Berhasil menambahkan tipe dokumen!');
			return Redirect::to('document-type');
		}
	}

	public function getEditType($id)
	{
		$documentType = DocumentType::find($id);

		return view('document-type.edit')
		->with('documentType', $documentType);
	}

	public function postEditType($id)
	{
		$validator = Validator::make(Input::all(), DocumentType::$rules);

		if ($validator->fails()) {
			return Redirect::to('document-type/' . $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$documentType = DocumentType::find($id);
			$documentType->name = Input::get('name');
			$documentType->save();

			Session::flash('message', 'Berhasil mengubah tipe dokumen.');
			return Redirect::to('document-type');
		}
	}

	public function getViewType($id)
	{
		$documentType = DocumentType::find($id);

		return view('document-type.view')
		->with('documentType', $documentType);
	}

	public function getListType()
	{
		$documentTypes = DocumentType::all();

		return view('document-type.list')
		->with('documentTypes', $documentTypes);
	}

	public function deleteType($id)
	{
		$documentType = DocumentType::find($id);
		$documentType->delete();

		Session::flash('message', 'Berhasil menghapus data.');
		return Redirect::to('document-type');
	}

}
?>