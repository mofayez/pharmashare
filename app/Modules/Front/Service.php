<?php
/**
 * Created by PhpStorm.
 * User: muhammad
 * Date: 27/11/18
 * Time: 09:45
 */

namespace App\Modules\Front;


use App\Support\Repository;
use  App\Models\Service as ServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Service
{
    /**
     * @var Repository
     */
    private $globalRepository;

    /**
     * @var SliderModel
     */
    private $serviceModel;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->globalRepository = new Repository();
        $this->serviceModel = new ServiceModel();
    }

    public function all()
    {
        $services = $this->serviceModel
            ->all();


        return return_msg(true, 'all services', compact('services'));
    }

    public function find($id)
    {
        $service = $this->serviceModel
            ->find($id);


        if ($service) {
            return return_msg(true, 'this slides', compact('service'));
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


        $validation = $this->validateCreateServiceRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }


        DB::beginTransaction();
        try {
            $data = $request->all();

            $serivce = $this->serviceModel->find($data['id']);
            $serivce_ar = $serivce->details()->where('language','ar')->first();
            $serivce_en = $serivce->details()->where('language','en')->first();

            $serivce_ar->title = $data['title_ar'];
            $serivce_ar->description = $data['description_ar'];

            $serivce_en->title = $data['title_en'];
            $serivce_en->description = $data['description_en'];

            $serivce_ar->save();
            $serivce_en->save();

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

        $slide = $this->serviceModel
            ->find($id);

        if ($slide) {

            $slide->delete();
            $slide->details()->delete();
            $slide->image()->delete();

            return return_msg(true, 'service deleted', []);
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }


    function validateCreateServiceRequest(Request $request)
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