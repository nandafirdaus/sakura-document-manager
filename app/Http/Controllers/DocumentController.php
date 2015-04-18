<?php namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Company;
use App\Models\Employee;

use Validator;
use Input;
use Session;
use Redirect;

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

	public function getCreate() 
	{
		$employees = Employee::all();
		$documentTypes = DocumentType::all();

		return view('document/create')
			->with('employees', $employees)
			->with('documentTypes', $documentTypes);
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), Document::$rules);

		if ($validator->fails()) {
			return Redirect::to('document/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$document = new Document;
			$document->issued = Input::get('issued');
			$document->expired = Input::get('expired');
			$document->doc_number = Input::get('doc_number');
			$document->sequence = Input::get('sequence');
			$document->type_id = Input::get('type_id');
			$document->employee_id = Input::get('employee_id');
			$document->file_url = Input::get('file_url');
			$document->save();

			Session::flash('message', 'Berhasil menambahkan dokumen!');
			return Redirect::to('document');
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
			$document = Document::find($id);
			$document->issued = Input::get('issued');
			$document->expired = Input::get('expired');
			$document->doc_number = Input::get('doc_number');
			$document->sequence = Input::get('sequence');
			$document->type_id = Input::get('type_id');
			$document->employee_id = Input::get('employee_id');
			$document->file_url = Input::get('file_url');
			$document->save();

			Session::flash('message', 'Berhasil menambahkan dokumen.');
			return Redirect::to('document');
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