<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\FeatureSection\FeatureSectionFactory;
use App\DB\Providers\SQL\Factories\Factories\News\NewsFactory;
use App\Repositories\Interfaces\Repositories\NewsRepoInterface;


class FeatureSectionRepository extends SqlRepository implements NewsRepoInterface
{
    private $featureSection;
    public function __construct()
    {
        $this->featureSection = new FeatureSectionFactory();
    }
    public function all()
    {
        return $this->featureSection->all();
    }

}