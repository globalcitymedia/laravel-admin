<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\ContactList;
use App\Http\Controllers\Controller;
use App\Tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Validation\Validator;

class ContactListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $object_name = 'contact-lists';
    protected $admin_url = '/admin/contact-lists';

    public function index()
    {
        $page_title = "Contact Lists";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $contact_lists = ContactList::paginate(config('variables.paginate_count'));

        $breadcrums = array(['title' => $page_title, 'url' => '']);
        //dd($users);
        return view('admin.contact_lists.index', compact('contact_lists', 'page_title', 'object_name', 'breadcrums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create new list";
        $object_name = $this->object_name;
        $breadcrums = array(['title' => 'Contact Lists', 'url' => '/admin/contact-lists'], ['title' => 'Create new list', 'url' => '']);
        return view('admin.contact_lists.create', compact('page_title', 'object_name', 'breadcrums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:contact_lists|max:255',
            'description' => 'required',
            'type' => 'required',
            'website' => 'required',
        ]);


        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;
        $contact_list = new ContactList($request->all());

        $file = $request->file('contactfile');
        //dd($contact_list);

        $contact_list->saveOrFail($contact_list->toArray());
        //dd($contact_list);
        $this->importContacts($file, ',', $contact_list);
        //dd($ip_add);
        $tracker = new Tracker();
        $tracker->track('New contact list: ' . $request['name']);

        return redirect($this->admin_url);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ContactList $contactList
     * @return \Illuminate\Http\Response
     */
    public function show(ContactList $contactList)
    {
        $page_title = $contactList->name;
        $object_name = $this->object_name;
        $breadcrums = array(['title' => 'Contact Lists', 'url' => '/admin/contact-lists'],
            ['title' => $contactList->name, 'url' => '/admin/contact-lists/' . $contactList->id]);

        return view('admin.contact_lists.show', compact('page_title', 'object_name', 'breadcrums', 'contactList'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactList $contactList
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactList $contactList)
    {
        $page_title = "Edit list";
        $object_name = $this->object_name;
        $breadcrums = array(['title' => 'Contact Lists', 'url' => '/admin/contact-lists'], ['title' => 'Edit list', 'url' => '']);

        return view('admin.contact_lists.edit', compact('page_title', 'object_name', 'breadcrums', 'contactList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ContactList $contactList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactList $contact_list)
    {
        $page_title = "Import report";
        $object_name = $this->object_name;
        $breadcrums = array(['title' => 'Contact Lists', 'url' => '/admin/contact-lists'], ['title' => 'Import report', 'url' => '']);

        $request['updated_by'] = Auth::user()->id;
        $contact_list->update($request->all());

        $file = $request->file('contactfile');
        //dd($contact_list);
        $import_report = $this->importContacts($file, ',', $contact_list);

        $tracker = new Tracker();
        $tracker->track('Contact list updated: ' . $request['name']);

        if (!file_exists($file) || !is_readable($file)) {
            return redirect($this->admin_url);
        }

        return view('admin.contact_lists.import_report', compact('import_report', 'page_title', 'object_name', 'breadcrums'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactList $contactList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactList $contactList)
    {
        $contactList->delete();
        $tracker = new Tracker();
        $tracker->track('Contact list deleted: ' . $contactList->name);
        return redirect($this->admin_url);
    }


    private function importContacts($filename = '', $delimiter = ',', ContactList $contact_list)
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        $existing_contacts = array();
        $total_contacts = 0;
        $new_contacts = 0;

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {

                if (!$header)
                    $header = $row;
                else {
                    $item_array = array_combine($header, $row);
                    // Total contacts  from the file
                    $total_contacts = $total_contacts + 1;

//                    $validator = Validator::make($item_array, [
//                        'email' => 'required|email|max:255|unique:contacts,email'
//                    ]);

                    $existing_contact = Contact::where('email', $item_array['email'])->withTrashed()->first();

                    if ($existing_contact === null) {
                        $item_array['verification_key'] = str_random(25);
                        $item_array['email_verified'] = 'verified';
                        $item_array['renewal_date'] = config('variables.import_renewal_datetime');
                        $item_array['status'] = 1;
                        //print_r($item_array);
                        $item_array['work_type'] = $this->convertWorkTypeForCSVImport($item_array['work_type']);
                        $item_array['country'] = $this->convertCountryForCSVImport($item_array['country']);

                        //dd($item_array);
                        $contact = new Contact($item_array);
                        //signupOnImport will not send the email
                        $contact->signupOnImport($contact);
                        //$contact_list->contacts()->detach($contact->id);
                        $contact_list->contacts()->syncWithoutDetaching($contact->id);
                        $new_contacts = $new_contacts + 1;
                    } else {
                        //$contact_list->contacts()->detach($existing_contact->id);

                        if (!$existing_contact->trashed()) {
                            $contact_list->contacts()->syncWithoutDetaching($existing_contact->id);
                            $item_array['trashed'] = '';
                        } else {
                            $item_array['trashed'] = 'Yes';
                        }
                        $item_array['id'] = $existing_contact->id;
                        $existing_contacts[] = $item_array;
                    }
                    //

                    //dump($contact);

                    ///$this->saveContact($item_array);
                }

            }
            fclose($handle);
        }
        //dump($data);
        //dd("End");
        $data['existing'] = $existing_contacts;
        $data['stats']['total_contacts'] = $total_contacts;
        $data['stats']['new_contacts'] = $new_contacts;
        return $data;
    }

    private function convertWorkTypeForCSVImport($wt)
    {
        $wt_key = "";
        foreach (config('variables.work_type') as $key => $type):
            if ($type == trim($wt)):
                $wt_key =  $key;
            endif;

        endforeach;

        return $wt_key;
    }

    private function convertCountryForCSVImport($cnty)
    {
        $ct_key = "";
        foreach (config('variables.countries') as $key => $country):
            if ($country == trim($cnty)):
                $ct_key =  $key;
            endif;

        endforeach;

        return $ct_key;
    }

//   TODO:: Remove this function
    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


    private function uploadFile($file)
    {
        $date = Carbon::now();
        //get the original file name
        $uploaded['original_filename'] = $file->getClientOriginalName();
        //dump($file->path());
        //get a unique file name
        $uploaded['filename'] = $date->getTimestamp() . $uploaded['original_filename'];
        //store the file
        $uploaded['path'] = $file->storeAs('images', $uploaded['filename'], 'local');

        //create thumb nail
        $image_manager = new ImageManager(array('driver' => 'gd'));

        $image = $image_manager->make($file->path())
            ->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(storage_path('app\public\images\thumb\\') . $uploaded['filename']);

        //Image::make(Input::file('photo'))->resize(300, 200)->save('foo.jpg');
        //dd(storage_path('app\public\images\thumb\\').$uploaded['filename']);

        return $uploaded;
    }


}
