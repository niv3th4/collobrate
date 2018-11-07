<?php
/**
 * Initialize for active menu
 */
$addClass['Discussions'] = null;
$addClass['Announcements'] = null;
$addClass['Libraries'] = null;
$addClass['People'] = null;
$addClass['Submissions'] = null;
$addClass['Reports'] = null;

/**
 * assign correct active menu
 */
$addClass[$active] = array(
    'class' => 'active'
);
?>

<div class="clearfix">
    <ul class="left-subnav clearfix">
        <li>
            <?php
            echo $this->Html->link('Discussions', array(
                    'controller' => 'Discussions',
                    'action' => 'index',
                    'id' => $classroomId
                ), $addClass['Discussions']
            );
            ?>
        </li>
        <li>
            <?php
            echo $this->Html->link('Announcements', array(
                'controller' => 'Announcements',
                'action' => 'index',
                'id' => $classroomId
                    ), $addClass['Announcements']
            );
            ?>
        </li>
        <li>
            <?php
            echo $this->Html->link('Library', array(
                    'controller' => 'Libraries',
                    'action' => 'index',
                    'id' => $classroomId
                ), $addClass['Libraries']
            );
            ?>
        </li>
        <li>
            <?php
            echo $this->Html->link('Submissions', array(
                    'controller' => 'Submissions',
                    'action' => 'index',
                    'id' => $classroomId
                ), $addClass['Submissions']
            );
            ?>
        </li>
        <li>
            <div class="loader"><img src="<?php echo $this->webroot; ?>/images/loading/ajax-loader.gif" alt="loading">
            </div>
        </li>
    </ul>
    <div class="nav-right">
        <a href="javascript:void(0)" class="sub-btn" id="dialog-link">Invite</a>
        <a href="javascript:void(0)" class="nav-search"></a>
        <div class="search-input">
            <div class="search-panel">
                <input type="text" placeholder="Search" >
                <a href="classroom-searchresult.htm" class="search-btn"></a>
            </div>
        </div>
    </div>
    <!--popup-->
    <div id="dialog" class="create-popup invite">
        <div class="pop-wind clearfix">
            <div class="pop-head clearfix">
                <span>Invite</span>
                <a class="close-link" href="#">
                    <span class="icon-cross"></span></a>
            </div>
            <div class="pop-content clearfix">
                <div class="assign-pop">
                    <form class="form-data create-popup">
                        <div class="clearfix">
                            <div class="invi-left">
                                <div class="sel-univ">
                                    <p class="uni-topic">Select University</p>
                                    <select class="chosen-select select_option">
                                        <option>University Association 1</option>
                                        <option>University Association 2</option>
                                        <option>University Association 3</option>
                                        <option>University Association 4</option>
                                    </select>
                                </div>
                                <div  id="catalog">
                                    <div class="accordionsections">
                                        <div class="as1tab head-acc">Department 1</div>
                                        <div class="as1tabdec">
                                            <div class="as1tab sub1-acc">Degree 1 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 1 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 2 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 3 (100 people)</div>
                                            <div class="as1tab sub1-acc">Degree 2 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Tab2 Dec</div>
                                            <div class="as1tab sub1-acc">Degree 3 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Tab3 Dec</div>
                                        </div>
                                        <div class="as1tab head-acc">Department 2</div>
                                        <div class="as1tabdec">
                                            <div class="as1tab sub1-acc">Degree 1 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 1 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 2 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 3 (100 people)</div>
                                            <div class="as1tab sub1-acc">Degree 2 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 2</div>
                                            <div class="as1tab sub1-acc">Degree 3 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 2</div>
                                        </div>
                                        <div class="as1tab head-acc">Department 3</div>
                                        <div class="as1tabdec">
                                            <div class="as1tab sub1-acc">Degree 1 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 1 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 2 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 3 (100 people)</div>
                                            <div class="as1tab sub1-acc">Degree 2 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section 1</div>
                                            <div class="as1tab sub1-acc">Degree 3 (100 people)</div>
                                            <div class="as1tabdec sub2-acc">Section </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invi-right">
                                <input type="text" class="pop-input" placeholder="Start typing name">
                                <div class="invi-space">
                                    <div id="cart" class="ans-scroll">
                                        <div class="ui-widget-content">
                                            <ol>
                                                <li class="placeholder">Drag here</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-btn two-btn">
                            <input type="submit" class="sub-btn cnl-btn" value="Cancel">
                            <input type="submit" class="sub-btn" value="Send Invite">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>