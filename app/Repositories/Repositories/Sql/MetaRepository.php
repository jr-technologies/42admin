<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\City\CityFactory;
use App\DB\Providers\SQL\Factories\Factories\Meta\MetaFactory;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Meta;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;

class MetaRepository extends SqlRepository implements UsersRepoInterface
{
    private $cityTransformer;
    private $factory = null;
    public function __construct(){
        $this->cityTransformer = null;
        $this->factory = new MetaFactory();
    }

    public function store(Meta $meta)
    {
        return $this->factory->store($meta);
    }
    public function all()
    {
        return $this->factory->all();
    }
    public function delete($metaId)
    {
        return $this->factory->delete($metaId);
    }
    public function getById($metaId)
    {
        return $this->factory->find($metaId);
    }
    public function update(Meta $meta)
    {
        return $this->factory->update($meta);
    }
}
