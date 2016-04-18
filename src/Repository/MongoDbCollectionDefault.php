<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 16:17
 */

namespace Veloci\Core\Repository;


use MongoDB\BSON\ObjectID;
use MongoDB\Collection;

class MongoDbCollectionDefault implements MongoDbCollection
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * MongoDbCollectionDefault constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function findById($id)
    {
        return $this->collection->findOne(['_id' => new ObjectID($id)]);
    }

    public function find(array $query = [])
    {
        return $this->collection->find($query);
    }

    public function insert(array $data)
    {
        $result = $this->collection->insertOne($data);

        $id = (string)$result->getInsertedId();

        $data['id'] = $id;

        return $data;
    }

    public function update(array $data, array $where)
    {
        // TODO: Implements MongoDB Collection Update
//        return $this->collection-> update($where, $data);
    }

    public function delete(array $where)
    {
        // TODO: Implements MongoDB Collection Delete
//        return $this->collection->remove($where);
    }
}