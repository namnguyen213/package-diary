<!------------------------------------------------------------------------------
| List of elements in post form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['diaries.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('diaries.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
            class="btn btn-danger pull-right margin-left-5 delete">
                {!! trans($plang_admin.'.buttons.delete') !!}
            </a>
        @endif
        <!-- DELETE BUTTON -->

        <!-- SAVE BUTTON -->
        {!! Form::submit(trans($plang_admin.'.buttons.save'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->

    <!--TAB MENU-->
    <ul class="nav nav-tabs">
        <!--BASIC-->
        <li class="active">
            <a data-toggle="tab" href="#menu_1">
                {!! trans($plang_admin.'.tabs.basic') !!}
            </a>
        </li>

        <!--ADVANCED-->
        <li>
            <a data-toggle="tab" href="#menu_2">
                {!! trans($plang_admin.'.tabs.advance') !!}
            </a>
        </li>

        <!--OTHER-->
        <li>
            <a data-toggle="tab" href="#menu_3">
                {!! trans($plang_admin.'.tabs.other') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--BASIC-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--DIARY NAME-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'diary_name',
                'id' => 'diary_name',
                'label' => trans($plang_admin.'.labels.name'),
                'value' => @$item->diary_name,
                'description' => trans($plang_admin.'.descriptions.name'),
                'errors' => $errors,
            ])
            <!--/DIARY NAME-->


            <!--/DIARY NAME-->

            <div class="row">

               <div class='col-md-6'>

                    <!-- LIST OF CATEGORIES -->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'category_id',
                        'label' => trans($plang_admin.'.labels.category'),
                        'items' => $categories,
                        'value' => @$item->category_id,
                        'description' => trans($plang_admin.'.descriptions.category', [
                                     'href' => URL::route('categories.list', ['_key' => $context->context_key])
                                     ]),
                        'errors' => $errors,
                    ])

               </div>

                <div class='col-md-6'>

                    <!-- LIST OF CATEGORIES -->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'slideshow_id',
                        'label' => trans($plang_admin.'.labels.slideshow'),
                        'items' => $slideshow,
                        'value' => @$item->slideshow_id,
                        'description' => trans($plang_admin.'.descriptions.slideshow', [
                                     'href' => URL::route('slideshows.list')
                                     ]),
                        'errors' => $errors,
                    ])

               </div>



            </div>




        </div>

        <!--ADVANCED-->


        <!--OTHER-->


    </div>
    <!--/TAB CONTENT-->

    <!--HIDDEN FIELDS-->
    <div class='hidden-field'>
        {!! Form::hidden('id',@$item->id) !!}
        {!! Form::hidden('context',$request->get('context',null)) !!}
    </div>
    <!--/HIDDEN FIELDS-->

{!! Form::close() !!}
<!------------------------------------------------------------------------------
| End list of elements in post form
|------------------------------------------------------------------------------>