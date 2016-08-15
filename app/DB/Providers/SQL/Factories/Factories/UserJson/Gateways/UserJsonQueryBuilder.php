<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserJson\Gateways;


use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencySociety\AgencySocietyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways\Helpers\UserPropertiesHelper;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
use App\DB\Providers\SQL\Factories\Factories\UserRole\UserRolesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Support\Facades\DB;

class UserJsonQueryBuilder extends QueryBuilder{
    use UserPropertiesHelper;
    private $agentPrimaryKey = 3;
    public function __construct(){
        $this->table = "user_json";
    }

    public function findByUser($id)
    {
        return DB::table($this->table)->where('user_id','=',$id)->first();
    }


    public function getStaffByOwner($userId)
    {
        $agencyStaffTable = (new AgencyStaffFactory())->getTable();
        $usersTable = (new UserFactory())->getTable();
        $agenciesTable = (new AgencyFactory())->getTable();

        return DB::table($agenciesTable)
            ->rightjoin($agencyStaffTable,$agenciesTable.'.id','=',$agencyStaffTable.'.agency_id')
            ->leftjoin($usersTable,$agencyStaffTable.'.user_id','=',$usersTable.'.id')
            ->leftjoin($this->table,$usersTable.'.id','=',$this->table.'.user_id')
            ->select($this->table.'.*')
            ->where($agenciesTable.'.user_id','=',$userId )
            ->get();
    }

    public function getAgencyStaff($agencyId)
    {
        $agencyStaffTable = (new AgencyStaffFactory())->getTable();
        $usersTable = (new UserFactory())->getTable();
        $agenciesTable = (new AgencyFactory())->getTable();

        return DB::table($agenciesTable)
            ->rightjoin($agencyStaffTable,$agenciesTable.'.id','=',$agencyStaffTable.'.agency_id')
            ->leftjoin($usersTable,$agencyStaffTable.'.user_id','=',$usersTable.'.id')
            ->leftjoin($this->table,$usersTable.'.id','=',$this->table.'.user_id')
            ->select($this->table.'.*')
            ->where($agenciesTable.'.id','=',$agencyId )
            ->get();
    }
    public function search($params)
    {
        $userTable = (new UserFactory())->getTable();
        $userRoleTable = (new UserRolesFactory())->getTable();
        $limit = $this->getLimit($params);

        $query = DB::table($userTable)
            ->leftjoin($userRoleTable,$userTable.'.id','=',$userRoleTable.'.user_id')
            ->leftjoin($this->table,$userTable.'.id','=',$this->table.'.user_id')
            ->select($this->table.'.json')
            ->distinct();
        if(isset($params['email']) && $params['email'] !=null && $params['email'] !="")
            $query = $query->where($userTable.'.email','=',$params['email']);
        if(isset($params['phone']) && $params['phone'] !=null && $params['phone'] !="")
            $query = $query->where($userTable.'.phone','=',$params['phone']);
        if(isset($params['firstName']) && $params['firstName'] !=null && $params['firstName'] !="")
            $query = $query->where($userTable.'.f_name','like','%'.$params['firstName'].'%');
        if(isset($params['lastName']) && $params['lastName'] !=null && $params['lastName'] !="")
            $query = $query->where($userTable.'.l_name','like','%'.$params['lastName'].'%');
        if(isset($params['type']) && $params['type'] !=null && $params['type'] !="")
            $query = $query->where($userRoleTable.'.role_id',$params['type']);

        $query = $query->skip($limit['start'])->take($limit['limit']);
       return  $query = $query->get();
    }

