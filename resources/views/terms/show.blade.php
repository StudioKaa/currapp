@extends('layouts.app')

@section('page-title')
    > <a class="navbar-text" href="/educations/{{ $education->id }}">{{ $education->title }}</a>
    >
    <select class="cohort-select" id="to-term">
        @foreach($cohort->education->cohorts as $c)
            <option value="{{ $c->id }}.{{ $term->title }}" <?php echo $c->id == $cohort->id ? 'selected' : '' ?>>
                {{ $c->start_year }} - {{ $c->exam_year }}
            </option>
        @endforeach
    </select>
    > {{ $term->title }}
@endsection

@section('buttons-right')
    <a class="btn btn-outline-secondary navbar-text" href="/cohorts/{{ $cohort->id }}">
        <i class="fa fa-chevron-left" aria-hidden="true"></i> Overzicht
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/lesson_types/create?term={{ $term->id }}">
        <i class="fa fa-plus" aria-hidden="true"></i> Lesvorm
    </a>
    <a class="btn btn-outline-secondary navbar-text" href="/terms/{{ $term->id }}/edit">
        <i class="fa fa-pencil" aria-hidden="true"></i> {{ $term->title }}
    </a>
@endsection

@section('content')

    <div class="my-vertical-deck-container">

        <div class="my-vertical-deck week-numbers">
            @for($i = 1; $i <= 8; $i++)
                <div class="card d-flex align-items-center duration-1">
                    <div class="card-body">
                        <h5>{{ $i }}</h5>
                    </div>
                </div>
            @endfor
        </div>

        @foreach ($lesson_types as $lesson_type)
            <div class="my-vertical-deck">
                <div class="my-deck-title">
                    <div>
                        <h5>{{ $lesson_type->title }}</h5>
                        <p>{{ $lesson_type->sub_title }}&nbsp;</p>
                    </div>
                    <div class="plus-icon btn-group">
                        <a href="/lesson_types/{{ $lesson_type->id }}/edit" class="btn btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="/lessons/create?lesson_type={{ $lesson_type->id }}" class="btn btn-outline-secondary"><i class="fa fa-plus" aria-hidden="true"></i> Les</a>
                    </div>
                </div>
                @for($i = 1; $i <= 8;)
                    <?php
                    $lesson = $lesson_type->lessons->where('week_start', $i)->first();
                    if($lesson == null):
                        $i += 1;
                        ?>
                        <div class="card duration-1 border-0"></div>
                        <?php
                    else:
                        $i += $lesson->duration;
                        ?>
                        <div class="card duration-{{ $lesson->duration }} bg-{{ $lesson->status()->context_class }}">
                            <div class="card-body d-flex flex-column justify-content-between" title="{{ $lesson->status()->title }}">
                                <p class="card-title">
                                    <a href="/lessons/{{ $lesson->id }}">{{ $lesson->title }}</a>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                @endfor
            </div>
        @endforeach
    </div>
    
@endsection