<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class ImagesAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('imageName')
            ->add('imageSize')
            ->add('updateAt')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('imageName')
            ->add('imageSize')
            ->add('updateAt')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'download_label' => 'Скачать бесплатно без регистрации и смс',
                'download_uri' => true,
                'image_uri' => true,
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $image = $this->getSubject();
        $image->getWebPath();
        $showMapper
            ->add('id')
            ->add('imageName')
            ->add('imageSize')
            ->add('updateAt')
            ->add('imageFile', 'sonata_media_type', [
                'provider' => 'sonata.media.provider.image'
            ]);
    }
}
