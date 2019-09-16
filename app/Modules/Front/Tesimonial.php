<?php
/**
 * Created by PhpStorm.
 * User: muhammad
 * Date: 27/11/18
 * Time: 09:45
 */

namespace App\Modules\Front;


use App\Support\Repository;
use  App\Models\Testimonail as TestimonailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Tesimonial
{
    /**
     * @var Repository
     */
    private $globalRepository;

    /**
     * @var SliderModel
     */
    private $testimonialModel;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->globalRepository = new Repository();
        $this->testimonialModel = new TestimonailModel();
    }

    /**
     * @return array|null
     */
    public function all()
    {
        $testimonials = $this->testimonialModel
            ->all();


        return return_msg(true, 'all testimonials', compact('testimonials'));
    }

    /**
     * @param $id
     * @return array|null
     */
    public function find($id)
    {
        $testimonial = $this->testimonialModel
            ->find($id);


        if ($testimonial) {
            return return_msg(true, 'this testimonial', compact('testimonial'));
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function update(Request $request)
    {


        $validation = $this->validateCreateTestimonialRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }


        DB::beginTransaction();
        try {
            $data = $request->all();

            $testimonial = $this->testimonialModel->find($data['id']);

            $testimonial->client_name_ar = $data['client_name_ar'];
            $testimonial->client_name_en = $data['client_name_en'];
            $testimonial->description_ar = $data['description_ar'];
            $testimonial->description_en = $data['description_en'];
            $testimonial->save();


            DB::commit();
            return return_msg(true, 'updated', []);
        } catch (\Exception $ex) {

            DB::rollback();
            return return_msg(false, $ex->getMessage(), [
                'validation_errors' => []
            ]);
        }
    }


    /**
     * @param $id
     * @return array|null
     */
    public function delete($id)
    {

        $testimonial = $this->testimonialModel
            ->find($id);

        if ($testimonial) {

            $testimonial->delete();

            return return_msg(true, 'pricing deleted', []);
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function validateCreateTestimonialRequest(Request $request)
    {

        return validator($request->all(), [
            'client_name_ar' => 'required',
            'client_name_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
        ]);
    }


    /**
     * @param $file
     * @param null $disk
     * @return string|void
     */
    function uploadFile($file, $disk = null)
    {

        if (!$file) {
            return;
        }

        $file_name = uniqid() . '.' . $file->extension();

        $file->move(storage_path('files/testimonial'), $file_name);

        return $file_name;
    }


}