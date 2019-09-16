<?php
/**
 * Created by PhpStorm.
 * User: muhammad
 * Date: 27/11/18
 * Time: 09:45
 */

namespace App\Modules\Front;


use App\Support\Repository;
use  App\Models\Slider as SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Slider
{
    /**
     * @var Repository
     */
    private $globalRepository;

    /**
     * @var SliderModel
     */
    private $sliderModel;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->globalRepository = new Repository();
        $this->sliderModel = new SliderModel();
    }

    public function all()
    {
        $slides = $this->sliderModel
            ->all()
            ->load(['image']);


        return return_msg(true, 'all slides', compact('slides'));
    }

    public function find($id)
    {
        $slide = $this->sliderModel
            ->find($id);


        if ($slide) {
            $slide->load(['image']);
            return return_msg(true, 'this slides', compact('slide'));
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }

    public function store(Request $request)
    {

        $validation = $this->validateCreateSlideRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }

        DB::beginTransaction();
        try {
            $data = $request->all();

            $slide = $this->sliderModel->create([]);
            $slide->details()->createMany([
                [
                    'title' => $data['title_ar'] ?? '',
                    'description' => $data['description_ar'] ?? '',
                    'language' => 'ar',
                ],
                [
                    'title' => $data['title_en'] ?? '',
                    'description' => $data['description_en'] ?? '',
                    'language' => 'en',
                ]
            ]);

            if (isset($data['image']) && $data['image']) {
                $image = $this->uploadFile($data['image']);
                $slide->image()->create([
                    $image
                ]);
            }

            DB::commit();
            return return_msg(true, 'created', []);
        } catch (\Exception $ex) {

            DB::rollback();
            return return_msg(false, $ex->getMessage(), [
                'validation_errors' => []
            ]);
        }
    }

    public function update(Request $request)
    {


        $validation = $this->validateCreateSlideRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }


        DB::beginTransaction();
        try {
            $data = $request->all();

            $slide = $this->sliderModel->find($data['id']);
            $slide_ar = $slide->details()->where('language','ar')->first();
            $slide_en = $slide->details()->where('language','en')->first();

            $slide_ar->title = $data['title_ar'];
            $slide_ar->description = $data['description_ar'];

            $slide_en->title = $data['title_en'];
            $slide_en->description = $data['description_en'];

            $slide_ar->save();
            $slide_en->save();

            DB::commit();
            return return_msg(true, 'created', []);
        } catch (\Exception $ex) {

            DB::rollback();
            return return_msg(false, $ex->getMessage(), [
                'validation_errors' => []
            ]);
        }
    }


    public function delete($id)
    {

        $slide = $this->sliderModel
            ->find($id);

        if ($slide) {

            $slide->delete();
            $slide->details()->delete();
            $slide->image()->delete();

            return return_msg(true, 'slide deleted', []);
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }


    function validateCreateSlideRequest(Request $request)
    {

        return validator($request->all(), [
            'title_ar' => 'required',
            'description_ar' => 'required',
            'title_en' => 'required',
            'description_en' => 'required',
        ]);
    }


    function uploadFile($file, $disk = null)
    {

        if (!$file) {
            return;
        }

        $file_name = uniqid() . '.' . $file->extension();

        $file->move(storage_path('files/slider'), $file_name);

        return $file_name;
    }


}