<div class="clearfix">
    <ul class="left-subnav clearfix">
        <li><a href="javascript:void(0);" class="active">My Classrooms</a>
        </li>
        <li><a href="javascript:void(0);">Staffroom</a>
        </li>
        <li><a href="javascript:void(0);">Archived Classrooms</a>
        </li>
        <li><div class="loader">
                <!--<img src="images/loading/ajax-loader.gif" alt="loading">-->
                <?php echo $this->Html->image('/images/loading/ajax-loader.gif'); ?>
            </div></li>
    </ul>
    <a href="javascript:void(0)" class="sub-btn dialogbox" title="create-assign">Create New Classroom</a>
    <!--popup-->
    <div id="create-assign" class="create-popup doc-popup">
        <div class="pop-wind clearfix">
            <div class="pop-head clearfix">
                <span>Create Classroom</span>
                <a class="close-link" href="javascript:void(0);">
                    <span class="icon-cross"></span></a>
            </div>
            <div class="pop-content clearfix">
                <?php
                echo $this->Form->create('Classroom', array(
                    'class' => 'form-data create-popup',
                    'action' => 'add',
                    'id' => 'classroom-form',
//                        'ext' => 'json'
                ));
                ?>
                <div class="left-pop">
                    <?php
                    echo $this->Form->input(
                            'title', array('label' => 'Name of the classroom', 'class' => 'pop-input')
                    );
                    //Set the list at the controller
                    echo $this->Form->input(
                            'campus_id', array(
                        'label' => 'University Association',
//                        'type' => 'select',
                        'empty' => 'none',
                        'class' => 'chosen-select select_option'
                    ));
                    //Set the list of departments based on university association
                    //ajax fill based on campus
                    echo $this->Form->input(
                            'department_id', array(
                        'label' => 'Department',
                        'type' => 'select',
                        'empty' => 'none',
                        'class' => 'chosen-select select_option'
                    ));
                    ?>
                    <div class="year-dd">
                        <?php
                        echo $this->Form->input('year', array(
                            'label' => 'Year',
                            'class' => 'chosen-select',
                            'div' => false,
                            'type' => 'select',
                            'empty' => 'none'
                        ));
                        ?>
                    </div>
                    <label>Duration of the course</label>
                    <div class="calender create-date">
                        <?php
                        echo $this->Form->input('duration_start_date', array(
                            'label' => false,
                            'class' => 'pop-dura date_popup',
                            'type' => 'text'
                        ));
                        ?>
                    </div>
                    <div class="calender create-date">    
                        <?php
                        echo $this->Form->input('duration_end_date', array(
                            'label' => false,
                            'class' => 'pop-dura date_popup',
                            'type' => 'text'
                        ));
                        ?>
                    </div>
                    <?php
                    echo $this->Form->input('semester', array(
                        'type' => 'select',
                        'class' => 'chosen-select select_option',
                        'label' => 'Semester',
                        'empty' => 'none'
                    ));
                    ?>
                </div>
                <div class="right-pop">
                    <label>Course Type</label>
                    <div class="radio-btn">
                        <?php
                        $options = array('0' => 'Public', '1' => 'Private');
                        $attributes = array(
                            'legend' => false,
                            'label' => array(
                                'class' => 'radio-lbl'
                        ));

                        echo $this->Form->radio('is_private', $options, $attributes);
                        ?>
                    </div>
                    <?php
                    echo $this->Form->input(
                            'description', array('label' => 'Course Description',
                        'class' => 'pop-txtarea')
                    );
                    //ajax fill based on department
                    //Set the list at the controller
                    echo $this->Form->input(
                            'degree_id', array(
                        'type' => 'select',
                        'label' => 'Degree',
                        'class' => 'chosen-select select_option',
                        'empty' => 'none'
                    ));
                    echo $this->Form->input(
                            'link', array('label' => 'Youtube video link',
                        'class' => 'pop-input'
                    ));
                    echo $this->Form->input(
                            'minimum_attendance_percentage', array('label' => 'Minimum required attendance',
                        'class' => 'pop-dura',
                        'pattern' => '[0-9]{0,3}',
                        'title' => 'Should be numeric')
                    );
                    ?>
                </div>
                <div class="clear"></div>
                <div class="submit-btn">
                    <?php
                    echo $this->Form->submit('Create', array(
                        'div' => false,
                        'class' => 'sub-btn',
                        'value' => 'Create',
                        'id' => 'quiz-link'
                    ));
                    echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>

        <!--quiz popup-->
        <div id="quizdialog" class="quizdia create-popup">
            
        </div>
    </div>
</div>