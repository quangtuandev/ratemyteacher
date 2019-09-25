<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\TeacherRequest;
use App\Repositories\Contracts\TeacherInterface;

class TeacherController extends ApiController
{
    protected $teacherRepository;

    public function __construct(
        TeacherInterface $teacherRepository
    ) {
        parent::__construct();
        $this->teacherRepository = $teacherRepository;
    }
       /**
     * @SWG\Get(
     *     path="/api/teacher/show/{id}",
     *     tags={"Teacher"},
     *     summary="get teacher's infomation",
     *     description="Return a user's first and last name",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         type="integer",
     *         description="Id teacher",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing ID"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server errors"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="not found"
     *     ),
     * )
     */
    public function show($id)
    {
        $teacher = $this->teacherRepository->findOrFail($id);
        return $this->getData(function () use ($teacher) {
            $this->compacts['detail_teachers'] = $this->teacherRepository->getTeacher($teacher);
        });
    }
    /**
     * @SWG\Get(
     *     path="/api/teacher/{id}/review",
     *     tags={"Teacher"},
     *     summary="get teacher's review",
     *     description="",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         type="integer",
     *         description="Id teacher",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing ID"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server errors"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="not found"
     *     ),
     * )
     */
    
    public function getReviewTeacher($id)
    {
        $teacher = $this->teacherRepository->findOrFail($id);
        return $this->getData(function () use ($teacher) {
            $this->compacts['review_teachers'] = $this->teacherRepository->getReviewTeacher($teacher);
        });
    }
    /**
     * @SWG\Post(
     *     path="/api/teacher/new",
     *     tags={"Teacher"},
     *     operationId="addTeacher",
     *     summary="Add a new teacher",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         type="string",
     *         description="teacher's name",
     *         required=true,
     *     ),     
     *     @SWG\Parameter(
     *         name="birthday",
     *         in="formData",
     *         type="string",
     *         format="date",
     *         description="teacher's birthday",
     *         required=true,
     *     ),     
     *     @SWG\Parameter(
     *         name="gender",
     *         in="formData",
     *         type="integer",
     *         description="teacher's gender",
     *         required=true,
     *     ),     
     *     @SWG\Parameter(
     *         name="address",
     *         in="formData",
     *         type="string",
     *         description="teacher's address",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="specialize",
     *         in="formData",
     *         type="string",
     *         description="teacher's specialize",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="description",
     *         in="formData",
     *         type="string",
     *         description="teacher's description",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="phone",
     *         in="formData",
     *         type="integer",
     *         description="teacher's phone",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         type="string",
     *         description="teacher's image",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="identity_card",
     *         in="formData",
     *         type="string",
     *         description="teacher's identity_card",
     *         
     *     ),
     *      @SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         type="string",
     *         format="email",
     *         description="teacher's email",
     *         
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input",
     *     ),
     *     security={{"auth":{"*":"777"}}}
     * )
     */
    public function store(TeacherRequest $request){
        $data = $request->only(
            'name',
            'birthday',
            'gender',
            'address',
            'specialize',
            'description',
            'phone',
            'image',
            'identity_card',
            'email'
        );
        $data['user_id'] = $this->user->id;
        return $this->doAction(function () use ($data) {
            $this->compacts['message'] = $this->teacherRepository->create($data);
        });
    }
    public function listPhotos($id){
        $teacher = $this->teacherRepository->findOrFail($id);
        return $this->getData(function () use ($teacher){
            $this->compacts['url_images'] = $this->teacherRepository->getTeacherPhotos($teacher);
        });
    }

    public function getOverView($id){
        $teacher = $this->teacherRepository->findOrFail($id);
        return $this->getData(function () use ($teacher){
            $this->compacts['over_view'] = $this->teacherRepository->getOverView($teacher);
        });
    }
}
