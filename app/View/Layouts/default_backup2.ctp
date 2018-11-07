<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <!-- styles -->
    <?php
//        echo $this->Html->css('/style.css'); 
//    echo $this->Html->css('/css/reset.css');
//    echo $this->Html->css('/css/layout.css');
//    echo $this->Html->css('/css/styles.css');
//    echo $this->Html->css('/css/jquery-ui-latest.css');
//    echo $this->Html->css('/css/tooltipster.css');
//    echo $this->Html->css('/css/font-awesome.min.css');
//    echo $this->Html->css('/css/plugins.css');
//    echo $this->Html->css('/css/jquery.bxslider.css');
//    echo $this->Html->css('/css/chosen.css');
//    echo $this->Html->css('/css/jquery.tagit.css');
//    echo $this->Html->css('/css/prettyPhoto.css');
//    echo $this->Html->css('/css/fullcalendar.css');
    ?>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/css/toastr.min.css" rel="stylesheet"/>
    <?php
    // echo $this->fetch('script'); 
    ?>
    <!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/ie8.css" />
    <![endif]-->
    <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

</head>

<body class="bg-color">
    <!-- Header -->
    <header>
        <?php
        $flashMessage = $this->Session->flash();
        if ($flashMessage !== false) {
            echo $this->element('flash', array(
                'message' => $flashMessage
            ));
        }
        ?>
        <section class="clearfix header">
            <!-- Logo-->
            <div class="logo"><a href="">
                    <?php echo $this->Html->image('/images/logo.png', array('class' => 'f-left')); ?>
                </a>
            </div>
            <!-- search div -->
            <!-- Top Notification -->
        </section>
    </header>
    <div class="container calen">
        <!-- Left Navigation -->
        <nav class="navigation-main">
            <ul class="primary">
                <li class="pdiscover active">
                    <a href="" class="lst-a classrooms"><span class="icon"></span>
                        <span class="label">Classrooms</span></a>
                    <!--Classroom sub nav-->
                </li>
                <li class="pdiscover">
                    <a href="" class="lst-a flname">
                        <span class="icon">
                            <?php echo $this->Html->image('/images/chat1.jpg'); ?>
                        </span>
                        <span class="label"><?php echo AuthComponent::user('username') ?></span></a>
                </li>
                <li>
                    <a href="" class="logout">
                        <?php echo $this->Html->image('/images/logout.png'); ?>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Right side Content  -->
        <section class="rightwrapper">
            <!-- Right Sub Navigation -->
            <section class="pagesubnav">
                <?php
                echo $this->fetch('pagesubnav');
                ?>
            </section>
            <!-- Right Content -->
            <section class="pagecontent clearfix">
                <!-- content -->
                <?php
                echo $this->fetch('content');
                ?>
            </section>
        </section>
    </div>

    <!--Scripts -->
    <?php
    echo $this->Html->script('jquery-1.8.2.min');
    echo $this->Html->script('jquery-ui-1.10.3.custom');
    echo $this->Html->script('plugin');
    ?>
    <script src="http://malsup.github.io/jquery.form.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>--> 
    <?php
//    echo $this->Js->writeBuffer(); 
    echo $this->Html->script('core');
    ?>
    <?php
//    echo '<script type="text/javascript">';
//    echo '$(document).ready(function () {';
//    echo '$("#sex-open").click( function() {';
//    echo 'alert("sex");';
//    echo '});';
//    echo '});';
//    echo '</script>';
    ?>
</body>
</html>