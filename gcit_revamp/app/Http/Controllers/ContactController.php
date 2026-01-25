<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class ContactController extends Controller
{
    public function getAllContacts()
    {
        try {
            $contacts = Contact::all();
            return response()->json([
                'success' => true,
                'data' => $contacts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch contacts.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getContact(Contact $contact)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $contact
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch contact.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createContact(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'contact_number' => 'sometimes',
                'message' => 'required',
                'status' => 'required',
                'type' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $contact = new Contact();
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->contact_number = $request->contact_number;
            $contact->message = $request->message;
            $contact->status = $request->status;
            $contact->type = $request->type;
            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'Contact created successfully!',
                'data' => $contact
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Contact.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteContact($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();

            return response()->json([
                'success' => true,
                'message' => 'contact deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contact.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateContact($id, Request $request)
    {
        try {
            $contact = Contact::findOrFail($id);

            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'contact_number' => 'sometimes',
                'message' => 'required',
                'status' => 'required',
                'type' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->contact_number = $request->contact_number;
            $contact->message = $request->message;
            $contact->status = $request->status;
            $contact->type = $request->type;
            $contact->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($contact)
                ->withProperties([
                    'email' => $contact->email,
                    'id' => $contact->id
                ])
                ->log('Updated a contact detail');
            return response()->json([
                'success' => true,
                'message' => 'contact updated successfully!',
                'data' => $contact
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update contact.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
