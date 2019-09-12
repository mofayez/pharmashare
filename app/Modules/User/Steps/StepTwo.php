<?php

namespace App\Modules\User\Steps;


use App\Models\UserLocation;

class StepTwo
{


    /**
     * @var UserLocation
     */
    private $userLocation;


    /**
     * StepTwo constructor.
     */
    public function __construct()
    {

        $this->userLocation = new UserLocation;
    } // end of constructor function


    /**
     * save location into database
     *
     * @param array $data
     * @return mixed
     */
    public function saveLocation(array $data)
    {

        $location = $this->userLocation->updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );

        return $location;
    } // end of createLocation function

    public function deleteLocation(int $id)
    {

        $location = $this->findLocation($id);

        try {

            return $location->delete();

        } catch (\Exception $exception) {

            return $exception->getMessage();
        } // end of exception handler
    } // end of findLocation function

    /**
     * search for location by id
     *
     * @param int $id
     * @return mixed
     */
    public function findLocation(int $id)
    {

        return $this->userLocation->find($id);
    } // end if deleteLocation function

} // end of function