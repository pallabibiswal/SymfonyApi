<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ApiAdmin
 * @package AppBundle\Admin
 */
class DeviceAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('tid', TextType::class);
        $formMapper->add('deviceType', TextType::class);
//        $formMapper->add('merchantId', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('tid')
            ->add('deviceType');
//            ->add('merchantId');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('tid');
        $listMapper->addIdentifier('deviceType');
//        $listMapper->addIdentifier('merchantId');
    }
}