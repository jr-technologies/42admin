<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Api\V1\CitiesController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Project\AddProjectRequest;
use App\Http\Requests\Requests\Project\DeleteProjectImageRequest;
use App\Http\Requests\Requests\Project\DeleteProjectRequest;
use App\Http\Requests\Requests\Project\GetAllProjectsRequest;
use App\Http\Requests\Requests\Project\GetProjectImagesRequest;
use App\Http\Requests\Requests\Project\GetProjectRequest;
use App\Http\Requests\Requests\Project\UpdateProjectRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\ProjectsRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;


class ProjectsController extends Controller
{
    public $response = null;
    public $projectRepo = null;
    public $cities = null;
    public $locations = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->cities = (new CitiesRepoProvider())->repo();
        $this->projectRepo = (new ProjectsRepoProvider())->repo();
        $this->locations = (new LocationsRepoProvider())->repo();
    }
    public function project()
    {
        return $this->response->setView('projects.project')->respond(['data'=>[
            'cities'=>$this->cities->all(),
        ]]);
    }
    public function addProject(AddProjectRequest $request)
    {
        $projectId = $this->projectRepo->addProject($request->getProjectModel());

        if($request->get('images')[0] !=null)
         $this->addProjectImages($request,$projectId);
        return redirect('project/listing');
    }
    public function addProjectImages(AddProjectRequest $request ,$projectId)
    {
        return $this->projectRepo->addImages($request->getProjectImageModel(),$projectId);
    }
    public function getAllProjects(GetAllProjectsRequest $request)
    {
        return $this->response->setView('projects.project-listing')->respond(['data'=>[
            'projects'=>$this->projectRepo->getAllProjects($request->all()),
            'projectCount'=>($this->projectRepo->projectCount()[0]->total_records),
            'linkStatus'=>'projectListing'
        ]]);
    }
    public function deleteProject(DeleteProjectRequest $request)
    {
        $this->projectRepo->deleteProject($request->get('projectId'));
        return redirect('project/listing');
    }
    public function updateProjectForm(GetProjectRequest $request)
    {
        $project = $this->projectRepo->getProject($request->get('projectId'));
        return $this->response->setView('projects.update-project')->respond(['data'=>[
            'project'=>$project,
            'cities'=>$this->cities->all(),
            'societies'=>$this->locations->getByCity($project->cityId)
         ]]);
    }
    public function updateProject(UpdateProjectRequest $request)
    {
        $this->projectRepo->updateProject($request->getProjectModel());
        if(($request->get('images')[0]) !=null && ($request->get('images')[0]) !="")
            $this->projectRepo->addImages($request->getProjectImageModel(),$request->get('projectId'));
        return redirect('project/listing');
    }
    public function getProjectImages(GetProjectImagesRequest $request)
    {
        return $this->response->setView('projects.images-listing')->respond(['data'=>[
            'projectImage'=>$this->projectRepo->getProjectImages($request->get('projectId'))
        ]]);
    }
    public function deleteProjectImage(DeleteProjectImageRequest $request)
    {
        $this->projectRepo->deleteProjectImage($request->get('imageId'));
        return redirect('get/project/images');
    }
}
