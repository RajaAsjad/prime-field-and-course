<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = ContactUs::orderby('id', 'desc')->where('id', '>', 0);
            $search = $request->input('search', '');
            if ($search !== '' && $search !== null && $search !== 'undefined') {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('message', 'like', '%' . $search . '%');
                });
            }
            $status = $request->input('status', 'All');
            if ($status !== 'All' && $status !== '' && $status !== 'undefined' && in_array((string) $status, ['0', '1', '2'])) {
                $statusVal = ($status == '2') ? 0 : (int) $status;
                $query->where('status', $statusVal);
            }
            $models = $query->paginate(10);
            return (string) view('admin.contact_us.search', compact('models'));
        }

        $page_title = 'All Contact Me';
        $totalContacts = ContactUs::count();
        $models = ContactUs::orderby('id', 'desc')->paginate(10);
        return view('admin.contact_us.index', compact('page_title', 'models', 'totalContacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = ContactUs::findOrFail($id);
        return view('admin.contact_us.show', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->filled('first_name')) {
            $request->validate([
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'nullable|string|max:50',
                'project_type' => 'required|string|max:100',
                'message' => 'nullable|string|max:2000',
            ]);

            $projectLabels = [
                'golf-new' => 'New Golf Course Construction',
                'golf-reno' => 'Golf Course Renovation',
                'golf-green' => 'Green Rebuild Only',
                'field-new' => 'New Athletic Field Construction',
                'field-reno' => 'Athletic Field Renovation',
                'field-complex' => 'Multi-Field Complex',
                'other' => 'Other / Not Sure Yet',
            ];

            $firstName = trim($request->first_name);
            $lastName = trim($request->last_name);
            $projectType = $projectLabels[$request->project_type] ?? $request->project_type;

            $model = new ContactUs();
            $model->first_name = $firstName;
            $model->last_name = $lastName;
            $model->email = $request->email;
            $model->phone = $request->phone ?? '';
            $model->address = $projectType;
            $model->message = $request->message ?? '';
            $model->save();

            $contactData = [
                'full_name' => trim($firstName . ' ' . $lastName),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $request->email,
                'phone' => $request->phone ?? '',
                'project_type' => $projectType,
                'message' => $request->message ?? '',
            ];
        } else {
            $request->validate([
                'full_name' => 'required|string|max:200',
                'email' => 'required|email|max:100',
                'phone' => 'required|string|max:50',
                'venue_event' => 'nullable|string|max:255',
                'message' => 'required|string|max:2000',
            ]);

            $fullName = trim($request->full_name);
            $parts = preg_split('/\s+/', $fullName, 2);
            $firstName = $parts[0] ?? $fullName;
            $lastName = $parts[1] ?? '';

            $model = new ContactUs();
            $model->first_name = $firstName;
            $model->last_name = $lastName;
            $model->email = $request->email;
            $model->phone = $request->phone;
            $model->address = $request->venue_event;
            $model->message = $request->message;
            $model->save();

            $contactData = [
                'full_name' => $fullName,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'venue_event' => $request->venue_event,
                'message' => $request->message,
            ];
        }

        $adminEmail = config('site.contact.email', config('mail.from.address'));
        if ($adminEmail) {
            try {
                Mail::to($adminEmail)->send(new ContactFormMail($contactData));
                Log::info('Contact form email sent to ' . $adminEmail);
            } catch (\Exception $e) {
                Log::error('Contact form email failed', [
                    'to' => $adminEmail,
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your quote request has been received. We will respond within one business day.'
            ]);
        }

        return redirect()->back()->with('status', 'Your message has been sent. Thank you!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ContactUs::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
