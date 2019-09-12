<?php
/**
 * Created by PhpStorm.
 * User: muhammad
 * Date: 27/11/18
 * Time: 12:35
 */

namespace App\Modules\Front;


use App\Support\Repository;
use App\Models\Contact as ContactModel;
use Illuminate\Http\Request;

class Contact
{

    /**
     * @var Repository
     */
    private $globalRepository;

    /**
     * @var ContactModel
     */
    private $contactModel;


    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->globalRepository = new Repository();
        $this->contactModel = new ContactModel();
    }

    public function createContact(Request $request)
    {

        $validation = $this->validateCreateContactRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }

        $data = $request->all();

        $contact = $this->contactModel->create($data);

        return return_msg(true, 'contact created', compact('contact'));
    }


    function validateCreateContactRequest(Request $request)
    {

        return validator($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'message' => 'required',
        ]);
    }
}