    public function getPendingAgents()
    {
        $userTable = (new UserFactory())->getTable();
        $userRoleTable = (new UserRolesFactory())->getTable();
        return DB::table($userTable)
           ->join($this->table,$userTable.'.id','=',$this->table.'.user_id')
           ->leftjoin($userRoleTable,$userTable.'.id','=',$userRoleTable.'.user_id')
           ->select($this->table.'.json')
            ->where($userRoleTable.'.role_id','=',3)
           ->where($userTable.'.trusted_agent','=',0)
           ->get();
    }
    public function trustedAgents(array $params)
    {
        $userTable = (new UserFactory())->getTable();
        $userRoleTable = (new UserRolesFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();
        $agencySocietyTable = (new AgencySocietyFactory())->getTable();

        $query = DB::table($userTable)
            ->leftjoin($userRoleTable,$userTable.'.id','=',$userRoleTable.'.user_id')
            ->join($this->table,$userTable.'.id','=',$this->table.'.user_id')
            ->leftjoin($agencyTable,$userTable.'.id','=',$agencyTable.'.user_id')
            ->leftjoin($agencySocietyTable,$agencyTable.'.id','=',$agencySocietyTable.'.agency_id')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS '.$this->table.'.json'))
            ->distinct();

            if(isset($params['society']) && $params['society'] !=null && $params['society'] !="")
                $query = $query->where($agencySocietyTable.'.society_id','=',$params['society']);

            if(isset($params['agencyName']) && $params['agencyName'] !=null && $params['agencyName'] !="")
                $query = $query->where($agencyTable.'.agency','like','%'.$params['agencyName'].'%');

        $query = $query->where($userRoleTable.'.role_id','=',$this->agentPrimaryKey);
        $query = $query->where($userTable.'.trusted_agent','=',1);
        $query = $query->skip($params['start'])->take($params['limit']);
        $agents = $query->get();

        \Session::flash('totalAgentsFound', DB::select('select FOUND_ROWS() as count'));
        return $agents;
    }
    public function getTrustedAgentsWithPriority(array $params)
    {
        $userTable = (new UserFactory())->getTable();
         return DB::table($userTable)
            ->join($this->table,$userTable.'.id','=',$this->table.'.user_id')
            ->select($this->table.'.json')
             ->where($userTable.'.priority','>',0)
             ->where($userTable.'.trusted_agent','=',1)
            ->orderBy($userTable.'.priority','asc')
            ->take($params['limit'])
            ->get();
    }
    public function getAllTrustedAgents()
    {
        $userTable = (new UserFactory())->getTable();
        $userRoleTable = (new UserRolesFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();
        $agencySocietyTable = (new AgencySocietyFactory())->getTable();

        $query = DB::table($userTable)
            ->leftjoin($userRoleTable,$userTable.'.id','=',$userRoleTable.'.user_id')
            ->join($this->table,$userTable.'.id','=',$this->table.'.user_id')
            ->leftjoin($agencyTable,$userTable.'.id','=',$agencyTable.'.user_id')
            ->leftjoin($agencySocietyTable,$agencyTable.'.id','=',$agencySocietyTable.'.agency_id')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS '.$this->table.'.json'))
            ->distinct();
        $query = $query->where($userRoleTable.'.role_id','=',$this->agentPrimaryKey);
        $query = $query->where($userTable.'.trusted_agent','=',1);
        $agents = $query->get();

        \Session::flash('totalAgentsFound', DB::select('select FOUND_ROWS() as count'));
        return $agents;
    }


    public function searchTrustedAgents(array $params)
    {
        $userTable = (new UserFactory())->getTable();
        $userRoleTable = (new UserRolesFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();
        $agencySocietyTable = (new AgencySocietyFactory())->getTable();

        $query = DB::table($userTable)
            ->leftjoin($userRoleTable,$userTable.'.id','=',$userRoleTable.'.user_id')
            ->join($this->table,$userTable.'.id','=',$this->table.'.user_id')
            ->leftjoin($agencyTable,$userTable.'.id','=',$agencyTable.'.user_id')
            ->leftjoin($agencySocietyTable,$agencyTable.'.id','=',$agencySocietyTable.'.agency_id')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS '.$this->table.'.json'))
            ->distinct();

        if($params['society'] !=null && $params['society'] !="")
            $query = $query->where($agencySocietyTable.'.society_id','=',$params['society']);

        if($params['agencyName'] !=null && $params['agencyName'] !="")
            $query = $query->where($agencyTable.'.agency','like','%'.$params['agencyName'].'%');

        $query = $query->where($userRoleTable.'.role_id','=',$this->agentPrimaryKey);
        $query = $query->where($userTable.'.trusted_agent','=',1);
        $query = $query->skip($params['start'])->take($params['limit']);
        $agents = $query->get();

        \Session::flash('totalAgentsFound', DB::select('select FOUND_ROWS() as count'));
        return $agents;
    }


}