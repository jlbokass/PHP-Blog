<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 11/02/2019
 * Time: 06:14
 */

namespace App\Utilities;

/**
 * Class Pagination
 * @package App\Utilities
 */
class Paginator
{
    /**
     * @var
     */
    public $limit;
    /**
     * @var float|int
     */
    public $offset;

    public $previous;

    public $next;

    /**
     * Paginator constructor.
     * @param $page
     * @param $records_per_page
     */
    public function __construct($page, $records_per_page)
    {
        $this->limit = $records_per_page;

        $page = filter_var($page, FILTER_VALIDATE_INT, [
           'options' => [
               'default' => 1,
               'min_range' => 1
           ] ]);

        $this->previous = $page - 1;

        $this->next = $page + 1;


        $this->offset = $records_per_page * ($page - 1);
    }
}
