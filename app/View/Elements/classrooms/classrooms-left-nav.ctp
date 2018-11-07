<div class="clearfix">
    <?php
        $data = $this->requestAction('Classrooms/getclassrooms.json', array('return'));
    ?>
    <div class="arrow_up">
        <?php echo $this->Html->image('/images/arrow-up.png', array('alt' => 'Up')); ?>
        <!--<img src="images/arrow-up.png" alt="Up"/>-->
    </div>
    <div class="scroll-pane">
        
    </div>
    <div class="arrow_down">
        <?php echo $this->Html->image('/images/arrow-down.png', array('alt' => 'Up')); ?>
        <!--<img src="images/arrow-down.png" alt="Down"/>-->
    </div>
</div>
<script type="text/javascript">

    var App = window.App || {};
        App.leftNavData = <?php echo $data; ?>;

</script>