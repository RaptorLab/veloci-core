<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 24/03/16
 * Time: 21:43
 */

namespace Veloci\Core\Helper\Metadata;

use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\MetadataRepository;
use Veloci\User\Exception\ValidationException;

class ModelValidatorDefault implements ModelValidator
{
    /**
     * @var MetadataRepository
     */
    private $metadataRepository;

    public function __construct(MetadataRepository $metadataRepository)
    {
        $this->metadataRepository = $metadataRepository;
    }

    /**
     * @param EntityModel $model
     * @throws ValidationException
     */
    public function validate(EntityModel $model)
    {
        $metadata = $this->metadataRepository->getMetadata($model);

        $metadata->validate($model);
    }
}