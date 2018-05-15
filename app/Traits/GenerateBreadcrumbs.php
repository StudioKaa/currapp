<?php
namespace App\Traits;

trait GenerateBreadcrumbs{

	public function breadcrumbs($input, $addition = null)
    {

        $crumbs = collect();

        if($addition != null)
        {
            $crumb = ['text' => $addition];
            $crumbs->push((object)$crumb);
        }

        while ($input != null)
        {
            $crumb = array();
            $crumb['text'] = $input->title;

            if($input instanceof \App\Lesson)
            {
                $crumb['text'] = $input->lesson_type->title . ': ' . $input->title;
                $crumb['link'] = route('lessons.show', $input);
                $input = $input->lesson_type->term;
            }
            elseif($input instanceof \App\Term)
            {
                $crumb['link'] = route('terms.show', $input);
                $input = $input->cohort;
            }
            elseif($input instanceof \App\Cohort)
            {
                $crumb['link'] = route('cohorts.show', $input);
                $input = $input->education;
            }
            elseif($input instanceof \App\Education)
            {
                $crumb['link'] = route('educations.now', $input);
                $input = null;
            }

            $crumbs->push((object)$crumb);
        }

        return $crumbs->reverse()->values();

    }

}