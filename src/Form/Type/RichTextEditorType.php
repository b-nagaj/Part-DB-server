<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RichTextEditorType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub

        $resolver->setDefault('mode', 'markdown-full');
        $resolver->setAllowedValues('mode', ['html-label', 'markdown-single_line', 'markdown-full']);

        $resolver->setDefault('required', false);

    }

    public function getBlockPrefix(): string
    {
        return 'rich_text_editor';
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['attr'] = array_merge($view->vars['attr'], $this->optionsToAttrArray($options));

        parent::finishView($view, $form, $options); // TODO: Change the autogenerated stub
    }

    protected function optionsToAttrArray(array $options): array
    {
        $tmp = [];

        //Set novalidate attribute or we will get problems that form can not be submitted as textarea is not focusable
        $tmp['novalidate'] = 'novalidate';

        $tmp['data-mode'] = $options['mode'];

        //Add our data-controller element to the textarea
        $tmp['data-controller'] = 'elements--ckeditor';


        return $tmp;
    }

    public function getParent(): string
    {
        return TextareaType::class;
    }
}