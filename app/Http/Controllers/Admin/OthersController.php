<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NoticeInfo;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class OthersController extends Controller
{
    
    public function all_contact()
    {
        // dd('hello');
        $contact = Contact::all();
        $page_data = [
            'add_menu' => 'yes',
            'modal' => 'yes',
        ];
        return view('backend.contact.all_contact', compact('contact', 'page_data'));
       
    }

    public function save_contact(Request $request)
    {
        // return $request;
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->mobile = $request->mobile;
        $contact->save();

        Toastr::success('Contact Created Successfully', '');
        return redirect()->route('admin.all_contact');
    }

    public function edit_contact($id)
    {
        $contact = Contact::find($id);

        $output = '';
        
        $output .= '<div class="form-group"> <label for="Route_name">Name</label> <input type="text" class="form-control" name="name" value="' . $contact->name . '"> </div><div class="form-group"> <label for="mobile">Mobile</label> <input type="number" class="form-control" name="mobile" value="' . $contact->mobile . '"> </div><input type="hidden" name="edit_id" value="' . $id . '">';

        return $output;
    }

    public function update_contact(Request $request)
    {
        // return $request;
        Contact::find($request->edit_id)->update($request->all());
        Toastr::success('Contact Updated Successfully');
        return redirect()->route('admin.all_contact');
    }

    public function delete_contact($id)
    {
        // return $request;
        Contact::find($id)->delete();
        Toastr::error('Contact Deleted Successfully');
        return redirect()->route('admin.all_contact');
    }

    public function all_notice_info()
    {
        
        $notice = NoticeInfo::all();
        $page_data = [
            'add_menu' => 'yes',
            'modal' => 'yes',
        ];
        return view('backend.notice_info.all_notice_info', compact('notice', 'page_data'));
       
    }

    public function save_notice_info(Request $request)
    {
        
        $request->validate([
            'pdf' => 'required|mimes:pdf',
        ]);
        $pdfName = $request->pdf->getClientOriginalName();
        $request->pdf->move(public_path('uploads/pdf/'), $pdfName);
        $data = NoticeInfo::create([
            'pdf' => 'uploads/pdf/' .  $pdfName,
            'title' => $request->title,
            'type'  => $request->type,
            'date'  => $request->date
        ]);
        Toastr::success('Notice/Info Created Successfully', '');
        return redirect()->route('admin.all_notice_info');
    }

    public function edit_notice_info($id)
    {
        $data = NoticeInfo::find($id);
        $output = '';
        $output .='
        <div class="form-group"> 
        <label for="Route_name">Title</label> <input type="text" class="form-control" name="title" value="' . $data->title . '"> </div>
        <div class="form-group">
        <label for="status">Type</label>
        <select class="form-control" id="status" name="type" required>
        <option value="" disabled selected>Select One</option>
        <option value="0"' . ($data->type == 0 ? ' selected' : '') . '>Notice</option>
        <option value="1"' . ($data->type == 1 ? ' selected' : '') . '>Information</option>
        </select></div>
        <div class="form-group">
        <label class="control-label ">Program Date</label>
        <input class="form-control" type="date" name="date" id="program_date" value="">
        <span id="error_date" class="text-danger error_field font-weight-bold"></span>
        </div>
        <div class="form-group">
        <label for="Route_name">PDF Upload</label>
        <input type="file" class="form-control" id="Route name" name="pdf">
        <div class="btn-set">
		    <a href="'.(asset($data->pdf)).'" class="btn btn-info"><i class="fa fa-eye"></i>Show</a>
		</div>
        </div>
        <input type="hidden" name="edit_id" value="' . $id . '">
        
        ';
        return $output;
    }

    public function update_notice_info(Request $request)
    {
        // return $request;
        $oldPdf = NoticeInfo::findOrFail($request->edit_id);

        if ($request->hasFile('pdf')) {
            $pdfName = $request->pdf->getClientOriginalName();
            $destinationPath = public_path('uploads/pdf/');
            $request->pdf->move($destinationPath, $pdfName);

            $oldPdfPath = public_path($oldPdf->pdf);
            if (File::exists($oldPdfPath)) {
                if (File::delete($oldPdfPath)) {
                    $oldPdf->update([
                        'pdf' => 'uploads/pdf/' . $pdfName,
                        'title' => $request->title,
                        'type'  => $request->type,
                        'date'  => $request->date
                    ]);
                }
            }
        }else{
            $oldPdf->update([
                'title' => $request->title,
                'type'  => $request->type,
                'date'  => $request->date
            ]);
        }
        Toastr::success('Notice/Info Updated Successfully');
        return redirect()->route('admin.all_notice_info');
    }

    public function delete_notice_info($id)
    {
        
        $oldPdf = NoticeInfo::findOrFail($id);
        // return $oldPdf;
         $oldPdfPath = public_path($oldPdf->pdf) ; 
         if (File::delete($oldPdfPath)) {
            $oldPdf->delete();
         }
        Toastr::error('Contact Deleted Successfully');
        return redirect()->route('admin.all_notice_info');
    
    }
}
