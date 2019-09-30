<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Contracts\CenterInterface;

class CenterController extends ApiController
{
    private $centerRepository;

    public function __construct(
        CenterInterface $teacherRepository
    ) {
        parent::__construct();
        $this->centerRepository = $teacherRepository;
    }

    public function index(){
        return $this->getData(function () {
            $this->compacts['list'] = $this->centerRepository->all()->map(function ($item) {
                $teachers = ['teachers' => $item->teachers->count()];
                $item = collect($item);
                return $item->merge($teachers);
            });
        });
    }

    public function show($id) {
        $center = $this->centerRepository->findOrFail($id);
        $teachers =  $center->teachers;
        return $this->getData(function () use ($center) {
            $this->compacts['center'] = $center;
        });
    }
}
