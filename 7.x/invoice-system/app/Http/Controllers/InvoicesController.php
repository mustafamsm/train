<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\invoice_attachments;
use App\invoice_details;
use App\invoices;
use App\Notifications\AddInvoice;
use App\Sections;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class InvoicesController extends Controller
{

    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }


    public function create()
    {
        $sections = Sections::all();
        return view('invoices.add', compact('sections'));
    }


    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'invoice_number'=>'required|Numeric',
        //     'invoice_Date'=>'required|date',
        //     'Due_date'=>'required|date',
        //     'Section'=>'required',
        //     'product'=>'required',
        //     'Amount_collection'=>'required|Numeric',
        //     'Amount_Commission'=>'required|Numeric',

        // ]);


        //store invoice in table invoice
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        //store invoice details in tabel invoice_details
        $invoice_id = invoices::latest()->first()->id;
        invoice_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        //check if request have send pic
        if ($request->hasFile('pic')) {

            $this->validate($request, ['pic' => 'required|mimes:png,jpg,pdf|max:10000'], ['pic.mimes' => 'خطا نوع الملف']);
            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            //move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }
        $user=User::first();
        $user->notify(new AddInvoice($invoice_id));
        // Notification::send($user,new AddInvoice($invoice_id));
        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }


    public function show(invoices $invoices)
    {
        //
    }


    public function edit($id)

    {
        $invoices = invoices::find($id);
        $sections = sections::all();
        return view('invoices.edit', compact('invoices', 'sections'));
    }


    public function update(Request $request)
    {
        $invoices = invoices::findOrFail($request->invoice_id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();
    }


    public function destroy(Request $request)
    {

        $id = $request->invoice_id;
        $invoices = invoices::findOrFail($id);
        $Details = invoice_attachments::where('invoice_id', $id)->first();
        $id_page=$request->id_page;
        if(!$id_page==2){
            if (!empty($Details->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
            }
            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');
        }else{
            $invoices->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');

          

        }
       
    }
    public function getproducts($id)
    {
        $states = DB::table('products')->where('section_id', $id)->pluck('Product_name', "id");
        return json_encode($states);
    }
    public function status_show($id)
    {
        $invoices = invoices::find($id);
        return view('invoices.status_update', compact('invoices'));
    }
    public function status_Update($id, Request $request)
    {
        $invoices = invoices::findOrFail($id);
        if ($request->Status === 'مدفوعة') {
            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoice_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoice_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }
    public function invoice_paid()
    {
        $invoices=invoices::where('Value_Status',1)->get();
        return view('invoices.invoices_paid',compact('invoices'));
    }
    public function invoice_UnPaid()
    {
        $invoices=invoices::where('Value_Status',2)->get();
        return view('invoices.invoices_unpaid',compact('invoices'));
    }
    public function invoice_Partial()
    {
        $invoices=invoices::where('Value_Status',3)->get();
        return view('invoices.invoices_Partial',compact('invoices'));

    }
    public function print_invoice($id){
        $invoices=invoices::where('id',$id)->first();
        return view('invoices.Print_invoices',compact('invoices'));
    }
    public function export()
    {

        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
}
