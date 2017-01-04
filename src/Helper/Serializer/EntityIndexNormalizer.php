<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 1/4/17
 * Time: 4:20 AM
 */

namespace Veloci\Core\Helper\Serializer;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Veloci\Core\EntityIndex;
use Veloci\Core\Model\IntegerIndex;


/**
 * Class EntityIndexNormalizer
 *
 * @package Veloci\Core\Helper
 */
class EntityIndexNormalizer extends AbstractNormalizer
{
    protected $indexType = IntegerIndex::class;

    /**
     * @param string $type
     */
    public function setIndexType(string $type)
    {
        $this->indexType = $type;
    }

    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed  $data    data to restore
     * @param string $class   the expected class to instantiate
     * @param string $format  format the given data was extracted from
     * @param array  $context options available to the denormalizer
     *
     * @return object
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $type = $this->indexType;

        return new $type($data);
    }

    /**
     * Checks whether the given class is supported for denormalization by this normalizer.
     *
     * @param mixed  $data   Data to denormalize from
     * @param string $type   The class to which the data should be denormalized
     * @param string $format The format being deserialized from
     *
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return is_a($type, EntityIndex::class, true);
    }

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param object $object  object to normalize
     * @param string $format  format the normalization result will be encoded as
     * @param array  $context Context options for the normalizer
     *
     * @return array|scalar
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return (string)$object;
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed  $data   Data to normalize
     * @param string $format The format being (de-)serialized from or into
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof EntityIndex;
    }
}