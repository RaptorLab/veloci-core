<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/04/16
 * Time: 06:40
 */

namespace Veloci\Core\Helper\Resultset;


use Closure;
use Veloci\Core\Helper\Resultset\Filter\ResultsetFilter;

class RepositoryResultset implements Resultset
{

    /**
     * @var \Iterator
     */
    private $cursor;

    /**
     * @var Closure
     */
    private $hydrator;

    /**
     * @var ResultsetFilter[]
     *
     */
    private $filters;

    public function __construct(\Iterator $cursor, Closure $hydrator = null)
    {
        $this->cursor   = $cursor;
        $this->hydrator = $hydrator;
        $this->filters  = [];

        $this->cursor->rewind();
    }

    public function current()
    {
        $current = $this->cursor->current();

        if ($current === null) {
            return null;
        }

        $result = $this->applyFilters((array)$current);

        return ($this->hydrator === null) ? $result : $this->hydrator->call($this, $result);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        // TODO: Implement next() method.
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    /**
     * @param ResultsetFilter $filter
     */
    public function appendFilter(ResultsetFilter $filter)
    {
        // TODO: Implement appendFilter() method.
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        // TODO: Implement toArray() method.
    }

    /**
     * @return mixed
     */
    public function getNextElement()
    {
        // TODO: Implement getNextElement() method.
    }

    protected function applyFilters(array $input):array
    {
        foreach ($this->filters as $filter) {
            $filter->apply($input);
        }

        return $input;
    }
}