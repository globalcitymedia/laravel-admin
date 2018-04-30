<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\ContactList;
use App\Http\Requests\ContactRequest;
use App\Tracker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.contact_lists.index', compact('contact_lists','page_title','object_name','breadcrums'));
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
        $breadcrums = array(['title'=>'Contact Lists', 'url'=>'/admin/contact-lists'],['title'=>'Create new list', 'url'=>'']);
        return view('admin.contact_lists.create', compact('page_title','object_name','breadcrums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;
        $contact_list = new ContactList($request->all());

        $file = $request->file('contactfile');
        //dd($contact_list);


        $contact_list->saveOrFail($contact_list->toArray());
        //dd($contact_list);
        $this->importContacts($file,$contact_list);
        //dd($ip_add);
        $tracker = new Tracker();
        $tracker->track('New contact list: '.$request['name']);

        return redirect($this->admin_url);
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function show(ContactList $contactList)
    {
        $page_title = $contactList->name;
        $object_name = $this->object_name;
        $breadcrums = array(['title'=>'Contact Lists', 'url'=>'/admin/contact-lists'],
            ['title'=>$contactList->name, 'url'=>'/admin/contact-lists/'.$contactList->id]);

        return view('admin.contact_lists.show', compact('page_title','object_name','breadcrums','contactList'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactList $contactList)
    {
        $page_title = "Edit list";
        $object_name = $this->object_name;
        $breadcrums = array(['title'=>'Contact Lists', 'url'=>'/admin/contact-lists'],['title'=>'Edit list', 'url'=>'']);

        return view('admin.contact_lists.edit', compact('page_title','object_name','breadcrums','contactList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactList $contact_list)
    {
        $request['updated_by'] = Auth::user()->id;
        $contact_list->update($request->all());

        $file = $request->file('contactfile');
        //dd($contact_list);
        $this->importContacts($file,',',$contact_list);

        $tracker = new Tracker();
        $tracker->track('Contact list updated: '.$request['name']);

        return redirect($this->admin_url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactList $contactList)
    {
        $contactList->delete();
        $tracker = new Tracker();
        $tracker->track('Contact list deleted: '.$contactList->name);
        return redirect($this->admin_url);
    }


    private function importContacts($filename = '', $delimiter = ',',ContactList $contact_list)
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;


        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {

                if (!$header)
                    $header = $row;
                else {
                    $item_array = array_combine($header, $row);
                    $data[] = $item_array;

//                    $validator = Validator::make($item_array, [
//                        'email' => 'required|email|max:255|unique:contacts,email'
//                    ]);

                    $existing_contact =  Contact::where('email', $item_array['email'])->first();

                    if($existing_contact === null){
                        $item_array['verification_key'] = str_random(25);
                        $item_array['renewal_date'] = config('variables.renewal_datetime');
                        $item_array['status'] = 2;
                        $contact = new Contact($item_array);
                        $contact->signup($contact);
                        //$contact_list->contacts()->detach($contact->id);
                        $contact_list->contacts()->syncWithoutDetaching($contact->id);
                    }else{
                        //$contact_list->contacts()->detach($existing_contact->id);
                        $contact_list->contacts()->syncWithoutDetaching($existing_contact->id);
                    }
                    //

                    //dump($contact);

                    ///$this->saveContact($item_array);
                }

            }
            fclose($handle);
        }
        dd("End");
        return $data;
    }


    public function saveContact($data)
    {
        dump($data);
    }

    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


    private function uploadFile($file){
        $date = Carbon::now();
        //get the original file name
        $uploaded['original_filename'] = $file->getClientOriginalName();
        //dump($file->path());
        //get a unique file name
        $uploaded['filename'] = $date->getTimestamp().$uploaded['original_filename'];
        //store the file
        $uploaded['path'] = $file->storeAs('images',$uploaded['filename'],'local');

        //create thumb nail
        $image_manager = new ImageManager(array('driver' => 'gd'));

        $image = $image_manager->make($file->path())
            ->resize(150, null, function ($constraint) {$constraint->aspectRatio();})
            ->save(storage_path('app\public\images\thumb\\').$uploaded['filename']);

        //Image::make(Input::file('photo'))->resize(300, 200)->save('foo.jpg');
        //dd(storage_path('app\public\images\thumb\\').$uploaded['filename']);

        return $uploaded;
    }


}
