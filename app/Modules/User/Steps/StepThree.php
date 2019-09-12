<?php

namespace App\Modules\User\Steps;


use App\Models\UserPaper;
use Illuminate\Support\Facades\Storage;

class StepThree
{

    /**
     * @var UserPaper $userPaper
     */
    private $userPaper;


    /**
     * @var string $storagePath
     */
    private $storagePath;


    /**
     * StepTwo constructor.
     */
    public function __construct()
    {

        $this->userPaper = new UserPaper;
//        $this->storagePath = storage_path('files' . DIRECTORY_SEPARATOR . 'papers') . DIRECTORY_SEPARATOR;
        $this->storagePath =  'https://s3.amazonaws.com/pharmashare-files/'; //storage_path('files/users');

    } // end of constructor function


    /**
     * save paper into database
     *
     * @param array $data
     * @return mixed
     */
    public function savePapers(array $data)
    {

        $paper = $this->userPaper->firstOrCreate(['user_id' => $data['user_id']]);

        if (isset($data['trade_license']) && $data['trade_license']) {

            $this->saveFile($paper, $data, 'trade_license');
        } // end if

        if (isset($data['passport']) && $data['passport']) {

            $this->saveFile($paper, $data, 'passport');
        } // end if

        if (isset($data['pharmacy_license']) && $data['pharmacy_license']) {

            $this->saveFile($paper, $data, 'pharmacy_license');
        } // end if

        $paper->save(); // save into data base

        return $paper;
    } // end of createPapers function

    /**
     * store model's file
     *
     * @param $model
     * @param $data
     * @return string
     */
    protected function saveFile(&$model, $data, $attr)
    {

        $old_file = $model->$attr;
        if ($old_file) {
            $old = str_replace($this->storagePath, '', $old_file) ;
//            @unlink($this->storagePath . $old_file);
            Storage::disk('s3')->delete($old);

        } // end if


        $file = $data[$attr]; // get file index

        $file_name = $this->uploadFileToS3($file);
        $file_name = $this->storagePath . $file_name;
//        $file_extension = $file->extension(); // get file extension
//        $file_name = 'IMG_' . rand()
//            . time() . '.' . $file_extension; // generate file name
//        $file->move($this->storagePath, $file_name);

        $model->$attr = $file_name;

        return $model;
    } // end of findPapers function

    public function deletePapers(int $id)
    {

        $paper = $this->findPapers($id);

        try {

            return $paper->delete();

        } catch (\Exception $exception) {

            return $exception->getMessage();
        } // end of exception handler
    } // end if deletePapers function

    /**
     * search for paper by id
     *
     * @param int $id
     * @return mixed
     */
    public function findPapers(int $id)
    {

        return $this->userPaper->find($id);
    } // end of SaveFile function


    public function uploadFileToS3($file_name)
    {

        $file_name = $file_name->store(
            'papers',
            's3'
        );

        return $file_name;
    }
} // end of StepThree class