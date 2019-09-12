<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{

    public function saveComplaint(Request $request)
    {

        $validation = $this->validateSaveComplaintRequest($request);
        if ($validation->fails()) {
            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        Complaint::updateOrCreate([
            'id' => $request->id
        ], [
            'complaint_id' => uniqid(),
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return return_msg(true, 'ok');
    }


    protected function validateSaveComplaintRequest(Request $request)
    {

        return validator($request->all(), [
            'user_id' => 'required',
            'subject' => 'required',
            'message' => 'required|min:2|max:200'
        ]);
    }


    public function getAllComplaints(array $filters = [])
    {

        if (isset($filters['proceeded'])) {

            $complaints = Complaint::with('user')
                ->where('proceeded', intval($filters['proceeded']))
                ->get();

        } else {

            $complaints = Complaint::with('user')->get();
        }


        return return_msg(true, 'ok', compact('complaints'));
    }


    public function getComplaint($id)
    {

        $complaint = Complaint::with('user')->find($id);
        if (!$complaint) {
            return return_msg(false, 'not found');
        }

        return return_msg(true, 'ok', compact('complaint'));
    }


    public function deleteComplaint($id)
    {
        $complaint = Complaint::find($id);
        if (!$complaint) {
            return return_msg(false, 'not found');
        }

        $complaint->delete();

        return return_msg(true, 'ok');
    }


    public function makeComplaintProceeded($id)
    {

        $complaint = Complaint::find($id);
        if (!$complaint) {
            return return_msg(false, 'not found');
        }

        $complaint->update('proceeded', 1);

        return return_msg(true, 'ok');
    }
}
