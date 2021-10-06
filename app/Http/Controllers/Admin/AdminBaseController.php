<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class AdminBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Get auth user id
     * @return int
     */
    protected function getAuthUserId() : int {
        return $this->getAuth()->id;
    }

    /**
     * Get auth user
     * Get auth email
     * @return string
     */
    protected function getAuthUserEmail() : string {
        return $this->getAuth()->email;
    }

    /**
     * Get Auth user
     * @return User
     */
    protected function getAuthUser() : User{
        return $this->getAuth();
    }

    private function getAuth() : User {
        return Auth::user();
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap() : array
    {
        return [
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
            'importPosts'=>'importPosts', //Custom policy
            'importStatus'=>'importPosts' //Custom policy
        ];
    }


    /**
     * Get the list of resource methods which do not have model parameters.
     *
     * @return array
     */
    protected function resourceMethodsWithoutModels() : array
    {
        return ['index', 'create', 'store','importPosts', 'importStatus'];
    }
}