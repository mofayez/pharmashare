<?php
/**
 * Created by PhpStorm.
 * User: muhammad
 * Date: 27/11/18
 * Time: 09:45
 */

namespace App\Modules\Front;


use App\Support\Repository;
use  App\Models\FAQ as FAQModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FAQ
{
    /**
     * @var Repository
     */
    private $globalRepository;

    /**
     * @var FAQModel
     */
    private $FAQModel;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->globalRepository = new Repository();
        $this->FAQModel = new FAQModel();
    }

    public function all()
    {
        $faq = $this->FAQModel
            ->all();


        return return_msg(true, 'all faqs', compact('faq'));
    }

    public function find($id)
    {
        $slide = $this->FAQModel
            ->find($id);


        if ($slide) {
            return return_msg(true, 'this faq', compact('faq'));
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {


        $validation = $this->validateCreateFAQRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }


        DB::beginTransaction();
        try {
            $data = $request->all();

            $faq = $this->FAQModel->find($data['id']);
            $faq->question_ar = $data['question_ar'];
            $faq->question_en = $data['question_en'];
            $faq->answer_ar = $data['answer_ar'];
            $faq->answer_en = $data['answer_en'];
            $faq->save();

            DB::commit();
            return return_msg(true, 'updated', []);
        } catch (\Exception $ex) {

            DB::rollback();
            return return_msg(false, $ex->getMessage(), [
                'validation_errors' => []
            ]);
        }
    }


    public function delete($id)
    {

        $faq = $this->FAQModel
            ->find($id);

        if ($faq) {

            $faq->delete();

            return return_msg(true, '$faq deleted', []);
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }


    function validateCreateFAQRequest(Request $request)
    {

        return validator($request->all(), [
            'question_ar' => 'required',
            'question_en' => 'required',
            'answer_ar' => 'required',
            'answer_en' => 'required',
        ]);
    }


}