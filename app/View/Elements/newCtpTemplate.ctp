<?php
echo $this->Form->create('Classroom', array('class' => 'form-data create-popup'));
?>
                <div class = "left-pop">
                    <?php
                    echo $this->Form->input(
                            'title', array('label' => 'Name of the classroom', 'class' => 'pop-input')
                    );
                    //Set the list at the controller
                    echo $this->Form->input(
                            'campuses', array(
                        'label' => 'University Association',
                        'type' => 'select',
                        'empty' => 'none',
                        'class' => 'chosen-select select_option'
                    ));
                    //Set the list of departments based on university association
                    //ajax fill based on campus
                    echo $this->Form->input(
                            'departments', array(
                        'label' => 'Department',
                        'type' => 'select',
                        'empty' => 'none',
                        'class' => 'chosen-select select_option'
                    ));
                    //Set list like 1,2,3,4,5
                    ?>
                    <div class="year-dd">
                        <?php
                        echo $this->Form->input(
                                'year', array(
                            'label' => 'Year',
                            'class' => 'chosen-select',
                                    'div' => false
                                )
                        );
                        ?>
                    </div>
                    <div class="calender create-date">
                        <?php
                        echo $this->Form->input(
                                'duration_start_date', array('label' => 'Duration of the course',
                            'class' => 'pop-dura date_popup')
                        );
                        ?>
                    </div>
                    <div class="calender create-date">    
                        <?php
                        echo $this->Form->input(
                                'duration_end_date', array(
                            'class' => 'pop-dura date_popup'
                                )
                        );
                        ?>
                    </div>
                    <div class="right-pop">
                        <div class="check-btn">
                            <?php
                            echo $this->Form->input(
                                    'is_private', array('label' => 'Private Classroom',
                                'class' => 'radio-lbl'
                                    )
                            );
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
                                'degrees', array('label' => 'Degree',
                            'class' => 'pop-input')
                        );

                        echo $this->Form->input(
                                'link', array('label' => 'Youtube video link',
                            'class' => 'pop-input')
                        );

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
                        echo $this->Form->end('Create', array(
                            'class' => 'sub-btn'));
                        ?>