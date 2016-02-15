<?php
/**
 *
 */
namespace BenchmarkerBundle\Form\Type;

use BenchmarkerBundle\Validator\Constraint\MultiUrl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Url;

class SitesType extends AbstractType
{
    /**
     * @var DataTransformerInterface
     */
    private $transformer;

    /**
     * @param DataTransformerInterface $transformer
     */
    public function __construct(DataTransformerInterface $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'site',
            TextType::class,
            [
            'constraints' => new Url()
            ]
        );

        $builder->add(
            'compare_sites',
            TextareaType::class,
            [
                'constraints' => new MultiUrl()
            ]
        );

        $builder->add('save', SubmitType::class);
        $builder->addModelTransformer($this->transformer);
    }
}
