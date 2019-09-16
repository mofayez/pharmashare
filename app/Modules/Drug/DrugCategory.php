<?php

namespace App\Modules\Drug;

use App\Models\DrugCategory as DrugCategoryModel;

class DrugCategory
{

    /**
     * @var DrugCategoryModel
     */
    private $drugCategoryModel;


    /**
     * DrugCategory constructor.
     */
    public function __construct()
    {

        $this->drugCategoryModel = new DrugCategoryModel;
    } // end of constructor function


    /**
     * get all drug categories detailed (including drugs)
     *
     * @return DrugCategoryModel[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {

        $drug_categories = $this->drugCategoryModel
            ->with('drugs')
            ->get();

        return $drug_categories;
    } // end of all function


    /**
     * store category into database
     *
     * @param array $data [title]
     * @return mixed
     */
    public function saveDrugCategory(array $data)
    {

        $drug_category = $this->drugCategoryModel->create($data);

        return $drug_category;
    } // end of saveDrugCategory function


    /**
     * search for category by id
     *
     * @param int $id
     * @return DrugCategoryModel|DrugCategoryModel[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {

        $drug_category = $this->drugCategoryModel
            ->with('drugs')
            ->find($id);

        return $drug_category;
    } // end of find function


    /**
     * search for category by category title
     *
     * @param string $categoryTitle
     * @return mixed
     */
    public function findByName(string $categoryTitle)
    {

        $drug_category = $this->drugCategoryModel
            ->whereTitle($categoryTitle)
            ->first();

        return $drug_category;
    } // end of find function

} // end of DrugCategory class