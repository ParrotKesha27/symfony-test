<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

use App\Entity\Category;


final class BlogPostAdmin extends AbstractAdmin
{
 
    #   Список полей, которые отображются в фильтре
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title')
            ->add('body')
            ;
    }

    #   Список полей, которые отображаются в списке (кнопка List)

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('title')
            ->add('body')
            ->add('category')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    #   Список полей для создании нового объекта

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('title')
            ->add('body', CKEditorType::class)
            ->add('category', ModelType::class, [
                'class' => Category::class,
                'property' => 'name'
            ])
            ;
    }

    #   Список полей, отображаемые при детальном просмотре (кнопка Show в разделе Action)

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('body')
            ->add('category')
            ;
    }
}
